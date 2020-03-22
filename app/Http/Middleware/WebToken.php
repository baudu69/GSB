<?php

namespace App\Http\Middleware;

use App\DAO\ServiceToken;
use Closure;

class WebToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \App\Exceptions\MonException
     */
    public function handle($request, Closure $next)
    {
        $reponse = array();
        $token = $request->input('token');
        if (ServiceToken::tokenValid($token))
            return $next($request);
        else {
            $reponse['token'] = 'Invalide';
            return response()->json($reponse);
        }
    }
}
