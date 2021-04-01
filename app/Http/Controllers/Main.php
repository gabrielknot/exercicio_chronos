<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Main extends Controller
{

    // Funcao responsavel por criar uma lista com os hobbies selecionados
    private function gerar_lista_hobbies($request){
        $hobbies = array();
        $aux = 0;
        for ($i = 0; $i < 5; $i++){  // Existem 5 hobbies padrao
            $hobbie = $request->input("h" . $i, "null"); // Pega os hobbies no request - pelo padrao ['h' + indice]
            if($hobbie == "null"){
                continue;
            }
            $hobbies[$aux] = $hobbie; // adiciona o hobbie a lista
            $aux++;
        }
        return $hobbies;
    }

    // Chamar a Pagina inicial
    public function home(){
        $response = Http::get(route("api_listar_clientes")); //lista de clientes
        return View("home", ["clientes" => $response->json()]);   
    }

    // Chamar a pagina de cadastro de cliente
    public function novo_cliente(){
        
        $responseEstados = Http::get(route("api_listar_estados")); // lista de estados
        $responseHobbies = Http::get(route("api_listar_hobbies_padrao")); // lista de hobbies padrao
        
        return View("novo_cliente_form", [
            "estados" => $responseEstados->json(),
            "cidades" => [],
            "hobbies" => $responseHobbies->json()
        ]);       
    }


    // Envia as informacoes do novo cliente para as devidas partes da api
    public function novo_cliente_submit(Request $request){
        
        $hobbies = $this->gerar_lista_hobbies($request);

        $aux = 5; // Quantidade padrao de hobbies
        $hobbie_outro = $request->input("h_outro", "null");
        
        // Verifica se foi informado um hobbie no campo outro
        if($hobbie_outro != "null"){ 
            $responseHobbie = Http::post(route("api_inserir_hobbie"), [
                "hobbie" => $hobbie_outro
            ]); // Cria novo hobbie

            $hobbies[$aux] = "" . $responseHobbie->json()["id"]; // Adiciona a lista de hobbies
        }
        
        $responseCliente = Http::post(route("api_inserir_cliente"), [
          "nome" => $request->input("nome"),
          "email" => $request->input("email"),
          "cidade_id" => $request->input("cidade_id"),
          "hobbies" => $hobbies  
        ]); // Cria novo cliente

        return redirect(""); // Volta para pagina inicial    
    }

    // Chamar a pagina de editar cliente
    public function editar_cliente($id){

        $responseCliente = Http::get(route("api_buscar_cliente", ["id" => $id])); // cliente
        $responseEstados = Http::get(route("api_listar_estados")); // lista de estados
        $responseCidades = Http::get(route("api_listar_cidades_por_estado_id", ["id" => $responseCliente["cidade"]["estado_id"]])); // lista de cidades do estado
        $responseHobbies = Http::get(route("api_listar_hobbies_padrao")); // lista de hobbies padrao

        // Hobbies Padrao
        $hobbies_padrao = $responseHobbies->json();
        $hobbies_padrao_len = count($hobbies_padrao);

        // Hobbies do CLiente
        $hobbies_cliente = $responseCliente->json()["hobbies"];
        $hobbies_cliente_indice = 0;
        $hobbies_cliente_len = count($hobbies_cliente);

        // Hobbies que serão enviados para a view
        $hobbies = array();

        // Adicionando os hobbies para serem enviados para a view
        for ($i = 1; $i <= $hobbies_padrao_len; $i++){
            if($hobbies_cliente_indice < $hobbies_cliente_len){ // Se ainda há um hob do cliente nao adicionado
                if($hobbies_cliente[$hobbies_cliente_indice]["id"] == $i){ // Se o hobbie eh o mesmo da variavel $i do loop
                    $hobbies[$i - 1] = $hobbies_cliente[$hobbies_cliente_indice];
                    $hobbies[$i - 1]["selected"] = true;

                    $hobbies_cliente_indice++;
                    continue;       
                }  
            }

            // Adicionando o hoobie padrao que o cliente nao escolheu
            $hobbies[$i - 1] = $hobbies_padrao[$i -1];
            $hobbies[$i - 1]["selected"] = false;
        }

        // Se ainda há hobbie do cliente nao adicionado - entao esse eh o hobbie outro
        if($hobbies_cliente_indice < $hobbies_cliente_len){
            $hobbies[$hobbies_padrao_len] = $hobbies_cliente[$hobbies_cliente_indice];        
            $hobbies[$hobbies_padrao_len]["selected"] = true;
        }else{
            // Caso nao adicionando outro como sem valor, id = -1 e deselecionado
            $hobbies[$hobbies_padrao_len] = ["nome" => "", "id" => -1, "selected" => false];
        }

        // Retornando a view
        return view("editar_cliente_form", [
            "estados" => $responseEstados->json(),
            "cidades" => $responseCidades->json(),
            "cliente" => $responseCliente->json(),
            "hobbies" => $hobbies
        ]);
    }

    // Envia as informacoes atualizadas do cliente para as devidas partes da api
    public function editar_cliente_submit(Request $request){

        // id e valor do hobbie outro
        $hobbie_outro = $request->input("h_outro", "null");
        $hobbie_outro_id = $request->input("h_outro_id");

        // Atualizando Hobbie Outro
        if($hobbie_outro == "null" and $hobbie_outro_id != -1){ // Cliente deseja remover o hobbie
            $responseRemoverHobbie = Http::delete(route("api_remover_hobbie", ["id" => $hobbie_outro_id]));
        
        }else if($hobbie_outro != "null" and $hobbie_outro_id != -1){ // Cliente deseja atualizar o nome do hobbie
            $responseAtualizarHobbie = Http::put(route("api_atualizar_hobbie"), [
                "id" => $hobbie_outro_id,
                "hobbie" => $hobbie_outro
            ]);

        }else if($hobbie_outro != "null" and $hobbie_outro_id == -1){ // Cliente deseja adicionar um novo hobbie
            $responseInserirHobbie =  Http::post(route("api_inserir_hobbie"), [
                "hobbie" => $hobbie_outro
             ]);
             $hobbie_outro_id = $responseInserirHobbie->json()["id"];
        }        

        // Gerando lista com os id dos hobbies selecionados pelo cliente
        $hobbies = $this->gerar_lista_hobbies($request);
        if($hobbie_outro_id != -1){
            $hobbies[5] = $hobbie_outro_id; // Adicionando o id do hobbie outro
        }

        $response = Http::put(route("api_atualizar_cliente"), [
            "id" => $request->input("cliente_id"),
            "nome" => $request->input("nome"),
            "email" => $request->input("email"),
            "cidade_id" => $request->input("cidade_id"),
            "hobbies" => $hobbies
          ]);
            

        return redirect(""); // redireciona para pagina inicial
    }

    // Remove o cliente selecionado e recarrega a pagina inicial
    public function remover_cliente($id){

        $response = Http::delete(route("api_remover_cliente", ["id" => $id]));
        return redirect("");  // redireciona para pagina inicial
    }

    
}
