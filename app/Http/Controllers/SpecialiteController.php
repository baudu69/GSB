<?php

namespace App\Http\Controllers;

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

    //TODO: Faire les verifications
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
}
