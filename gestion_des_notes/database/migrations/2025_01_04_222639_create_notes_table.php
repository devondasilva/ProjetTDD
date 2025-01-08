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
        Schema::create('notes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // Clé étrangère vers 'etudiants'
            $table->foreignId('etudiant_id')
                ->constrained('etudiants')  // Ajoute la contrainte pour la table 'etudiants'
                ->onDelete('cascade');     // Supprime les notes si l'étudiant est supprimé
            $table->index('etudiant_id'); // Ajout de l'index explicitement

            // Clé étrangère vers 'ecs'
            $table->foreignId('ec_id')
                ->constrained('ecs')       // Ajoute la contrainte pour la table 'ecs'
                ->onDelete('cascade');     // Supprime les notes si l'EC est supprimé
            $table->index('ec_id'); // Ajout de l'index explicitement

            // Note de l'étudiant pour cet EC
            $table->decimal('note', 5, 2)
                ->check('note >= 0 and note <= 20'); // Validation de la note entre 0 et 20

            // Session d'évaluation (normale ou rattrapage)
            $table->enum('session', ['normale', 'rattrapage']);

            // Date d'évaluation
            $table->date('date_evaluation');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

