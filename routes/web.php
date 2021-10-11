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

Route::get('/', [App\Http\Controllers\Paths::class, 'welcome']);

// connexion au site
Route::get('/connexion', [App\Http\Controllers\Paths::class, 'login']);


// création d'un compte
Route::get('/register', [App\Http\Controllers\Paths::class, 'register']);
Route::get('/handleRegister', [App\Http\Controllers\Paths::class, 'handleRegister']);

//CLIENT
Route::get('/liste_livraison/{id}', [App\Http\Controllers\Paths::class, 'liste_livraison']);
Route::get('/liste_ramassage/{id}', [App\Http\Controllers\Paths::class, 'liste_ramassage']);
Route::get('/ramassage/{id}', [App\Http\Controllers\Paths::class, 'ramassage']);
Route::get('/livraison/{id}', [App\Http\Controllers\Paths::class, 'livraison']);
Route::get('/add_ramassage', [App\Http\Controllers\Paths::class, 'add_ramassage']);
Route::get('/add_livraison', [App\Http\Controllers\Paths::class, 'add_livraison']);
Route::get('/editer/livreur/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'editer_livreur']);
Route::get('/commentaire/livreur/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'commentaire_livreur']);
Route::get('/handle_commentaire/livreur', [App\Http\Controllers\Paths::class, 'handle_commentaire_livreur']);
Route::get('/changer_etat/livreur/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'changer_etat_livreur']);
Route::get('/handle_changer_etat/livreur', [App\Http\Controllers\Paths::class, 'handle_changer_etat_livreur']);

Route::get('/editer/client/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'editer_client']);
Route::get('/changer_destinataire/client/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'changer_destinataire']);
Route::get('/handle_changer_destinataire/client', [App\Http\Controllers\Paths::class, 'handle_changer_destinataire_client']);
Route::get('/deliver/{id}', [App\Http\Controllers\Paths::class, 'deliver']);


//ADMIN 
Route::get('/nouveau_colis/{id}', [App\Http\Controllers\Paths::class, 'nouveau_colis']);
Route::get('/colis_en_traitement/{id}', [App\Http\Controllers\Paths::class, 'colis_en_traitement']);
Route::get('/liste_client/{id}', [App\Http\Controllers\Paths::class, 'liste_client']);
Route::get('/liste_livreur/{d}', [App\Http\Controllers\Paths::class, 'liste_livreur']);
Route::get('/ajouter_livreur/{d}', [App\Http\Controllers\Paths::class, 'ajouter_livreur']);
Route::get('/ajouter_client/{d}', [App\Http\Controllers\Paths::class, 'ajouter_client']);
Route::get('/add_client/{d}', [App\Http\Controllers\Paths::class, 'add_client']);
Route::get('/add_livreur/{d}', [App\Http\Controllers\Paths::class, 'add_livreur']);

//PROFILE
Route::get('/user_detail/{id}', [App\Http\Controllers\Paths::class, 'user_detail']);
Route::get('/change_password/{id}', [App\Http\Controllers\Paths::class, 'change_password']);
Route::get('/replace_password', [App\Http\Controllers\Paths::class, 'replace_password']);
Route::get('/delete_count/{id}', [App\Http\Controllers\Paths::class, 'delete_count']);
Route::get('/user_detail_switch/{id}', [App\Http\Controllers\Paths::class, 'user_detail_switch']);
Route::get('/editer/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'editer']);
Route::get('/update/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'update']);
Route::get('/choose_livreur/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'choose_livreur']);
Route::get('/delete/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'delete']);
Route::get('/handle_choose_livreur', [App\Http\Controllers\Paths::class, 'handle_choose_livreur']);
Route::get('/handle_update', [App\Http\Controllers\Paths::class, 'handle_update']);
Route::get('/changer_etat/{id}/{id_colis}', [App\Http\Controllers\Paths::class, 'changer_etat']);
Route::get('/handle_changer_etat', [App\Http\Controllers\Paths::class, 'handle_changer_etat']);


//Recherecher
Route::get('/rechercher', [App\Http\Controllers\Paths::class, 'rechercher']);



/*
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/