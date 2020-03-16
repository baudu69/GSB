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
            $utilisateur = DB::table('VISITEUR')
                ->where('LOGIN_VISITEUR', '=', $identifiant)
                ->first();
            return $utilisateur;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
