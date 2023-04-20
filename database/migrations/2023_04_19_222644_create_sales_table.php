<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/* Tabla para almacenar las ventas 
realizadas de los móvil-homes */
class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_home_id');
            $table->timestamps();

            $table->foreign('mobil_home_id')->references('id')->on('mobil_homes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
