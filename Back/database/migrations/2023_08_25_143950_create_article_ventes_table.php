<?php

use App\Models\Categorie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Categorie::class)->constrained();
            $table->string('libelle')->unique();
            $table->float('valeurPromo')->nullable();
            $table->float('marge')->nullable();
            $table->float('prixVente');
            $table->float('coutProd');
            $table->float('stock');
            $table->string('photo')->nullable();
            $table->string('reference')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_ventes');
    }
};
