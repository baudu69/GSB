@extends('layouts.master')

@section('contenu')
    <div class="wrapper">
        <form class="login" name="frmLogin" action="{{url('signIn')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1>
                Connexion
            </h1>
            <div class="form-group">
                <label for="identifiant">Identifiant : </label>
                <input type="text" id="identifiant" name="identifiant" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe : </label>
                <input type="password" id="mdp" name="mdp" class="form-control" required/>
            </div>
            <div class="form-group">
                <button class="state" type="submit"><i class="fas fa-check-circle"></i> Valider</button>
            </div>
            @if (isset($message))
                <div id="message" class="alert alert-success" >{{ $message }}</div>
            @endif
            @if (isset($erreur))
                <div id="message" class="alert alert-danger" >{{ $erreur }}</div>
            @endif
        </form>
    </div>
@endsection
