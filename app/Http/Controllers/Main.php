<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailDuplicadoException;
use App\Models\Cliente;
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

    private function gerar_lista_hobbies_para_view($hobbies_cliente){
        $responseHobbies = Http::get(route("api_listar_hobbies_padrao")); // lista de hobbies padrao

        // Hobbies Padrao
        $hobbies_padrao = $responseHobbies->json();
        $hobbies_padrao_len = count($hobbies_padrao);

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

        return $hobbies;
    }

    // Chamar a Pagina inicial
    public function home(){
        $response = Http::get(route("api_listar_clientes")); //lista de clientes
        return View("home", ["clientes" => $response->json()]);   
    }

    // Chamar a pagina de cadastro de cliente
    public function novo_cliente($mensagem = "", $cliente = null){
        $cidades = array();
        $hobbies = array();
        if($cliente == null){
            $cliente = new Cliente();
            $cliente->nome = "";
            $cliente->email = "";
            $cliente->estado_id = -1;
            $cliente->cidade_id = -1;

        }else if($cliente->cidade_id != -1){
            $responseCidades = Http::get(route("api_listar_cidades_por_estado_id", $cliente->estado_id));
            $cidades = $responseCidades->json();

            // hobbies
            $responseHobbies = Http::get(route("api_listar_hobbies_padrao")); // lista de hobbies padrao
            $hobbies_padrao = $responseHobbies->json();
            $indice = 0;
            $indice_cliente = 0;
            $hobbies_cliente_len = count($cliente->hobbies);
            foreach($hobbies_padrao as $hobbiePadrao){ // Percorre a lista de hobbies padrao e seleciona os que foram marcados no cadastro
                $hobbies[$indice] = $hobbiePadrao;
                if($indice_cliente < $hobbies_cliente_len){
                    if($hobbiePadrao["id"] == $cliente->hobbies[$indice_cliente]){
                        $hobbies[$indice]["selected"] = true;
                        $indice_cliente++;
                        $indice++;
                        continue;
                    }
                }
                $hobbies[$indice]["selected"] = false;
                $indice++;
            }
            
            if($hobbies_cliente_len > 0){
                if(!is_numeric($cliente["hobbies"][$hobbies_cliente_len - 1])){
                    $hobbies[$indice] = ["nome" => $cliente["hobbies"][$hobbies_cliente_len - 1], "id" => -1];
                    $hobbies[$indice]["selected"] = true;        
                }
            }else{
                $hobbies[$indice] = ["nome" => "", "id" => -1, "selected" => false];
            }
        }

        $responseEstados = Http::get(route("api_listar_estados")); // lista de estados
        if(count($hobbies) == 0){
            $responseHobbies = Http::get(route("api_listar_hobbies_padrao")); // lista de hobbies padrao
            $hobbies = $responseHobbies->json();
            $hobbies[] = ["nome" => "", "id" => -1];
            for($i = 0; $i < count($hobbies); $i++){
                $hobbies[$i]["selected"] = false;
            }
        }
        
        return View("novo_cliente_form", [
            "cliente" => $cliente,
            "estados" => $responseEstados->json(),
            "cidades" => $cidades,
            "hobbies" => $hobbies,
            "mensagem" => $mensagem
        ]);       
    }


    // Envia as informacoes do novo cliente para as devidas partes da api
    public function novo_cliente_submit(Request $request){
        
        
        $hobbies = $this->gerar_lista_hobbies($request);

        $hobbie_outro = $request->input("h_outro", "null");
        
        // Verifica se foi informado um hobbie no campo outro
        if($hobbie_outro != "null"){ 
            $responseHobbie = Http::post(route("api_inserir_hobbie"), [
                "hobbie" => $hobbie_outro
            ]); // Cria novo hobbie

            $hobbies[count($hobbies)] = "" . $responseHobbie->json()["id"]; // Adiciona a lista de hobbies
        }
    
        $responseCliente = Http::post(route("api_inserir_cliente"), [
        "nome" => $request->input("nome"),
        "email" => $request->input("email"),
        "cidade_id" => $request->input("cidade_id"),
        "hobbies" => $hobbies  
        ]); // Cria novo cliente

        // return $responseCliente;
        if($responseCliente->status() == 500){ // Em caso de erro, recarregar a pagina com uma mensagem explicando o erro
            if($hobbie_outro != "null"){
                $responseRemoverHobbie = Http::delete(route("api_remover_hobbie", end($hobbies)));
                $hobbies[count($hobbies) -1] = $hobbie_outro;
            }
            $cliente = new Cliente(); // Modelo para enviar parte dos dados já informados para o formulário
            $cliente->nome = $request->input("nome");
            $cliente->email = $request->input("email");
            $cliente->estado_id = $request->input("estado_id");
            $cliente->cidade_id = $request->input("cidade_id");
            $cliente->hobbies = $hobbies;
            return $this->novo_cliente($responseCliente, $cliente);    
        }
        return redirect(""); // Volta para pagina inicial   
    }

    // Chamar a pagina de editar cliente
    public function editar_cliente($id, $mensagem = ""){

        $responseCliente = Http::get(route("api_buscar_cliente", ["id" => $id])); // cliente
        $responseEstados = Http::get(route("api_listar_estados")); // lista de estados
        $responseCidades = Http::get(route("api_listar_cidades_por_estado_id", ["id" => $responseCliente["cidade"]["estado_id"]])); // lista de cidades do estado
        
        
        // Hobbies do CLiente
        $hobbies_cliente = $responseCliente->json()["hobbies"];

        $hobbies = $this->gerar_lista_hobbies_para_view($hobbies_cliente);

        // Retornando a view
        return view("editar_cliente_form", [
            "estados" => $responseEstados->json(),
            "cidades" => $responseCidades->json(),
            "cliente" => $responseCliente->json(),
            "hobbies" => $hobbies,
            "mensagem" => $mensagem
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
        if($hobbie_outro_id != -1 && $hobbie_outro != "null"){
            $hobbies[5] = $hobbie_outro_id; // Adicionando o id do hobbie outro
        }

        $response = Http::put(route("api_atualizar_cliente"), [
            "id" => $request->input("cliente_id"),
            "nome" => $request->input("nome"),
            "email" => $request->input("email"),
            "cidade_id" => $request->input("cidade_id"),
            "hobbies" => $hobbies
          ]);
            
        if($response->status() == 500){ // Em caso de erro, recarregar a pagina com uma mensagem explicando o erro
            return $this->editar_cliente($request->input("cliente_id"), $response);
        }

        return redirect(""); // redireciona para pagina inicial
    }

    // Remove o cliente selecionado e recarrega a pagina inicial
    public function remover_cliente($id){

        $response = Http::delete(route("api_remover_cliente", ["id" => $id]));
        return redirect("");  // redireciona para pagina inicial
    }

    
}
