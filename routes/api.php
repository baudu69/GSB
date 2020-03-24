<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/listePraticien', 'PraticienController@apiGetAllPraticiens');
Route::post('/listePraticien', 'PraticienController@apiGetPraticienByNom');

Route::get('/delSpecialitePraticien', 'SpecialiteController@delSpecialitePraticien');
Route::get('/addSpecialitePraticien', 'SpecialiteController@addSpecialitePraticien');

Route::prefix('/json')->group(function () {
    Route::post('/signIn', 'VisiteurController@jsonApiSignIn');
    Route::prefix('/praticien')->group(function () {
        Route::get('/listePraticien', 'PraticienController@jsonApiGetAllPraticien')->middleware('webToken');
        Route::get('/listePraticienNom', 'PraticienController@jsonApiGetPraticienByNom')->middleware('webToken');
        Route::get('/listePraticienNomType', 'PraticienController@jsonApiGetPraticienByNomType')->middleware('webToken');
        Route::get('/listeTypes', 'PraticienController@jsonApiGetAllTypes')->middleware('webToken');
        Route::get('/listeActivite', 'ActiviteController@jsonApiListeActivite')->middleware('webToken');
        Route::delete('/supprimerActivite', 'ActiviteController@jsonApiDelActivitePraticien')->middleware('webToken');
        Route::get('/listeActivitesNonPraticien', 'ActiviteController@jsonApiListeActivitesNonPraticien')->middleware('webToken');
        Route::get('/ajouterActivitePraticien', 'ActiviteController@jsonApiAjouterActivitePraticien')->middleware('webToken');
        Route::post('/specialiser', 'ActiviteController@jsonApiSpecialiser');
    });
    Route::prefix('/activite')->group(function () {
        Route::get('/listerActivite', 'ActiviteController@jsonApiGetAllActivity')->middleware('webToken');
        Route::post('/ajoutActivite', 'ActiviteController@jsonApiAjoutActivite');
    });
});

