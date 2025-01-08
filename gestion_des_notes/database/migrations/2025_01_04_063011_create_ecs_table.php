<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->integer('coefficient')->unsigned();
            $table->foreignId('ue_id');
            $table->foreignId('responsable_id'); // Permet les valeurs nulles
            $table->timestamps();
        });

    }

    public function down(): void
    {


        Schema::dropIfExists('ecs');
    }
};
