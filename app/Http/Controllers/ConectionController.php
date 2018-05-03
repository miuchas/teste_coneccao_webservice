<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\cars;
use App\userToken;
use Auth;

class ConectionController extends Controller
{
  public function takeUserToken(){
    $usuario = env("CONECTION_GETRAK_CLIENT_ID");
    $cons = (new userToken)->buscaToken($usuario);

    if( $cons != "" ){
      return $cons;
    }
    else{
      $resp = ConectionController::conectionPostByCurl(
        env("CONECTION_GETRAK_CLIENT_ID"),
        env("CONECTION_GETRAK_CLIENT_PASSWD"),
        env("CONECTION_GETRAK_BASE_64")
      );
      (new userToken)->salvaToken($resp, $usuario);
      return $resp->access_token;
    }
  }

  public function paradaVeiculo($id, $dataIni, $dataFim){
   $url = 'https://api.getrak.com/v0.1/public/deslocamentos/'.$id."/".$dataIni."/".$dataFim;
   $resp = ConectionController::conectionGetByCurl($url);
   var_dump($resp);
  }

  public function trajetoVeiculo($id, $dataIni, $dataFim){
    $url = 'https://api.getrak.com/v0.1/public/trajetos/'.$id."/".$dataIni."/".$dataFim;
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
  }

  public function entradasVeiculo($id, $dataIni, $dataFim){
    $url = 'https://api.getrak.com/v0.1/public/entradas/'.$id."/".$dataIni."/".$dataFim;
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
  }

  public function registrosVeiculo($id, $dataIni, $dataFim){
    $url = 'https://api.getrak.com/v0.1/public/recebidos/'.$id."/".$dataIni."/".$dataFim;
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
  }

  public function telemetria(){
    $limit = 100;//numero de registros
    $offset = 20;//lista de registros por pagina
    $url = 'https://api.getrak.com/v0.1/public/telemetrias?limit='.$limit.'&offset='.$offset;
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
  }

  public function localizacoesVeiculo($id, $modolo){
    $url = 'https://api.getrak.com/v0.1/public/localizacoes?id='.$id.'&modulo='.$modolo;
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
  }

  public function listaVeiculos(){
    $url = 'https://api.getrak.com/v0.1/public/localizacoes';
    $resp = ConectionController::conectionGetByCurl($url);
    var_dump($resp);
    (new cars)->salvaCarros($resp);
  }

  public function conectionPostByCurl($username, $password, $base64){
    $params=
      'grant_type=password&'.
      'username='.$username.'&'.
      'password='.$password;

    //inicia comando curl
    $curl = curl_init();

    //seta opções
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.getrak.com/newkoauth/oauth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_HTTPAUTH => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
            'Authorization: '.$base64,
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    //finaliza curl
    curl_close($curl);

    if ($err) {
      echo "Erro: " . $err;
    } else {
      $resp = json_decode($response);
      return $resp;
    }
  }


  public function conectionGetByCurl($url){
    $token = ConectionController::takeUserToken();

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "Erro:" . $err;
    } else {
      $resp = json_decode($response);
      return $resp;
    }
  }

}
