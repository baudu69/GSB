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
            $lesSpecialites = DB::table('SPECIALITE')
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
            $lesSpecialistes = DB::table('POSSEDER')
                ->join('SPECIALITE', 'POSSEDER.ID_SPECIALITE', '=', 'SPECIALITE.ID_SPECIALITE')
                ->where('ID_PRATICIEN', '=', $idPraticien)
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
            DB::table('POSSEDER')
                ->where('ID_SPECIALITE', '=', $idSpecialite)
                ->where('ID_PRATICIEN', '=', $idPraticien)
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
            $lesSpecialites = DB::table('SPECIALITE')
                ->whereNotIn('ID_SPECIALITE', $listeIdSpecialite)
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
           DB::table('POSSEDER')
           ->insert([
               'ID_SPECIALITE' => $idSpecialite, 'ID_PRATICIEN' => $idPraticien
           ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
