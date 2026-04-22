<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria');
            $table->string('nombre', 100);
            $table->unsignedBigInteger('nombre_padre')->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->integer('nivel')->default(1);
            $table->timestamps();

            $table->foreign('nombre_padre')->references('id_categoria')->on('categorias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};
