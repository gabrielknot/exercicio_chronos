<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailDuplicadoException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Models\Cliente;
use App\Models\Hobbie;
use Illuminate\Database\QueryException;

class ClienteController extends Controller
{
    // Busca um cliente por id
    public function index($id){
        $cliente = Cliente::with("hobbies")->with("cidade.estado")->findOrFail($id);
        return response()->json($cliente);
    }

    // Listar todos os cliente
    public function show(){

        $clientes = Cliente::with("hobbies")->with("cidade.estado")->get();
        $clientes->sortBy("nome");
        return response()->json($clientes->toArray());
    }

    // Inserir um cliente
    public function store(Request $request){

        $cliente = new Cliente();
        try{
            $cliente->nome = $request->input("nome");
            $cliente->email = $request->input("email");
            $cliente->cidade_id = $request->input("cidade_id");

            $cliente->save();
            $cliente->hobbies()->attach($request->input("hobbies"));
          
            return response()->json([$cliente->toArray()]);
        }catch(QueryException $e){
            throw new EmailDuplicadoException("Cliente não pode ser cadastrado: O email inserido já está sendo utilizado");
        }   
       
    }

    // Atualizar um cliente
    public function update(Request $request){


            $id_cliente = $request->input("id");
            $cliente = Cliente::find($id_cliente);

            $cliente->nome = $request->input("nome");
            $cliente->email = $request->input("email");
            $cliente->cidade_id = $request->input("cidade_id");
            try{
                $cliente->save();
            }catch(QueryException $e){
                throw new EmailDuplicadoException("Cliente não pode ser cadastrado: O email inserido já está sendo utilizado");
            }
            
            $cliente->hobbies()->sync($request->input("hobbies"));
            
            return response()->json([$cliente->toArray()]);
        
    }

    // Remove um cliente
    public function delete(Request $request){

        $id_cliente = $request->id;
        $cliente = Cliente::with("hobbies")->find($id_cliente);
        foreach($cliente->hobbies as $hobbie){
            if($hobbie->id > 5){
                Hobbie::destroy($hobbie->id);
            }
        }        

        Cliente::destroy($id_cliente);
        
        return response()->json([
            "mensagem" => "ok"
        ]);
    }
    
}
