<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producto_variedad', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_variedad');
            $table->integer('porcentaje')->nullable();

            $table->primary(['id_producto', 'id_variedad']);
            
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_variedad')->references('id_variedad')->on('variedads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_variedad');
    }
};
