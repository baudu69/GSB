<?php

namespace App\Http\Controllers;

use App\DAO\ServicePraticien;
use App\DAO\ServiceTypes;
use App\DAO\ServiceVisiteur;
use Illuminate\Http\Request;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PraticienController extends Controller
{
    /**
     * API: renvoie un tableau HTML avec la liste de tous les praticiens
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apiGetAllPraticiens() {
        try {
            $praticien = new ServicePraticien();
            $lesPraticiens = $praticien->getAllPraticien();
            return view('api.listePraticien', compact('lesPraticiens'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * API: renvoie un tableau HTML avec la liste de tous les praticiens dont le nom correspond a $nom
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apiGetPraticienByNom(Request $request) {
        try {
            $nom = $request->input('nom');
            $specialite = $request->input('specialite');
            $praticien = new ServicePraticien();
            if ($specialite == '')
                $lesPraticiens = $praticien->getPraticienByNom($nom);
            else
                $lesPraticiens = $praticien->getPraticienByNomSpecialite($nom, $specialite);
            return view('api.listePraticien', compact('lesPraticiens'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * JSONAPI : Renvoie la liste de tous les praticiens
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function jsonApiGetAllPraticien() {
        try {
            $praticien = new ServicePraticien();
            $lesPraticiens = $praticien->getAllPraticien();
            return json_encode($lesPraticiens);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * JSONAPI : Renvoie la liste de tous les praticiens dont le nom correspond a $nom
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function jsonApiGetPraticienByNom(Request $request) {
        try {
            $nom = $request->input('nomPraticien');
            $praticien = new ServicePraticien();
            $lesPraticiens = $praticien->getPraticienByNom($nom);
            return json_encode($lesPraticiens);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * JSONAPI : Renvoie la liste de tous les praticiens dont le nom correspond a $nom
     * et dont le type correspond a $type
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function jsonApiGetPraticienByNomType(Request $request) {
        try {
            $nom = $request->input('nomPraticien');
            $type = $request->input('type');
            if ($type == '')
                return $this->jsonApiGetPraticienByNom($request);
            $praticien = new ServicePraticien();
            $lesPraticiens = $praticien->getPraticienByNomType($nom, $type);
            return json_encode($lesPraticiens);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }

    /**
     * JSONAPI : Renvoie la liste de tous les types de praticien
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function jsonApiGetAllTypes() {
        try {
            $type = new ServiceTypes();
            $lesTypes = $type->getAllTypes();
            return json_encode($lesTypes);
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }
}
