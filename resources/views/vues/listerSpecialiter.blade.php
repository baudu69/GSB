@extends('layouts.master')

@section('contenu')
    <div class="container">
        <h1>Les spécialités de {{$unPraticien->nom_praticien}} {{$unPraticien->prenom_praticien}}:</h1>
        <div class="main">
            <label for="specialite">Ajouter une spécialité</label>
            <select name="specialite" id="specialite">
                <option value="" selected>---</option>
                @foreach($lesSpecialitesAAjouter as $uneSpecialite)
                    <option id="option_{{$uneSpecialite->id_specialite}}" value="{{$uneSpecialite->id_specialite}}">{{$uneSpecialite->lib_specialite}}</option>
                @endforeach
            </select>
            <button type="button" class="btn-1" id="btnValidSpecialite">Ajouter</button>
            <table class="table table-hover table-responsive-lg">
                <thead class="thead-1">
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th>Diplôme</th>
                <th>Coefficient Prescription</th>
                <th></th>
                <th></th>
                </thead>
                <tbody id="contenu">
                @foreach($lesSpecialites as $uneSpecialite)
                    <tr class="tr-1" id="{{$uneSpecialite->id_specialite}}">
                        <td>{{$uneSpecialite->id_specialite}}</td>
                        <td>{{$uneSpecialite->lib_specialite}}</td>
                        <td>{{$uneSpecialite->diplome}}</td>
                        <td>{{$uneSpecialite->coef_prescription}}</td>
                        <td><a href="{{url('/modifierSpecialite?idPraticien=' . $idPraticien . '&idSpecialite=' . $uneSpecialite->id_specialite)}}"><button type="button" class="btn-2">Modifier les options</button></a></td>
                        <td><button type="button" class="btn-3" onclick="delLigne({{$uneSpecialite->id_specialite}}, {{$idPraticien}}, '{{$uneSpecialite->lib_specialite}}')">Supprimer la spécialité</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function delLigne(idSpecialite, idPraticien, libSpecialite) {
            if (confirm('Voulez-vous vraiment supprimer cette specialité ?')) {
                var ok;
                $.get( "/api/delSpecialitePraticien?id_specialite=" + idSpecialite + '&id_praticien=' + idPraticien, function( data ) {
                    ok = data;
                    if (ok) {
                        $('#' + idSpecialite).remove();
                        jQuery("#specialite").append('<option value="' + idSpecialite + '" id="option_' + idSpecialite + '">' + libSpecialite + '</option>');
                    }
                    else
                        alert('Erreur lors de la suppression');
                });
            }
        }
        $("#btnValidSpecialite").click(function () {
            var texte = $("#specialite option:selected").text();
            var id = $("#specialite option:selected").val();
            var idPraticien = {{$idPraticien}};
            var urlModifier = '{{url('/modifierSpecialite?idPraticien=' . $idPraticien . '&idSpecialite=' . $uneSpecialite->id_specialite)}}';
            $.get("/api/addSpecialitePraticien?idPraticien=" + idPraticien + "&idSpecialite=" + id, function (data) {
                if (data)
                {
                    jQuery("#contenu").append('' +
                        '<tr class="tr-1" id="' + id + '">' +
                        '<td>' + id + '</td>' +
                        '<td>' + texte + '</td>' +
                        '<td>' + '</td>' +
                        '<td>' + '</td>' +
                        '<td>' + '<a href="' + urlModifier + '"><button type="button" class="btn-2">Modifier les options</button></a></td>' +
                        '<td><button type="button" class="btn-3" onclick="delLigne(' + id + ', ' + idPraticien + ', \'' + texte + '\')">Supprimer la spécialité</button> </td>' +
                        '</tr>');
                    $("#option_" + id).remove();
                }
                else
                {
                    alert('Une erreur est apparu pendant la validation');
                }
            });
        });
    </script>
@endsection
