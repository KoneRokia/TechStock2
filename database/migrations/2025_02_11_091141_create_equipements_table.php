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
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable(false);
            $table->string('type')->nullable(false);
            $table->string('cout')->nullable(false);
            $table->enum('etat', ['actif', 'en panne', 'hors service'])->nullable(false);
            $table->date('date_achat')->nullable(false);
            $table->string('nom_utilisateur')->nullable();
            $table->string('numero_serie')->unique();
            $table->string('marque')->nullable(false);
            $table->text('caracteristique')->nullable(false);
            $table->string('photo_equip')->nullable();
            $table->integer('totalEquipements')->nullable();
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
