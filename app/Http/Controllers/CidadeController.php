<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Cidade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    // Listar cidaddes pelo nome do estado
    public function showByEstado(Request $request){
        $nome_estado = $request->nome;
        $cidades = Cidade::wherehas("estado", function (Builder $query) use($nome_estado){
            $query->where("nome", "=", $nome_estado);
        })->get();
        return response()->json($cidades->toArray());
    }

    // Listar cidades pelo id do estado
    public function showByEstadoId(Request $request){
        $cidades = Cidade::where("estado_id", "=", $request->id)->get();
        return response()->json($cidades->toArray());
    }
}
