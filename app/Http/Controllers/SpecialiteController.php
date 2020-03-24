<?php

namespace App\Http\Controllers;

use App\DAO\ServicePraticien;
use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Http\Request;


class SpecialiteController extends Controller
{
    /**
     * Renvoie la liste de toutes les specialites
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllSpecialites() {
        try {
            $specialite = new ServiceSpecialite();
            $lesSpecialites = $specialite->getAllSpecialites();
            return view('vues.listePraticien', compact('lesSpecialites'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * Renvoie la liste des specialites d'un praticien et la liste des specialites que le praticien n'a pas
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listerSpecialiteByPraticien(Request $request) {
        try {
            $idPraticien = $request->input('idPraticien');
            $specialite = new ServiceSpecialite();
            $lesSpecialites = $specialite->getSpecialiteByIdPraticien($idPraticien);
            $lesIdSpecialites = array();
            foreach ($lesSpecialites as $uneSpecialite) {
                $lesIdSpecialites[] = $uneSpecialite->id_specialite;
            }
            $lesSpecialitesAAjouter = $specialite->getSpecialiteByNonPraticien($lesIdSpecialites);
            return view('vues.listerSpecialiter', compact('lesSpecialites', 'idPraticien', 'lesSpecialitesAAjouter'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }
    
    /**
     * Supprime la specialite d'un praticien
     * @param Request $request
     * @return bool
     */
    public function delSpecialitePraticien(Request $request) {
        try {
            $idSpecialite = $request->input('id_specialite');
            $idPraticien = $request->input('id_praticien');
            $specialite = new ServiceSpecialite();
            $specialite->delSpecialitePraticien($idSpecialite, $idPraticien);
            return true;
        }
        catch (MonException $e) {
            return false;
        }
    }

    /**
     * Ajoute une specialite a un praticien
     * @param Request $request
     * @return bool
     */
    public function addSpecialitePraticien(Request $request) {
        try {
            $idPraticien = $request->input('idPraticien');
            $idSpecialite = $request->input('idSpecialite');
            $specialite = new ServiceSpecialite();
            $specialite->addSpecialitePraticien($idPraticien, $idSpecialite);
            return true;
        }
        catch (MonException $e) {
            return false;
        }
    }

    /**
     * Modifier une specialite d'un praticien
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUneSpecialitePraticien(Request $request) {
        try {
            $idPraticien = $request->input('idPraticien');
            $idSpecialite = $request->input('idSpecialite');
            $specialite = new ServiceSpecialite();
            $praticien = new ServicePraticien();
            $unPraticien = $praticien->getPraticienById($idPraticien);
            $uneSpecialite = $specialite->getUneSpecialitePraticien($idPraticien, $idSpecialite);
            return view('vues.modifierSpecialite', compact('uneSpecialite', 'unPraticien'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * Valide les modifications de specialite
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function validUneSpecialitePraticien(Request $request) {
        try {
            $diplome = $request->input('diplome');
            $coef = $request->input('coef');
            $idPraticien = $request->input('idPraticien');
            $idSpecialite = $request->input('idSpecialite');
            $specialite = new ServiceSpecialite();
            $specialite->updateSpecialitePraticien($idPraticien, $idSpecialite, $coef, $diplome);
            return redirect('/listerSpecialite?idPraticien=' . $idPraticien);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }
}
