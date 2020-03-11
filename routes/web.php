<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('vues.accueil');
});

Route::get('/signIn', function () {
    return view('vues.connexion');
});

Route::post('/signIn', 'VisiteurController@signIn');
Route::get('/signOut', 'VisiteurController@signOut');

Route::get('/lister', function () {
    return view('vues.listePraticien');
});
