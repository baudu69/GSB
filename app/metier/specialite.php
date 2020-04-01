<?php


namespace App\metier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class specialite extends Model implements \JsonSerializable
{
    protected $table = 'SPECIALITE';
    public $timestamps = false;
    protected $fillable = [
        'ID_SPECIALITE',
        'LIB_SPECIALITE',
    ];
}
