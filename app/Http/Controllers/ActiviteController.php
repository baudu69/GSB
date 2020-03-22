<?php

namespace App\Http\Controllers;

use App\DAO\ServiceActivite;
use App\DAO\ServiceToken;
use App\Exceptions\MonException;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class ActiviteController extends Controller
{
    public function jsonApiListeActivite(Request $request) {
        try {
            $reponse = array();
            $idPraticien = $request->input('idPraticien');
            $activite = new ServiceActivite();
            $lesActivites = $activite->getActivityByIdPraticien($idPraticien);
            $reponse['lesActivites'] = $lesActivites;
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    public function jsonApiDelActivitePraticien(Request $request) {
        try {
            $reponse = array();
            $idPraticien = $request->input('idPraticien');
            $idActivite = $request->input('idActivite');
            $activite = new ServiceActivite();
            $activite->delInvitation($idPraticien, $idActivite);
            $reponse['message'] = 'ok';
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);
        }
        catch (MonException $e) {
            return json_encode('Erreur');
        }
    }

    public function jsonApiListeActivitesNonPraticien(Request $request) {
        try {
            $reponse = array();
            $idPraticien = $request->input('idPraticien');
            $activite = new ServiceActivite();
            $lesActivites = $activite->getActivityByIdPraticien($idPraticien);
            $lesIds = array();
            foreach ($lesActivites as $uneActivite) {
                $lesIds[] = $uneActivite->id_activite_compl;
            }
            $lesActivites = $activite->getActiviteByNonPraticien($lesIds);
            $reponse['lesActivites'] = $lesActivites;
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    public function jsonApiAjouterActivitePraticien(Request $request) {
        try {
            $reponse = array();
            $idPraticien = $request->input('idPraticien');
            $idActivite = $request->input('idActivite');
            $activite = new ServiceActivite();
            $activite->participerActivite($idPraticien, $idActivite);
            $uneActivite = $activite->getActivityByIdActivite($idActivite);
            $reponse['uneActivite'] = $uneActivite;
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);

        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    public function jsonApiGetAllActivity(Request $request) {
        try {
            $reponse = array();
            $activite = new ServiceActivite();
            $lesActivites = $activite->getAllActivity();
            $reponse['lesActivites'] = $lesActivites;
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    public function jsonApiAjoutActivite(Request $request) {
        try {
            $reponse = array();
            $dateActivite = $request->input('dateActivite');
            $lieuActivite = $request->input('lieuActivite');
            $themeActivite = $request->input('themeActivite');
            $motifActivite = $request->input('motifActivite');
            $activite = new ServiceActivite();
            $activite->addActivity($dateActivite, $lieuActivite, $themeActivite, $motifActivite);
            $reponse['Message'] = 'OK';
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            return json_encode($reponse);

        }
        catch (MonException $e) {
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }
}
