<?php

use App\Http\Controllers\CommandeAchatController;
use App\Http\Controllers\CommandeVenteController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;

Route ::get('/Articles',[ArticleController::class, 'Liste_Articles'])->name('Listes_Articles');


Route::get('/Articles/Ajouter_Article',[ArticleController::class,'Ajouter_Article']);
Route::Post('/Articles/Ajouter_Article',[ArticleController::class,'Store_Article'])->name('Store_Article');

Route::get('/Articles/Modifier_Article/{id}',[ArticleController::class,'edit'])->name('articles.edit');;
Route::Post('/Articles/Modifier_Article/{id}',[ArticleController::class,'update'])->name('articles.update');


Route::get('/Article/Supprimer_Article/{id}', [ArticleController::class,"Supprimer"])->name('Supp_Article');
Route::Post("/Article/Supprimer_Article/{id}", [ArticleController::class, "Delete"])->name("Delete_Article");


Route::get('Achats/Ajouter_CommandeAchat',[CommandeAchatController::class,'Ajouter_CommandeAchat']);
Route::post('Achats/Ajouter_CommandeAchat',[CommandeAchatController::class,'Store_CommandeAchat'])->name('Store_CommandeAchat');



Route::get("Ventes/Ajouter_CommandeVente",[CommandeVenteController::class ,'Ajouter_CommandeVente'] );
Route::post("Ventes/Ajouter_CommandeVente",[CommandeVenteController::class,"Store_CommandeVente"] )->name("Store_CommandeVente");