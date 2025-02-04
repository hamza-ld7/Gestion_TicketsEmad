@extends('base')
@section('title', 'Gestion de Tickets')
@section('content')
<style>
    body {
        background-color: #eef0fd;
    }
</style>

<div class="container col-lg-10 my-5">
    @include('includes.success')
    @include('includes.errors')
    <div class="row my-3">
        <div class="col-md-6">
            <div class="left-div">
                <h1 class="mt-4"><strong>Gérez vos tickets en toute simplicité</strong></h1>
                <h5>Utilisez cette application pour gérer et suivre les demandes de support client.</h5>
            </div>

            <div class="my-5">
                <h4>Si vous êtes un client, entrez le code de l'entreprise :</h4>
                <h5 class="my-3">Pour <strong>se connecter</strong> :</h5>
                <form action="{{ route('entreprise.connexion_client') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="url_personnalisee" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Accéder</button>
                </form>
                <h5 class="my-3">Pour <strong>s'inscrire</strong> :</h5>
                <form action="{{ route('entreprise.inscription_client') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="url_personnalisee" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Accéder</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- <main class="signup-form"> -->
            <!-- <div class="signup-form-container"> -->
            <!-- <div class="row justify-content-center"> -->
            <h3 class="mb-4"><strong>Inscrivez votre entreprise dés maintenant</strong></h3>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('entreprise.inscrire') }}" method="POST">
                        @csrf
                        <label>Informations sur l'entreprise :</label>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="Nom de l'entreprise" id="nom_entreprise" class="form-control" name="nom_entreprise" required autofocus>
                            @if (isset($errors) && $errors->has('nom_entreprise'))
                            <span class="text-danger">{{ $errors->first('nom_entreprise') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="text" placeholder="Email de l'entreprise" id="email_address" class="form-control" name="email_entreprise" required autofocus>
                            @if (isset($errors) && $errors->has('email_entreprise'))
                            <span class="text-danger">{{ $errors->first('email_entreprise') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="text" placeholder="URL de l'entreprise" id="url_personnalisee" class="form-control" name="url_personnalisee" required autofocus>
                            @if (isset($errors) && $errors->has('url_personnalisee'))
                            <span class="text-danger">{{ $errors->first('url_personnalisee') }}</span>
                            @endif
                        </div>

                        <label>Informations sur le responsale :</label>

                        <div class="form-group mb-4">
                            <input type="text" placeholder="Nom" id="nom" class="form-control" name="nom" required autofocus>
                            @if (isset($errors) && $errors->has('nom'))
                            <span class="text-danger">{{ $errors->first('nom') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="text" placeholder="Prénom" id="prenom" class="form-control" name="prenom" required autofocus>
                            @if (isset($errors) && $errors->has('prenom'))
                            <span class="text-danger">{{ $errors->first('prenom') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
                            @if (isset($errors) && $errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="number" placeholder="Numéro de téléphone" id="telephone_entreprise" class="form-control" name="telephone_entreprise" required autofocus>
                            @if (isset($errors) && $errors->has('telephone_entreprise'))
                            <span class="text-danger">{{ $errors->first('telephone_entreprise') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" placeholder="Mot de passe" id="password" class="form-control" name="password" required>
                            @if (isset($errors) && $errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <!-- <div class="form-group mb-4">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                        </div> -->

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Inscrire</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
            <!-- </main> -->
        </div>
    </div>
</div>

@endsection