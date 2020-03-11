<?php


namespace App\metier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class specialite extends Model
{
    protected $table = 'SPECIALITE';
    public $timestamps = false;
    protected $fillable = [
        'ID_SPECIALITE',
        'LIB_SPECIALITE',
    ];
}
