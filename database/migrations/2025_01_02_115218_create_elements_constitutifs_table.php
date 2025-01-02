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
    Schema::create('elements_constitutifs', function (Blueprint $table) {
        $table->id(); 
        $table->string('code'); 
        $table->string('nom'); 
        $table->decimal('coefficient', 5, 2); 
        $table->unsignedBigInteger('ue_id'); 
        $table->timestamps(); 

       
        $table->foreign('ue_id')->references('id')->on('ues')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements_constitutifs');
    }
};
