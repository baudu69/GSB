<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServicePraticien
{
    public function getAllPraticien() {
        try {
            $lesPraticiens = DB::table('PRATICIEN')
                ->get();
            return $lesPraticiens;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function getPraticienByNom($nom) {
        try {
            $lesPraticiens = DB::table('PRATICIEN')
                ->Where('nom_praticien', 'like', '%' . $nom . '%')
                ->orWhere('prenom_praticien', 'like', '%' . $nom . '%')
                ->get();
            return $lesPraticiens;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
