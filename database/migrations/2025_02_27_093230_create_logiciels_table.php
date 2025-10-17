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
        Schema::create('logiciels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('version')->nullable();
            $table->string('editeur')->nullable();
            $table->string('type'); // Exemple : "payant", "open-source"
            $table->date('date_achat')->nullable();
            $table->date('date_expiration')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
             $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('logiciels');
    }
};
