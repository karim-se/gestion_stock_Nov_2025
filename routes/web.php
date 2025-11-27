<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeAchatController;
use App\Http\Controllers\DetailCommandeAchatController;
use App\Http\Controllers\CommandeVenteController;
use App\Http\Controllers\DetailCommandeVenteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

// Page d'accueil accessible à tous
Route::get('/', function () {
    return view('Home');
});

// =======================
// Routes sécurisées (auth)
// =======================
Route::middleware(['auth', \App\Http\Middleware\NoCacheMiddleware::class])->group(function () {

    // Articles
    Route::prefix('Articles')->name('articles.')->group(function () {
        Route::get('/Liste', [ArticleController::class, 'Liste_Articles'])->name('liste_articles');
        Route::get('Ajouter', [ArticleController::class, 'Create'])->name('create');
        Route::post('Ajouter', [ArticleController::class, 'Store'])->name('store');
        Route::get('Modifier/{id}', [ArticleController::class, 'Edit'])->name('edit');
        Route::post('Modifier/{id}', [ArticleController::class, 'Update'])->name('update');
        Route::get('Supprimer/{id}', [ArticleController::class, 'Supprimer'])->name('Supprimer');
        Route::post('Delete/{id}', [ArticleController::class, 'Delete'])->name('delete');
    });

    // Achats
    Route::prefix('Achats')->name('achats.')->group(function () {
        Route::get('CommandeAchat', [CommandeAchatController::class, 'Liste_Comanande_Achats'])->name('commande_achats');
        Route::get('Commande_Achat/Ajouter', [CommandeAchatController::class, 'Create'])->name('create_commande');
        Route::post('Commande_Achat/Ajouter', [CommandeAchatController::class, 'Store'])->name('store_commande');
        Route::get('Modifier/{commandeID}', [CommandeAchatController::class, 'Edit'])->name('edit_commande');
        Route::post('Modifier/{commandeID}', [CommandeAchatController::class, 'Update'])->name('update_commande');
        Route::get('Supprimer/{commandeID}', [CommandeAchatController::class, 'Supprimer'])->name('supprimer_commande');
        Route::post('Delete/{commandeID}', [CommandeAchatController::class, 'Delete'])->name('delete_commande');

        Route::get('Liste/{id}', [DetailCommandeAchatController::class, 'Liste_Achats'])->name('liste_achats');
        Route::get('Detail_Commande_Achat/Ajouter/{commandeID}', [DetailCommandeAchatController::class, 'Create'])->name('create_detail');
        Route::post('Detail_Commande_Achat/Ajouter/{commandeID}', [DetailCommandeAchatController::class, 'Store'])->name('store_detail');
        Route::get('Detail_Commande_Achat/Modifier/{detailID}', [DetailCommandeAchatController::class, 'Edit'])->name('edit_detail');
        Route::post('Detail_Commande_Achat/Modifier/{commandeID}/{detailID}', [DetailCommandeAchatController::class, 'Update'])->name('update_detail');
        Route::get('Detail_Commande_Achat/Supprimer/{commandeID}/{detailID}', [DetailCommandeAchatController::class, 'Supprimer'])->name('Supprimer_detail');
        Route::post('Detail_Commande_Achat/Delete/{commandeID}/{detailID}', [DetailCommandeAchatController::class, 'Delete'])->name('delete_detail');
    });

    // Ventes
    Route::prefix('Ventes')->name('ventes.')->group(function () {
        Route::get("CommandeVente/Liste_Ventes",[CommandeVenteController::class, "Liste_Ventes"])->name("commandes_ventes");
        Route::get("CommandeVente/Ajouter", [CommandeVenteController::class,"Create"])->name("create_commande");
        Route::post("CommandeVente/Ajouter", [CommandeVenteController::class, "Store"])->name("store_commande");
        Route::get("CommandeVente/Modifier/{commandeID}",[CommandeVenteController::class,"Edit"])->name("edit_commande");
        Route::post("CommandeVente/modifier/{commandeID}",[CommandeVenteController::class,"Update"])->name("update_commande");
        Route::get("CommandeVente/Supprimer/{commandeID}",[CommandeVenteController::class,"Supprimer"])->name("supprimer_commande");
        Route::post("CommandeVente/Delete/{commandeID}",[CommandeVenteController::class,"Delete"])->name("delete_commande");

        Route::get('Detail_Commande/Liste/{id}', [DetailCommandeVenteController::class, 'Liste_Ventes'])->name('liste_ventes');
        Route::get('Detail_Commande_Vente/Ajouter/{commandeID}', [DetailCommandeVenteController::class, 'Create'])->name('create_detail');
        Route::post('Detail_Commande_Vente/Ajouter/{commandeID}', [DetailCommandeVenteController::class, 'Store'])->name('store_detail');
        Route::get('Detail_Commande_Vente/Modifier/{commandeID}', [DetailCommandeVenteController::class, 'Edit'])->name('edit_detail');
        Route::post('Detail_Commande_Vente/Update/{commandeID}/{detailID}', [DetailCommandeVenteController::class, 'Update'])->name('update_detail');
        Route::get('Detail_Commande_Vente/Supprimer/{commandeID}/{detailID}', [DetailCommandeVenteController::class, 'Supprimer'])->name('Supprimer_detail');
        Route::post('Detail_Commande_Vente/Delete/{commandeID}/{detailID}', [DetailCommandeVenteController::class, 'Delete'])->name('delete_detail');
    });

    // Logout sécurisé
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// =======================
// Routes pour les invités (login/register)
// =======================
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
