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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipement_id')->constrained()->onDelete('cascade');
            // $table->string('numero_serie')->nullable();
            $table->foreignId('ancien_utilisateur_id')->nullable()->constrained('employes')->onDelete('set null');
            $table->foreignId('nouveau_utilisateur_id')->constrained('employes')->onDelete('set null');
            $table->date('date_passation')->default(now());
            $table->integer('temps_utilisation')->nullable(); // en jours
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
