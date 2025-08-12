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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->string('email')->unique();
            $table->string('verification_email')->nullable();
            $table->string('password')->nullable(false);
            $table->enum('role', ['admin', 'technicien', 'utilisateur','editeur'])->nullable(false);
            $table->string('photo_util')->nullable();
            $table->enum('statut', ['actif', 'desactif', 'supprimer'])->default('desactif');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
