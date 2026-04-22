<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->integer('cantidad')->default(0);
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');
            $table->string('pais', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('contenido_ml')->nullable();
            $table->integer('anio_cosecha')->nullable();
            $table->decimal('alcohol_porcentaje', 4, 2)->nullable();
            $table->string('imagen_url', 500)->nullable();
            $table->decimal('descuento', 5, 2)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
            $table->foreign('id_marca')->references('id_marca')->on('marcas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
