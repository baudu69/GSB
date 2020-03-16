<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceActivite
{
    public function getAllActivity() {
        try {
            $lesActivites = DB::table('ACTIVITE_COMPL')
                ->get();
            return $lesActivites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
