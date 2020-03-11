<?php

namespace App\Http\Controllers;

use App\DAO\ServiceVisiteur;
use Illuminate\Http\Request;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class VisiteurController extends Controller
{
    public function signIn(Request $request) {
        try {
            $identifiant = $request->input('identifiant');
            $mdp = $request->input('mdp');
            $user = new ServiceVisiteur();
            $unUser = $user->signIn($identifiant);
            if ($unUser != null) {
                if (Hash::check($mdp, $unUser->pwd_visiteur))
                {
                    Session::put('id', $identifiant);
                    return redirect('/');
                }
                else
                {
                    $erreur = 'Mot de passe incorrect';
                    return view('vues.connexion', compact('erreur'));
                }
            }
            else
            {
                $erreur = 'Identifiant incorrect';
                return view('vues.connexion', compact('erreur'));
            }
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    public function signOut() {
        Session::forget('id');
        return redirect('/');
    }
}
