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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(false);
            $table->string('titre');
            $table->date('date_generation');
            $table->text('description');
            $table->string('fichier')->nullable(); // Stocker le fichier du rapport
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
        Schema::dropIfExists('rapports');
    }
};
