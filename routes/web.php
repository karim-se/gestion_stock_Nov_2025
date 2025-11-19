<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeAchatController;
use App\Http\Controllers\CommandeVenteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('Home');
});


Route::prefix('Articles')->name('articles.')->group(function () {
    Route::get('/Liste', [ArticleController::class, 'Liste_Articles'])->name('liste_articles');
    Route::get('Ajouter', [ArticleController::class, 'Ajouter_Article'])->name('create');
    Route::post('Ajouter', [ArticleController::class, 'Store_Article'])->name('store');
    Route::get('Modifier/{id}', [ArticleController::class, 'edit'])->name('edit');
    Route::post('Modifier/{id}', [ArticleController::class, 'update'])->name('update');
    Route::get('Supprimer/{id}', [ArticleController::class, 'Supprimer'])->name('Supprimer');
    Route::post('Delete/{id}', [ArticleController::class, 'Delete'])->name('delete');
});

Route::prefix('Achats')->name('achats.')->group(function () {
    Route::get('CommandeAchat', [CommandeAchatController::class, 'Liste_Comanande_Achats'])->name('commande_achats');
    Route::get('Liste/{id}', [CommandeAchatController::class, 'Liste_Achats'])->name('liste_achats');
    Route::get('Ajouter', [CommandeAchatController::class, 'Ajouter_CommandeAchat'])->name('create');
    Route::post('Ajouter', [CommandeAchatController::class, 'Store_CommandeAchat'])->name('store');
    Route::get('Modifier/{detailID}', [CommandeAchatController::class, 'edit'])->name('edit');
    Route::post('Modifier/{commandeID}/{detailID}', [CommandeAchatController::class, 'update'])->name('update');
    Route::get('Supprimer/{commandeID}/{detailID}', [CommandeAchatController::class, 'Supprimer'])->name('Supprimer');
    Route::post('Delete/{commandeID}/{detailID}', [CommandeAchatController::class, 'Delete'])->name('delete');
});

Route::prefix('Ventes')->name('ventes.')->group(function () {
    Route::get('Liste', [CommandeVenteController::class, 'Liste_Ventes'])->name('liste_ventes');
    Route::get('Ajouter', [CommandeVenteController::class, 'Ajouter_CommandeVente'])->name('create');
    Route::post('Ajouter', [CommandeVenteController::class, 'Store_CommandeVente'])->name('store');
    Route::get('Modifier/{id}', [CommandeVenteController::class, 'Edit'])->name('edit');
    Route::post('Update/{id}', [CommandeVenteController::class, 'Update'])->name('update');
    Route::get('Supprimer/{id}', [CommandeVenteController::class, 'Supprimer'])->name('Supprimer');
    Route::post('Delete/{id}', [CommandeVenteController::class, 'Delete'])->name('delete');
});





/****************************Authentification****************************************** */
// auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');