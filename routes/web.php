<?php

use Illuminate\Support\Facades\Route;

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


Route::get("/", "Main@home")->name("home");

Route::get("/novo_cliente", "Main@novo_cliente")->name("novo_cliente");

Route::post("/novo_cliente", "Main@novo_cliente_submit")->name("novo_cliente_submit");

Route::get("editar_cliente/{id}", "Main@editar_cliente")->name("editar_cliente");

Route::put("/editar_cliente_submit", "Main@editar_cliente_submit")->name("editar_cliente_submit");

Route::get("/remover_cliente/{id}", "Main@remover_cliente")->name("remover_cliente");