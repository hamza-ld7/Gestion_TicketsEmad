@extends('base')
@section('title', 'Liste des tickets')
@section('content')

<style>
    .move-right {
        text-align: right;
    }

    .creer-ticket {
        text-align: right;
    }
</style>

@include('includes.success')
@include('includes.errors')

<div class="container mt-5">
    <h2 class="mt-3">Liste des tickets</h2>

    <div class="creer-ticket">
        <a href="/admin/creer_ticket" class="btn btn-success mt-2">Créer un ticket</a>
    </div>

    <div class="container mt-3">
        <div class="row">
            @if ($tickets && $tickets->count() > 0)
            <div class="col">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Status</th>
                            <th>Priorité</th>
                            <th>Agent assigné</th>
                            <th>Client concerné</th>
                            <th>Créé à</th>
                            <th>Mise à jour à</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td>1</td>
                            <td>{{$ticket->titre}}</td>
                            <td>{{$ticket->categorie->nom}}</td>
                            <td>{{$ticket->statut ? $ticket->statut->nom : 'Pas encore défini'}}</td>
                            <td>{{$ticket->priorite ? $ticket->priorite->nom : 'Pas encore défini'}}</td>
                            <td>{{$ticket->agent ? $ticket->agent->nom : 'Pas encore assigné'}}</td>
                            <td>{{$ticket->user->nom}}</td>
                            <td>{{$ticket->created_at->format('d-m-Y H:i')}}</td>
                            <td>{{$ticket->updated_at->format('d-m-Y H:i')}}</td>
                            <td>
                                <a href="{{route('admin.ticket', $ticket->id)}}" class="btn-sm">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>

                                <a href="{{route('admin.modifier_ticket', $ticket->id)}}" class="btn-sm">
                                    <i class="fa fa-edit fa-lg"></i>
                                </a>

                                <a href="{{route('admin.supprimer_ticket', $ticket->id)}}" class="btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <h4 class="text text-center">Aucun résultat trouvé</h4>
            @endif
        </div>
    </div>
</div>

@endsection