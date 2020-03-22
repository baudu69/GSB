<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceActivite
{
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
}
