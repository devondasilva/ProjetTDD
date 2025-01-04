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
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade'); // Clé étrangère vers etudiants
            $table->foreignId('ec_id')->constrained('ecs')->onDelete('cascade'); // Clé étrangère vers elements_constitutifs
            $table->decimal('note', 5, 2);
            $table->enum('session', ['normale', 'rattrapage']);
            $table->date('date_evaluation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
