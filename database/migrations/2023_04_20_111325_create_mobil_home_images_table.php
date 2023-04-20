<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilHomeImagesTable extends Migration
{
    public function up()
    {
        Schema::create('mobil_home_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_home_id');
            $table->foreign('mobil_home_id')->references('id')->on('mobil_homes')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mobil_home_images');
    }
}

/*
Para agregar imágenes a una publicación, 
puedes usar el método "create" en la relación "images":
        $mobilHome = new MobilHome;
        $mobilHome->name = 'Mi mobil home';
        $mobilHome->price = 10000;
        $mobilHome->save();

        $mobilHome->images()->create([
            'image_path' => 'ruta/de/la/imagen.jpg'
        ]);
Este código creará una nueva publicación y una imagen relacionada. 
Puedes agregar más imágenes usando el mismo método "create" en la 
relación "images".

Para obtener todas las imágenes de una publicación, puedes acceder 
a la relación "images":
        $mobilHome = MobilHome::find(1);
        $images = $mobilHome->images;
*/