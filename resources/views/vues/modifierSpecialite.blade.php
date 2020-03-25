@extends('layouts.master')

@section('contenu')
    <div class="wrapper">
        <form class="login" name="frmLogin" action="{{url('modifierSpecialite')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="idPraticien" value="{{$unPraticien->id_praticien}}">
            <input type="hidden" name="idSpecialite" value="{{$uneSpecialite->id_specialite}}">
            <h3>
                <b>Modifier la spécialité :</b> <br>{{$uneSpecialite->lib_specialite}} <br><b>du praticien : </b><br>{{$unPraticien->nom_praticien}} {{$unPraticien->prenom_praticien}}
            </h3>
            <div class="form-group">
                <label for="diplome">Diplôme : </label>
                <input type="text" id="diplome" name="diplome" class="form-control" value="{{$uneSpecialite->diplome}}" required/>
            </div>
            <div class="form-group">
                <label for="coef">Coefficient Prescription : </label>
                <input type="text" id="coef" name="coef" class="form-control" required value="{{$uneSpecialite->coef_prescription}}"/>
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
