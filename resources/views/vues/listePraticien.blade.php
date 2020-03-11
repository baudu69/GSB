@extends('layouts.master')

@section('contenu')
    <div class="container">
        <h1>Recherche d'un praticien</h1>
        <div class="main">
            <div class="form-group">
                <label for="nom">Nom du praticien : </label>
                <input type="text" name="nom" id="nom" />
            </div>
            <div class="form-group">
                <label for="specialite">Specialite du praticien : </label>
                <input type="text" name="specialite" id="specialite" />
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
                <th scope="col">Coef Notoriete</th>
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
                $("#contenu").load('{{url('/api/listePraticien')}}', {nom: nom}, function () {
                    $("#chargement").toggle(100);
                });
            });
        });
    </script>
@endsection
