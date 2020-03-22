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
            $lesPraticiens = DB::table('praticien')
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
            $lesPraticiens = DB::table('praticien')
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
            $lesPraticiens = DB::table('praticien')
                ->where('id_type_praticien', '=', $type)
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
            $lesPraticiens = DB::table('posseder')
                ->join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                ->where('id_specialite', '=', $specialite)
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
