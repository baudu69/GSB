<?php

namespace App\Http\Controllers;

use App\DAO\ServiceActivite;
use App\DAO\ServiceToken;
use App\Exceptions\MonException;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class ActiviteController extends Controller
{
    /**
     * JSONAPI : Recupere la liste des activites d'un praticien
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }

    /**
     * JSONAPI : supprime l'invitation d'un praticien
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }

    /**
     * JSONAPI : Recupere la liste des activites dont un praticien n'est pas invite
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }

    /**
     * JSONAPI : Genere une invitation pour un praticien
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }

    /**
     * JSONAPI : Recupere la liste de toutes les activites
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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
            $reponse = array();
            $reponse['token'] = ServiceToken::generateNewTokenByToken($request->input('token'));
            $reponse['Message'] = 'Erreur';
            $reponse['Erreur'] = $e->getMessage();
            return json_encode($reponse);
        }
    }

    /**
     * JSONAPI : Ajoute une activite
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
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

    /**
     * JSONAPI : Specialise une invitation
     * @param Request $request
     * @return false|string
     * @throws MonException
     */
    public function jsonApiSpecialiser(Request $request) {
        try {
            $reponse = array();
            $idPraticien = $request->input('idPraticien');
            $idActivite = $request->input('idActivite');
            $faire = $request->input('faire');
            $activite = new ServiceActivite();
            if ($faire == '0')
                $activite->specialiser($idPraticien, $idActivite);
            else
                $activite->despecialiser($idPraticien, $idActivite);
            $lesActivites = $activite->getActivityByIdPraticien($idPraticien);
            $reponse['lesActivites'] = $lesActivites;
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
