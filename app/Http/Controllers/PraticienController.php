<?php

namespace App\Http\Controllers;

use App\DAO\ServicePraticien;
use App\DAO\ServiceVisiteur;
use Illuminate\Http\Request;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PraticienController extends Controller
{
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

    public function apiGetPraticienByNom(Request $request) {
        try {
            $nom = $request->input('nom');
            $praticien = new ServicePraticien();
            $lesPraticiens = $praticien->getPraticienByNom($nom);
            return view('api.listePraticien', compact('lesPraticiens'));
        }
        catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.error', compact('erreur'));
        }
    }
}
