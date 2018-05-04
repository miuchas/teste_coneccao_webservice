<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_positions', function (Blueprint $table) {
            $table->string('carPositions');
            $table->string('usuario');
            $table->integer('id_carro');
            $table->integer('conectado');
            $table->integer('deconectado');
            $table->integer('acionamentos');
            $table->float('distancia_percorrida', 8, 2);
            $table->float('vel_max', 8, 2);
            $table->float('vel_med', 8, 2);
            $table->string('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_positions');
    }
}
