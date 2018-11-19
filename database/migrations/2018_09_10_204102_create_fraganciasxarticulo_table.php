<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraganciasxarticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraganciasxarticulo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_articulo')->unsigned();
            $table->foreign('id_articulo')->references('codigo')->on('productos')->onDelete('cascade');
            $table->integer('id_fragancia')->unsigned();
            $table->foreign('id_fragancia')->references('codigo')->on('fragancias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fraganciasxarticulo');
    }
}
