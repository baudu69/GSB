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
    Route::get('/listePraticien', 'PraticienController@jsonApiGetAllPraticien');
    Route::get('/listePraticienNom', 'PraticienController@jsonApiGetPraticienByNom');
    Route::get('/listePraticienNomType', 'PraticienController@jsonApiGetPraticienByNomType');
    Route::get('/listeTypes', 'PraticienController@jsonApiGetAllTypes');
});
