<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->integer('id_veiculo');
            $table->string('modulo');
            $table->string('placa');
            $table->string('icone')->nullable();
            $table->string('lig')->nullable();
            $table->string('subcliente_nome')->nullable();
            $table->string('subcliente_id')->nullable();
            $table->string('cliente_nome')->nullable();
            $table->integer('cliente_id')->nullable();
            $table->string('data')->nullable();
            $table->string('color')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('lng')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('ano')->nullable();
            $table->string('anomodelo')->nullable();
            $table->string('cor')->nullable();
            $table->string('contato')->nullable();
            $table->string('telcontato')->nullable();
            $table->string('vel')->nullable();
            $table->string('velocidade')->nullable();
            $table->string('hodometro')->nullable();
            $table->string('horimetro')->nullable();
            $table->string('latencia')->nullable();
            $table->string('fix')->nullable();
            $table->string('status_online')->nullable();
            $table->string('tipo')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
