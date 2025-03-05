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
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string('cle_licence')->unique();
            $table->string('type'); // Exemple : "abonnement", "perpétuel"
            $table->integer('nombre_utilisateurs')->default(1);
            $table->date('date_expiration')->nullable();
            $table->enum('etat', ['active', 'expirée', 'bientôt expirée'])->default('active');
            $table->timestamps();
                    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licences');
    }
};
