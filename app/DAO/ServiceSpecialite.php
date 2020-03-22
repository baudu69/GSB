<?php


namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceSpecialite
{
    /**
     * Renvoie la liste de toutes les specialites
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getAllSpecialites() {
        try {
            $lesSpecialites = DB::table('specialite')
                ->get();
            return $lesSpecialites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Renvoie la liste des specialite qui correspondent au praticien $idPraticien
     * @param $idPraticien
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getSpecialiteByIdPraticien($idPraticien) {
        try {
            $lesSpecialistes = DB::table('posseder')
                ->join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->where('id_praticien', '=', $idPraticien)
                ->get();
            return $lesSpecialistes;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Supprime le lien entre $idSpecialite et $idPraticien de la table posseder
     * @param $idSpecialite
     * @param $idPraticien
     * @throws MonException
     */
    public function delSpecialitePraticien($idSpecialite, $idPraticien) {
        try {
            DB::table('posseder')
                ->where('id_specialite', '=', $idSpecialite)
                ->where('id_praticien', '=', $idPraticien)
                ->delete();
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Renvoie la liste de toutes les specialites sauf celles de la liste $listeIdSpecialite
     * @param $listeIdSpecialite
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getSpecialiteByNonPraticien($listeIdSpecialite) {
        try {
            $lesSpecialites = DB::table('specialite')
                ->whereNotIn('id_specialite', $listeIdSpecialite)
                ->get();
            return $lesSpecialites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Ajoute un lien entre $idPraticien et $idSpecialite dans la table posseder
     * @param $idPraticien
     * @param $idSpecialite
     * @throws MonException
     */
    public function addSpecialitePraticien($idPraticien, $idSpecialite) {
        try {
           DB::table('posseder')
           ->insert([
               'ID_specialite' => $idSpecialite, 'id_praticien' => $idPraticien
           ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
