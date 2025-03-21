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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(false);
            $table->string('type');
            $table->string('cout')->nullable(false);
            $table->enum('etat', ['en cours', 'terminé', 'en attente', 'annulé', 'reporté'])->default('en cours');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable(false);
            $table->foreignId('equipement_id')->constrained('equipements')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
