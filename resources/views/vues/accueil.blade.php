@extends('layouts.master')
@section('contenu')
    <div class="container">
        <h1>Bienvenue chez Galaxy Swiss Bourdins</h1>
        @if ($lesVisiteurs == null)
            <div class="alert alert-danger" role="alert">
                <b>Etat de la BDD : Non connecte</b>
            </div>
        @else
            <div class="alert alert-success" role="alert">
                <b>Etat de la BDD : Connecte</b>
            </div>

        @endif
    </div>
@endsection
