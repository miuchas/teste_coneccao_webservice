<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{


  public function up()
  {
      Schema::create('cars', function (Blueprint $table) {
        $table->integer('id_veiculo');
        $table->string('modulo');
        $table->string('placa');
        $table->string('icone');
        $table->string('lig');
        $table->string('subcliente_nome');
        $table->string('subcliente_id');
        $table->string('cliente_nome');
        $table->integer('cliente_id');
        $table->string('data');
        $table->string('color');
        $table->string('lat');
        $table->string('lon');
        $table->string('lng');
        $table->string('marca');
        $table->string('modelo');
        $table->string('ano');
        $table->string('anomodelo');
        $table->string('cor');
        $table->string('contato');
        $table->string('telcontato');
        $table->string('vel');
        $table->string('velocidade');
        $table->string('hodometro');
        $table->string('horimetro');
        $table->string('latencia');
        $table->string('fix');
        $table->string('status_online');
        $table->string('tipo');
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
