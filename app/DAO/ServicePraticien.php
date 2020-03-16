<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServicePraticien
{
    /**
     * Renvoie la liste de tous les praticiens
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
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

    /**
     * Renvoie la liste de tous les praticiens don le nom correspond a $nom
     * @param $nom
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
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

    /**
     * Renvoie la liste de tous les praticiens don le nom correspond a $nom et dont le type
     * correspond a $type
     * @param $nom
     * @param $type
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getPraticienByNomType($nom, $type) {
        try {
            $lesPraticiens = DB::table('PRATICIEN')
                ->where('ID_TYPE_PRATICIEN', '=', $type)
                ->where(function ($query) use ($nom) {
                    $query->where('nom_praticien', 'like', '%' . $nom . '%')
                        ->orWhere('prenom_praticien', 'like', '%' . $nom . '%');
                })
                ->get();
            return $lesPraticiens;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Renvoie la liste des praticiens dont le nom ou le prenom ressemble a $nom et ou la specialite
     * correspond a $specialite
     * @param $nom
     * @param $specialite
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getPraticienByNomSpecialite($nom, $specialite) {
        try {
            $lesPraticiens = DB::table('POSSEDER')
                ->join('PRATICIEN', 'PRATICIEN.ID_PRATICIEN', '=', 'POSSEDER.ID_PRATICIEN')
                ->where('ID_SPECIALITE', '=', $specialite)
                ->where(function ($query) use ($nom) {
                    $query->where('nom_praticien', 'like', '%' . $nom . '%')
                        ->orWhere('prenom_praticien', 'like', '%' . $nom . '%');
                })
                ->get();
            return $lesPraticiens;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
