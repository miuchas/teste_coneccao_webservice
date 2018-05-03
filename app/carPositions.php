<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carPositions extends Model
{
  
  salvaCarPositions($list_car_pos){
    $car_pos = new carPositions;
    $car_pos->carPositions = $list_car_pos->carPositions;
    $car_pos->id_cliente = $list_car_pos->id_cliente;
    $car_pos->conectado = $list_car_pos->conectado;
    $car_pos->deconectado = $list_car_pos->deconectado;
    $car_pos->acionamentos = $list_car_pos->acionamentos;
    $car_pos->distancia_percorrida = $list_car_pos->distancia_percorrida;
    $car_pos->vel_max = $list_car_pos->vel_max;
    $car_pos->vel_med = $list_car_pos->vel_med;
    $car_pos->data = $list_car_pos->data;
    $car_pos->save();
  }
}
