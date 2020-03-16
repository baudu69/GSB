<?php


namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceTypes
{
    /**
     * Renvoie la liste de tous les types de praticien
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getAllTypes() {
        try {
            $lesTypes = DB::table('TYPE_PRATICIEN')
                ->get();
            return $lesTypes;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
