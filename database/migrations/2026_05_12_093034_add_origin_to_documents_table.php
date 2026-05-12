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
        Schema::table('documents', function (Blueprint $table) {
            // On renomme title en titre pour être cohérent avec le français partout
        if (Schema::hasColumn('documents', 'title')) {
            $table->renameColumn('title', 'titre');
        }
        
        // On ajoute le type de source (numérique ou physique)
        $table->enum('origine', ['numerique', 'physique'])->default('numerique');
        
        // Optionnel : un champ pour savoir où est rangé le papier
        $table->string('emplacement_physique')->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            //
        });
    }
};
