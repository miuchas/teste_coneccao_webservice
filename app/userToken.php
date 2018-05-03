<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userToken extends Model
{
  public function buscaToken($usuario){
    return userToken::where('id_cliente', $usuario)->first();
  }

  public function salvaToken($array_token){
    $cons = userToken::buscaToken(env("CONECTION_GETRAK_CLIENT_ID"));

    if( count($cons) > 0 ){
      return $cons->access_token;
    }
    else{
      $token = new userToken;
      $token->access_token = $array_token->access_token;
      $token->token_type = $array_token->token_type;
      $token->expires_in = $array_token->expires_in;
      $token->scope = $array_token->scope;
      $token->jti = $array_token->jti;
      $token->id_cliente = env('CONECTION_GETRAK_CLIENT_ID');
      $token->save();

      return $array_token->access_token;
    }
  }

}
