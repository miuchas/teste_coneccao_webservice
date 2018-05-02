<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Socialite;

use SimpleXMLElement;
use SoapClient;
use XMLWriter;
use SoapVar;
use Log;

class ConectionController extends Controller
{
    public function index(){
      ConectionController::conectionByCurl(
        env("CONECTION_GETRAK_CLIENT_ID"),
        env("CONECTION_GETRAK_CLIENT_PASSWD"),
        env("CONECTION_GETRAK_BASE_64")
      );
    }

    public function conectionByCurl($username, $password, $base64){
      $params='grant_type=password&'.
            'username='.$username.'&'.
            'password='.$password;

      $curl = curl_init();

      curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.getrak.com/newkoauth/oauth/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $params,
          CURLOPT_HTTPAUTH => true,
          CURLOPT_HTTPHEADER => array(
          	// Set here requred headers
              'Content-Type: application/x-www-form-urlencoded',
              'Accept: application/json',
              'Authorization: '.$base64,
          ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
          echo "Erro: " . $err;
      } else {
          $resp = json_decode($response);
          var_dump($resp->access_token);
          var_dump($resp->token_type);
          var_dump($resp->expires_in);
          var_dump($resp->scope);
          var_dump($resp->jti);
      }
    }

    //conecção com service_proveiders
    // public function __construct(){
    //  $this->middleware('guest');
    // }
    //
    //  public function getSocialAuth($provider=null)
    //  {
    //      if(!config("services.$provider")) abort('404');
    //
    //      return Socialite::driver($provider)->redirect();
    //  }
    //
    //
    //  public function getSocialAuthCallback($provider=null)
    //  {
    //     if($user = Socialite::driver($provider)->user()){
    //        dd($user);
    //     }else{
    //        return 'faio!!!';
    //     }
    //  }


}
