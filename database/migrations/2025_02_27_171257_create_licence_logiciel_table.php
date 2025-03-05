<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenceLogicielTable extends Migration
{
    public function up()
    {
        Schema::create('licence_logiciel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('licence_id');
            $table->unsignedBigInteger('logiciel_id');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
            $table->foreign('logiciel_id')->references('id')->on('logiciels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('licence_logiciel');
    }
}
