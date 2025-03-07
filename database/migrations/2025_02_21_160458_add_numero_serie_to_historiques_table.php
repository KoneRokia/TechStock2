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
        Schema::table('historiques', function (Blueprint $table) {
            $table->string('numero_serie')->nullable()->after('equipement_id');
        });
    }

    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropColumn('numero_serie');
        });
    }
};
