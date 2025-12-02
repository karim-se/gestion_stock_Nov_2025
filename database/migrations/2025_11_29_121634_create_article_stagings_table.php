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
        Schema::create('article_staging', function (Blueprint $table) {
        $table->id();
        $table->string('NomArticle');
        $table->string('CodeArticle')->unique();

        // 🔥 Compatible avec categorie.CategorieID (int(11))
        $table->Integer('categorieID');
        $table->foreign('categorieID')
              ->references('CategorieID')
              ->on('categorie')
              ->onDelete('cascade');

        $table->text('Description')->nullable();
        $table->decimal('PrixAchatStandard', 10, 2)->nullable();
         $table->decimal('PrixVenteStandard', 10, 2)->nullable();
        $table->enum('statut', ['en_attente', 'valide', 'rejete'])->default('en_attente');
         $table->Integer('StockActuel');
         $table->Integer('StockMinimum');

        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('set null');

        $table->timestamp('validated_at')->nullable();
        $table->text('raison_rejet')->nullable();

        $table->timestamps();
        $table->index('statut');
        $table->index('created_by');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_staging');
    }
};
