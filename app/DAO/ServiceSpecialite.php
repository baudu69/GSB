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
               'id_specialite' => $idSpecialite, 'id_praticien' => $idPraticien
           ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Recupere une activite par son id et par son praticien
     * @param $idPraticien
     * @param $idSpecialite
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     * @throws MonException
     */
    public function getUneSpecialitePraticien($idPraticien, $idSpecialite) {
        try {
            $uneSpecialite = DB::table('posseder')
                ->join('specialite', 'specialite.id_specialite', '=', 'posseder.id_specialite')
                ->where('posseder.id_specialite', '=', $idSpecialite)
                ->where('id_praticien', '=', $idPraticien)
                ->first();
            return $uneSpecialite;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Met a jour la specialite d'un praticien
     * @param $idPraticien
     * @param $idSpecialite
     * @param $coef
     * @param $diplome
     * @throws MonException
     */
    public function updateSpecialitePraticien($idPraticien, $idSpecialite, $coef, $diplome) {
        try {
            DB::table('posseder')
                ->where('id_specialite', '=', $idSpecialite)
                ->where('id_praticien', '=', $idPraticien)
                ->update(
                    ['coef_prescription' => $coef, 'diplome' => $diplome]
                );
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
