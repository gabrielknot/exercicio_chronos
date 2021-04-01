<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    // Listar todos os estados
    public function show(){
        $estados = Estado::all();
        return response()->json($estados);
    }
}
