<?php

namespace App\Http\Controllers;

use App\DAO\ServiceVisiteur;
use Illuminate\Http\Request;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class VisiteurController extends Controller
{
    /**
     * Permet d'authentifier un utilisateur
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * JSONAPI: Permet d'authentifier un utilisateur
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function jsonApiSignIn(Request $request) {
        try {
            $json = file_get_contents('php://input');
            $UtilisateursJson = json_decode($json);
            $id = $UtilisateursJson->id;
            $mdp = $UtilisateursJson->mdp;
            $user = new ServiceVisiteur();
            $unUser = $user->signIn($id);
            if ($unUser != null) {
                if (Hash::check($mdp, $unUser->pwd_visiteur))
                {
                    return json_encode('ok');
                }
                else
                {
                    return json_encode('Mot de passe incorrect');
                }
            }
            else
            {
                return json_encode('Identifiant incorrect');
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
