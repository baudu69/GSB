<?php


namespace App\metier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class visiteur extends Model
{
    protected $table = 'VISITEUR';
    public $timestamps = false;
    protected $fillable = [
        'ID_VISITEUR',
        'ID_LABORATOIRE',
        'ID_SECTEUR',
        'NOM_VISITEUR',
        'PRENOM_VISITEUR',
        'ADRESSE_VISITEUR',
        'CP_VISITEUR',
        'VILLE_VISITEUR',
        'DATE_EMBAUCHE',
        'LOGIN_VISITEUR',
        'PWD_VISITEUR',
        'TYPE_VISITEUR',
        'token_visiteur',
        'lastUpdate_visiteur',
    ];
}
