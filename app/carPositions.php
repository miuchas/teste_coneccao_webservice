<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carPositions extends Model
{

  public function carPositionsExist($list_car_pos){
    $cons = carPositions::where('usuario', $list_car_pos['usuario'])->where('id_carro', $list_car_pos['id_carro'])->where('data', $list_car_pos['data'])->first();
    if( count($cons) > 0 || $cons != ""){ return false; }
    else return true;
  }

  public function salvaCarPositions($list_car_pos){
    if(carPositions::carPositionsExist($list_car_pos)){
      $car_pos = new carPositions;
      $car_pos->carPositions = $list_car_pos['carPositions'];
      $car_pos->usuario = $list_car_pos['usuario'];
      $car_pos->id_carro = $list_car_pos['id_carro'];
      $car_pos->conectado = $list_car_pos['conectado'];
      $car_pos->deconectado = $list_car_pos['deconectado'];
      $car_pos->acionamentos = $list_car_pos['acionamentos'];
      $car_pos->distancia_percorrida = $list_car_pos['distancia_percorrida'];
      $car_pos->vel_max = $list_car_pos['vel_max'];
      $car_pos->vel_med = $list_car_pos['vel_med'];
      $car_pos->data = $list_car_pos['data'];
      $car_pos->save();
    }
  }
}
