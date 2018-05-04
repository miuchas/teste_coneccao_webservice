<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\carPositions;
use App\cars;

class CarPositionsController extends Controller
{
  public function takeCarPositions($dataIni, $dataFim){
    $usuario = env("CONECTION_GETRAK_CLIENT_ID");
    //confere se todos os veiculos do usuario foram adicionados ao banco
    (new ConectionController)->listaVeiculos();

    //busca todos os carros cadastrados no banco
    $veiculos = (new cars)->buscaCarros($usuario);

    $data = "";
    $old_data = "";
    $numero_ent_vel = 0; //quantas vezes a entrada de velocidade foi maior que 0
    $velocidade_media = 0;
    $velocidade_maxima = 0;
    $conectado = 0;
    $desconectado = 0;
    $velocidade = 0;
    $acionamentos_entrada2 = 0;
    $odometro = 0;
    $reg_entradas = 0;
    $troca_dia = false;

    if($veiculos != "" && count($veiculos) > 0){
      foreach ($veiculos as $veiculo){
        $registros = (new ConectionController)->registrosVeiculo($veiculo->id_veiculo, $dataIni, $dataFim);

        if($registros != "" && count($registros) > 0){
          foreach ($registros as $reg){
            $data = date("d-m-Y", strtotime($reg->data));
            if($old_data == ""){
              $old_data = $data;
            }

            if($data != $old_data){ //testa se ja trocou o dia
              $troca_dia = true;
            }
            $velocidade = $reg->velocidade;
            if($velocidade > $velocidade_maxima){ //pega velocidade maxima por dia
              $velocidade_maxima = $velocidade;
            }

            if($velocidade > 0){ //ajuda a calcular a velocidade media do dia
              $velocidade_media += $velocidade;
              $numero_ent_vel ++;
            }
            
            if($reg->alimentacao == 1){ $conectado += 1; }//numero de entradas conectado/desconectado
            else{ $desconectado ++; }


            if(substr($reg->entradas, 2, 1) == 1){
              $acionamentos_entrada2 ++;
            }

            $odometro = $reg->odometro;

            if($troca_dia){
              $media = 0;
              if($velocidade_media > 0 && $numero_ent_vel > 0){
                $media = $velocidade_media/$numero_ent_vel;
              }

              $parametros = array(
                'carPositions' => $conectado + $desconectado,
                'usuario' => $usuario,
                'id_carro' => $veiculo->id_veiculo,
                'conectado' => $conectado,
                'deconectado' => $desconectado,
                'acionamentos' => $acionamentos_entrada2,
                'distancia_percorrida' => $odometro,
                'vel_max' => $velocidade_maxima,
                'vel_med' => $media,
                'data' => $old_data,
              );
              (new carPositions)->salvaCarPositions($parametros);

              $numero_ent_vel = 0;
              $velocidade_media = 0;
              $velocidade_maxima = 0;
              $conectado = 0;
              $desconectado = 0;
              $velocidade = 0;
              $acionamentos_entrada2 = 0;
              $odometro = 0;
              $reg_entradas = 0;
              $troca_dia = false;
            }

            $old_data = $data;
          }
        }
      }
    }
  }



}
