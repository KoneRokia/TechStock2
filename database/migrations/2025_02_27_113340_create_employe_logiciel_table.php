<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    //Relation n a n

    public function up(): void
    {
        Schema::create('employe_logiciel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('logiciel_id');
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('cascade');
            $table->foreign('logiciel_id')->references('id')->on('logiciels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_logiciel');
    }
};
