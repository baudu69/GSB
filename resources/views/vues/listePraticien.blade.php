@extends('layouts.master')

@section('contenu')
    <div class="container">
        <h1>Recherche d'un praticien</h1>
        <div class="main">
            <div class="form-group">
                <label for="nom">Filtrer par nom : </label>
                <input type="text" name="nom" id="nom" />
            </div>
            <div class="form-group">
                <label for="specialite">Filtrer par spécialité : </label>
                <select name="specialite" id="specialite">
                    <option value="" selected>---</option>
                    @foreach($lesSpecialites as $uneSpecialite)
                        <option value="{{$uneSpecialite->id_specialite}}">{{$uneSpecialite->lib_specialite}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="main">
            <div id="chargement">
                <b>Chargement en cours...</b>
            </div>
            <table class="table table-hover table-responsive-lg">
                <thead class="thead-1">
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Ville</th>
                <th scope="col">Coef Notoriété</th>
                <th scope="col"></th>
                </thead>
                <tbody id="contenu">
                <tr class="tr-1">
                    <td colspan="7">Chargement en cours...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#chargement").hide();
        $( document ).ready(function() {
            $("#contenu").load('{{url('/api/listePraticien')}}', function () {
                $("#contenu").hide().show(1000);
            });
            $("#nom").keyup(function () {
                $("#chargement").toggle(100);
                const nom = $("#nom").val();
                const specialite = $("#specialite").val();
                $("#contenu").load('{{url('/api/listePraticien')}}', {nom: nom, specialite: specialite}, function () {
                    $("#chargement").toggle(100);
                });
            });
            $("#specialite").change(function () {
                $("#chargement").toggle(100);
                const nom = $("#nom").val();
                const specialite = $("#specialite").val();
                $("#contenu").load('{{url('/api/listePraticien')}}', {nom: nom, specialite: specialite}, function () {
                    $("#chargement").toggle(100);
                });
            })
        });
    </script>
@endsection
