<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('social/{provider?}', 'ConectionController@getSocialAuth');
Route::get('social/callback/{provider?}', 'ConectionController@getSocialAuthCallback');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'ConectionController@takeUserToken');

Route::get("/deslocamentos/{id?}/{dataIni?}/{dataFim?}", 'ConectionController@paradaVeiculo'); //Lista de deslocamentos e paradas do veículo
Route::get("/trajetos/{id?}/{dataIni?}/{dataFim?}", 'ConectionController@trajetoVeiculo'); //Lista de trajetos do veículo
Route::get("/entradas/{id?}/{dataIni?}/{dataFim?}", 'ConectionController@entradasVeiculo'); //Intervalo de ativação das entradas do veículo
Route::get("/recebidos/{id?}/{dataIni?}/{dataFim?}", 'ConectionController@registrosVeiculo'); //Relatorio de ultimos registros
Route::get("/telemetrias", 'ConectionController@telemetria'); //Relatorio de telemetrias

Route::get("/localizacoes/{id?}/{modolo?}", 'ConectionController@localizacoesVeiculo'); //lista ultima localização do veiculo
Route::get("/equipamentos", 'ConectionController@listaVeiculos'); //lista veiculos cadastrados


Route::get("/resumo-diario/{dataIni?}/{dataFim?}", 'CarPositionsController@takeCarPositions'); //resumo das atividades diarias do veiculo
