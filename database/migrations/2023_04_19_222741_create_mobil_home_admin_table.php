<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/* Tabla pivot para relacionar los móvil-homes con 
los administradores que los publican */
class CreateMobilHomeAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('mobil_home_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_home_id');
            $table->unsignedBigInteger('administrator_id');
            $table->timestamps();

            $table->foreign('mobil_home_id')->references('id')->on('mobil_homes');
            $table->foreign('administrator_id')->references('id')->on('administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil_home_admin');
    }
}