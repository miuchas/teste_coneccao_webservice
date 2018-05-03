<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class userToken extends Model
{
  public function buscaToken($usuario){
    //testa se o token ainda tem validade
    $token = DB::connection("mysql")->select('select access_token from user_tokens where addtime(updated_at, SEC_TO_TIME(expires_in)) > CURRENT_TIMESTAMP and id_cliente="'.$usuario.'"');
    return $token[0]->access_token;
  }

  public function salvaToken($array_token, $usuario){
    //testa se ja existe token
    $cons = userToken::buscaToken($usuario);

    if( count($cons) > 0 ){
      return $cons;
    }
    else{
      $token = new userToken;
      $token->access_token = $array_token->access_token;
      $token->token_type = $array_token->token_type;
      $token->expires_in = $array_token->expires_in;
      $token->scope = $array_token->scope;
      $token->jti = $array_token->jti;
      $token->id_cliente = $usuario;
      $token->save();

      return $array_token->access_token;
    }
  }

}
