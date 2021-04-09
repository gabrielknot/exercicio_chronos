<?php

namespace App\Http\Controllers;

use App\Models\Hobbie;
use Illuminate\Http\Request;

class HobbieController extends Controller
{

    // Buscar um hobbie por id
    public function index($id){
        $hobbie = Hobbie::find($id);
        return $hobbie;
    }

    // Listar hobbies
    public function show(){
        $hobbies = Hobbie::all();
        $hobbies->sortBy("id");
        return response()->json($hobbies->toArray());        
    }

    // Listar hobbies padrao
    public function showPadrao(){
        $hobbies = Hobbie::all()->take(5);
        $hobbies->sortBy("id");
        return response()->json($hobbies->toArray());        
    }

    // Inserir novo hobbie
    public function store(Request $request){
        $hobbie = new Hobbie();
        $hobbie->nome = $request->input("hobbie");
        $hobbie->save();
        return response()->json($hobbie->toArray());
    }
    
    // Atualizar hobbie
    public function update(Request $request){
        $hobbie = Hobbie::find($request->input("id"));
        $hobbie->nome = $request->input("hobbie");
        $hobbie->save();
        return response()->json($hobbie->toArray());
    }

    // Remove hobbie
    public function delete(Request $request){
        Hobbie::destroy($request->id);
        return response()->json([
            "mensagem" => "ok"
        ]);
    }
}
