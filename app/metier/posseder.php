<?php


namespace App\metier;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class posseder extends Model
{
    protected $table = 'POSSEDER';
    public $timestamps = false;
    protected $fillable = [
        'ID_PRATICIEN',
        'ID_SPECIALITE',
        'DIPLOME',
        'COEF_PRESCRIPTION',
    ];
}
