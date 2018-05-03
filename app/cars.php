<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{
  public function buscaCarro($id){
    $cons = cars::where('id_veiculo', $id)->get();

    if( count($cons) > 0){ return false; }
    else return true;
  }

  public function salvaCarros($lista_carros){
    foreach ($lista_carros->veiculos as $carro){
      if(cars::buscaCarro($carro->id_veiculo)){
        $car = new cars;
        $car->id_veiculo = $carro->id_veiculo;
        $car->modulo = $carro->modulo;
        $car->placa = $carro->placa;
        $car->icone = $carro->icone;
        $car->lig = $carro->lig;
        $car->subcliente_nome = $carro->subcliente_nome;
        $car->subcliente_id = $carro->subcliente_id;
        $car->cliente_nome = $carro->cliente_nome;
        $car->cliente_id = $carro->cliente_id;
        $car->data = $carro->data;
        $car->color = $carro->color;
        $car->lat = $carro->lat;
        $car->lon = $carro->lon;
        $car->lng = $carro->lng;
        $car->marca = $carro->marca;
        $car->modelo = $carro->modelo;
        $car->ano = $carro->ano;
        $car->anomodelo = $carro->anomodelo;
        $car->cor = $carro->cor;
        $car->contato = $carro->contato;
        $car->telcontato = $carro->telcontato;
        $car->vel = $carro->vel;
        $car->velocidade = $carro->velocidade;
        $car->hodometro = $carro->hodometro;
        $car->horimetro = $carro->horimetro;
        $car->latencia = $carro->latencia;
        $car->fix = $carro->fix;
        $car->status_online = $carro->status_online;
        $car->tipo = $carro->tipo;
        $car->save();
      }
    }
  }

}
