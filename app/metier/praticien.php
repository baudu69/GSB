<?php


namespace App\metier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class praticien extends Model
{
    protected $table = 'PRATICIEN';
    public $timestamps = false;
    protected $fillable = [
        'ID_PRATICIEN',
        'ID_TYPE_PRATICIEN',
        'NOM_PRATICIEN',
        'PRENOM_PRATICIEN',
        'ADRESSE_PRATICIEN',
        'CP_PRATICIEN',
        'VILLE_PRATICIEN',
        'COEF_NOTORIETE'
    ];
}
