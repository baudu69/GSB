<?php


namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceToken
{
    /**
     * Genere un nouveau token pour un idPraticien
     * @param $idVisiteur
     * @return string
     * @throws MonException
     */
    public static function generateNewToken($idVisiteur) {
        try {
            $newToken = bin2hex(random_bytes(29));
            DB::table('visiteur')
                ->where('id_visiteur', '=', $idVisiteur)
                ->update([
                    'token_visiteur' => $newToken, 'lastUpdate_visiteur' => time()
                ]);
            return $newToken;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        } catch (\Exception $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Genere un token pour un praticien dont le token est egal a $tokenVisiteur
     * @param $tokenVisiteur
     * @return string
     * @throws MonException
     */
    public static function generateNewTokenByToken($tokenVisiteur) {
        try {
            $newToken = bin2hex(random_bytes(29));
            DB::table('visiteur')
                ->where('token_visiteur', '=', $tokenVisiteur)
                ->update([
                    'token_visiteur' => $newToken, 'lastUpdate_visiteur' => time()
                ]);
            return $newToken;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        } catch (\Exception $e) {
            throw new MonException($e->getMessage());
        }
    }

    /**
     * Verifie la validite d'un token
     * @param $token
     * @return bool
     * @throws MonException
     */
    public static function tokenValid($token) {
        try {
            $nb = DB::table('visiteur')
                ->where('token_visiteur', '=', $token)
                ->where('lastUpdate_visiteur', '>', time() - 600)
                ->count();
            return $nb != 0;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
