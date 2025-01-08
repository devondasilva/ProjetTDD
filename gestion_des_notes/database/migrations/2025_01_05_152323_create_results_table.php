<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('results', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade'); // Clé étrangère vers etudiants
        $table->foreignId('ec_id')->constrained('ecs')->onDelete('cascade'); // Clé étrangère vers ECS
        $table->decimal('note', 5, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('results');
}

};
