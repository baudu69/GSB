<?php


namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceToken
{
    public static function tokenExist($token) {
        try {
            $nb = DB::table('visiteur')
                ->where('token_visiteur', '=', $token)
                ->count();
            return $nb != 0;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

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

    public static function tokenValid($token) {
        try {
            $nb = DB::table('visiteur')
                ->where('token_visiteur', '=', $token)
                ->where('lastUpdate_visiteur', '>', time() - 120)
                ->count();
            return $nb != 0;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
