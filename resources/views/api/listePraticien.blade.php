@foreach($lesPraticiens as $unPraticien)
<tr class="tr-1">
    <td>{{$unPraticien->id_praticien}}</td>
    <td>{{$unPraticien->nom_praticien}}</td>
    <td>{{$unPraticien->prenom_praticien}}</td>
    <td>{{$unPraticien->adresse_praticien}}</td>
    <td>{{$unPraticien->ville_praticien}}</td>
    <td>{{$unPraticien->coef_notoriete}}</td>
    <td><a href="{{url('/listerSpecialite?idPraticien='.$unPraticien->id_praticien)}}"><button type="button" class="btn-2">Modifier les specialites</button></a></td>
</tr>
@endforeach
@if ($lesPraticiens->count() == 0)
<tr class="tr-1">
    <td colspan="7">Il n'y a pas de praticien avec ce nom/prenom pour cette specialite</td>
</tr>
@endif
