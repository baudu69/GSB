<?php


namespace App\metier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class activite_compl extends Model implements \JsonSerializable
{
    protected $table = 'ACTIVITE_COMPL';
    public $timestamps = false;
    protected $fillable = [
        'ID_ACTIVITE_COMPL',
        'DATE_ACTIVITE',
        'LIEU_ACTIVITE',
        'THEME_ACTIVITE',
        'MOTIF_ACTIVITE'
    ];
}
