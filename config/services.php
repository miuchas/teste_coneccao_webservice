<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
     'client_id' => '',
     'client_secret' => '',
     'redirect' => 'http://localhost/tutorial-laravel/public/social/callback/facebook',
    ],

    'google' => [
     'client_id' => '',
     'client_secret' => '',
     'redirect' => 'http://localhost/tutorial-laravel/public/social/callback/google',
    ],


    // CLIENT_ID : getrakdemo
    // CLIENT_PASSWORD: getrakdemo
    // base64_encode('getrakdemo:getrakdemo');
    // BASE_64 : Z2V0cmFrZGVtbzpnZXRyYWtkZW1v

    'getrack' => [
      'grant_type'=>'password',
      'Content-Type' => 'application/ x-www-form-urlencoded;charset=UTF-8',
      'Authorization' => base64_encode("candidato:12345678"),
      'redirect' => 'https://api.getrak.com/newkoauth/oauth/token',
    ],

];
