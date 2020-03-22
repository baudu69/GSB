<?php


namespace App\DAO;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceVisiteur
{
    /**
     * Renvoie les infos utilisateur qui correspond a $identifiant
     * @param $identifiant
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     * @throws MonException
     */
    public function signIn($identifiant) {
        try {
            $utilisateur = DB::table('visiteur')
                ->where('login_visiteur', '=', $identifiant)
                ->first();
            return $utilisateur;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
