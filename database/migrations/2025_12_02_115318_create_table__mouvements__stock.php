<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       


        Schema::create('mouvements_stock', function (Blueprint $table) {
            $table->id();
            $table->integer("ArticleId");
            $table->foreign("ArticleId")->references("articleID")->on("articles");
            $table->enum('Type', ['Entrée','Sortie']);
            $table->enum('Source', ['Réception','Livraison','Inventaire','Ajustement']);
            $table->integer("Quantite");
            $table->integer("Stock_Avant");
            $table->integer("Stock_Apres");
            $table->integer("DetailCommandeAchat_ID")->references("DetailAchatID")->on("detailcommandeachats");
            $table->integer("DetailCommandevente_ID")->references("DetailVenteID")->on("detailcommandeventes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements_stock');
    }
};
