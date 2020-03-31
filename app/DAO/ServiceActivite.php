<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceActivite
{
    /**
     * Liste de toutes les activites
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getAllActivity() {
        try {
            $lesActivites = DB::table('activite_compl')
                ->get();
            return $lesActivites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Recupere une activite par son id
     * @param $idActivite
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     * @throws MonException
     */
    public function getActivityByIdActivite($idActivite) {
        try {
            $uneActivite = DB::table('activite_compl')
                ->where('id_activite_compl', '=', $idActivite)
                ->first();
            return $uneActivite;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Recupere les activites ou un praticien est invite
     * @param $idPraticien
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getActivityByIdPraticien($idPraticien) {
        try {
            $lesActivites = DB::table('activite_compl')
                ->join('inviter', 'activite_compl.id_activite_compl', '=', 'inviter.id_activite_compl')
                ->where('id_praticien', '=', $idPraticien)
                ->get();
            return $lesActivites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Supprime une invitation
     * @param $idPraticien
     * @param $idActivite
     * @throws MonException
     */
    public function delInvitation($idPraticien, $idActivite) {
        try {
            DB::table('inviter')
                ->where('id_activite_compl', '=', $idActivite)
                ->where('id_praticien', '=', $idPraticien)
                ->delete();
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Recupere la liste des activites sauf celles de $lesIds
     * @param $lesIds
     * @return \Illuminate\Support\Collection
     * @throws MonException
     */
    public function getActiviteByNonPraticien($lesIds) {
        try {
            $lesActivites = DB::table('activite_compl')
                ->whereNotIn('id_activite_compl', $lesIds)
                ->get();
            return $lesActivites;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Ajoute une invitation
     * @param $idPraticien
     * @param $idActivite
     * @throws MonException
     */
    public function participerActivite($idPraticien, $idActivite) {
        try {
            DB::table('inviter')
                ->insert([
                    ['id_activite_compl' => $idActivite, 'id_praticien' => $idPraticien, 'specialiste' => 'n']
                ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Ajoute une invitation
     * @param $date
     * @param $lieu
     * @param $theme
     * @param $motif
     * @throws MonException
     */
    public function addActivity($date, $lieu, $theme, $motif) {
        try {
            DB::table('activite_compl')
                ->insert([
                    ['date_activite' => $date, 'lieu_activite' => $lieu, 'theme_activite' => $theme, 'motif_activite' => $motif]
                ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Specialise une invitation
     * @param $idPraticien
     * @param $idActivite
     * @throws MonException
     */
    public function specialiser($idPraticien, $idActivite) {
        try {
            DB::table('inviter')
                ->where('id_praticien', '=', $idPraticien)
                ->where('id_activite_compl', '=', $idActivite)
                ->update([
                    'specialiste' => 'O'
                ]);
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * despecialise une invitation
     * @param $idPraticien
     * @param $idActivite
     * @throws MonException
     */
    public function despecialiser($idPraticien, $idActivite) {
        try {
            DB::table('inviter')
                ->where('id_praticien', '=', $idPraticien)
                ->where('id_activite_compl', '=', $idActivite)
                ->update(
                    ['specialiste' => 'N']
                );
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Renvoie les details d'un activite d'un praticien
     * @param $idPraticien
     * @param $idActivite
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     * @throws MonException
     */
    public function getActivityByIdPraticienIdActivity($idPraticien, $idActivite) {
        try {
            $uneActivite = DB::table('activite_compl')
                ->join('inviter', 'activite_compl.id_activite_compl', '=', 'inviter.id_activite_compl')
                ->where('id_praticien', '=', $idPraticien)
                ->where('inviter.id_activite_compl', '=', $idActivite)
                ->first();
            return $uneActivite;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
