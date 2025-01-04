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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->onDelete('cascade'); // Clé étrangère vers Etudiants
            $table->foreignId('ue_id')->constrained()->onDelete('cascade'); // Clé étrangère vers UEs
            $table->string('semestre'); // Semestre de l'inscription
            $table->boolean('validated')->default(false); // Statut de validation de l'UE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
