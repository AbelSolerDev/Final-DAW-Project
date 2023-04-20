<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/* Tabla para almacenar la información de los móvil-homes 
disponibles en la aplicación. Contiene información como el nombre, 
la descripción, el precio de mercado, si está en venta, el precio 
con descuento, el porcentaje de descuento, si está en destacado, 
si es favorito, si está disponible, la imagen y las marcas de tiempo */
class CreateMobilHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('mobil_homes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('on_sale')->default(false);
            $table->decimal('discounted_price', 10, 2)->nullable(); 
            $table->unsignedInteger('discount_percentage')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('favorite')->default(false);
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }
    /*
     *cuando se cree una promoción, se podría actualizar el campo discount_percentage en 
     *la tabla mobil_homes con el porcentaje de descuento correspondiente, y calcular el 
     *precio con descuento en función de ese valor. Por ejemplo, si el descuento es del 20%, se podría hacer:
     * $discounted_price = $mobil_home->price * (1 - ($mobil_home->discount_percentage / 100));
     */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil_homes');
    }
}
