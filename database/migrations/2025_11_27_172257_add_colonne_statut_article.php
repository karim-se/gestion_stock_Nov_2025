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
         Schema::table('article_stagings', function (Blueprint $table) {
            // Renomme l'ancienne colonne 'NomArtcile' en 'nom_article' (convention snake_case)
            $table->integer("statut_id");
           
         });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
