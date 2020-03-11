<?php


namespace App\metier;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inviter extends Model
{
    protected $table = 'INVITER';
    public $timestamps = false;
    protected $fillable = [
        'ID_ACTIVITE_COMPL',
        'ID_PRATICIEN',
        'SPECIALISTE'
    ];
}
