<?php


namespace App\metier;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inviter extends Model implements \JsonSerializable
{
    protected $table = 'INVITER';
    public $timestamps = false;
    protected $fillable = [
        'ID_ACTIVITE_COMPL',
        'ID_PRATICIEN',
        'SPECIALISTE'
    ];
}
