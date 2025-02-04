<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(string $entreprise_URL)
    {
        if (!$entreprise_URL) {
            return redirect()->route('welcome')->withErrors("L'entreprise que vous désirez accéder est introuvable");
        }

        $entreprise = Entreprise::where('url_personnalisee', $entreprise_URL)->first();

        if (!$entreprise) {
            return redirect()->route('welcome')->withErrors("L'entreprise que vous désirez accéder est introuvable");
        }

        return view('auth.login', compact('entreprise'));
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'entreprise_id' => 'sometimes'
        ]);

        $credentials = $request->only('email', 'password', 'entreprise_id');
        if (auth()->attempt($credentials)) {
            return redirect()->intended('/client/dashboard');
        } else {
            if (!$request->get('entreprise_id')) {
                return redirect()->route('welcome')->withErrors("L'URL que vous désirez accéder n'est pas convenable");
            }
            else{
                $entreprise_URL = Entreprise::where('id', $request->get('entreprise_id'))->value('url_personnalisee');
    
                return redirect()->route('login', $entreprise_URL)->withErrors('Les informations sont incorrectes.');
            }
        }
    }

    public function registration(string $entreprise_URL)
    {
        $entreprise = Entreprise::where('url_personnalisee', $entreprise_URL)->first();

        if (!$entreprise) {
            return redirect()->route('welcome')->withErrors("L'entreprise que vous désirez accéder est introuvable");
        }
        return view('auth.registration', compact('entreprise'));
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'telephone' => 'required',
            'entreprise_id' => 'sometimes',
        ]);

        User::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'telephone' => $request->get('telephone'),
            'entreprise_id' => $request->get('entreprise_id'),
        ]);

        return redirect()->intended('/');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('welcome');
    }
}
