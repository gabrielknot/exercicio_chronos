<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HobbieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Cliente Routes
Route::get("/cliente/{id}", "ClienteController@index")->name("api_buscar_cliente");
Route::get("/clientes", "ClienteController@show")->name("api_listar_clientes");
Route::post("/cliente", "ClienteController@store")->name("api_inserir_cliente");
Route::put("/cliente", "ClienteController@update")->name("api_atualizar_cliente");
Route::delete("/cliente/{id}", "ClienteController@delete")->name("api_remover_cliente");

// Estados Routes
Route::get("/estados", "EstadoController@show")->name("api_listar_estados");

// Cidades Routes
Route::get("estado_id/cidades/{id}", "CidadeController@showByEstadoId")->name("api_listar_cidades_por_estado_id");
Route::get("estado/cidades/{nome}", "CidadeController@showByEstado")->name("api_listar_cidades_por_estado");

// Hobbies Routes
Route::get("/hobbie/{id}", "HobbieController@index")->name("api_buscar_hobbie");
Route::get("/hobbies", "HobbieController@show")->name("api_listar_hobbies");
Route::get("/hobbies_padrao", "HobbieController@showPadrao")->name("api_listar_hobbies_padrao");
Route::post("/hobbie", "HobbieController@store")->name("api_inserir_hobbie");
Route::put("/hobbie", "HobbieController@update")->name("api_atualizar_hobbie");
Route::delete("/hobbie/{id}", "HobbieController@delete")->name("api_remover_hobbie");