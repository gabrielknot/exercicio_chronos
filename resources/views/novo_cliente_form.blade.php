@extends('layouts.main_layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">                
                <h3 class="text-center mb-3">Novo Cliente</h3>

                @if ($mensagem != "")                    
                    <div class="alert alert-danger" role="alert">
                        {{$mensagem}}
                    </div>
                @endif
                <form id="form_novo_cliente" action="{{route('novo_cliente_submit')}}" method="POST">

                    @csrf
                    
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4">

                            {{-- Input Nome --}}
                            <div class="form-group">
                                <label for="nome_novo_cliente">Nome:</label>
                                <input 
                                    type="text"
                                    name="nome" 
                                    id="nome_novo_cliente" 
                                    class="form-control" 
                                    value="{{$cliente["nome"]}}"
                                    required>
                            </div>

                            {{-- Input Email --}}
                            <div class="form-group">
                                <label for="email_novo_cliente">Email:</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email_novo_cliente" 
                                    class="form-control" 
                                    value="{{$cliente["email"]}}"
                                    required>
                            </div>

                            
                            {{-- Select - Estados --}}
                            <select name="estado_id" id="select_estados" required>
                                <option selected disabled value="">Estado</option>
                                @foreach ($estados as $estado)
                                    <option value={{$estado["id"]}}
                                    
                                    @if ($cliente->estado_id == $estado["id"])
                                        selected
                                    @endif
                                    >{{$estado["nome"]}}</option>
                                @endforeach    
                            </select>          
                            
                            
                            {{-- Select - Cidades --}}
                            <select name="cidade_id" id="select_cidades" required>
                                <option selected disabled value="">Cidade</option>
                                @foreach ($cidades as $cidade)
                                    
                                    <option value={{$cidade["id"]}}
                                    @if ($cliente->cidade_id == $cidade["id"])
                                        selected
                                    @endif
                                    
                                    >{{$cidade["nome"]}}</option>
                                @endforeach    
                            </select>       
                            
                             {{-- Input CheckBox - Hobbies --}}

                             <div class="form-group">
                                <label ><strong>Hobbies:</strong></label>
      
                                  @foreach ($hobbies as $hobbie)
                                     {{-- Checkbox - Hobbie - Outro --}}
      
                                      @if ($loop->last)
                                            {{-- Id ultimo hobbie --}}
                                            <input type="hidden" name="h_outro_id" value={{$hobbie["id"]}}>
                                            
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text">    
                                                    <label for="checkbox_text" class="mr-5">Outro</label>
                                                    <input id="checkbox_outro"
                                                        type="checkbox"
                                                        <?php if($hobbie["selected"] == true){echo "checked";} ?> 
                                                    />
                                                </div>
                                                {{-- Input Text Hobbie Outro --}}
                                                </div>
                                                    <input id="input_text_checkbox_outro" 
                                                        name="h_outro" 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{$hobbie["nome"]}}" 
                                                        <?php if($hobbie["selected"] == false){echo "disabled";} ?> 
                                                    />
                                                </div>
                                            </div>

                                        {{-- Hobbies padrao --}}
                                        @else
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <input 
                                                        name={{"h" . $loop->index}} 
                                                        type="checkbox" value="{{$hobbie["id"]}}" 
                                                        <?php if($hobbie["selected"] == true){echo "checked";} ?> 
                                                    />
                                                    <label for="checkbox_text">{{$hobbie["nome"]}}</label>
                                                </div>
                                            </div>
                                        @endif                                      
                                  @endforeach
                            {{-- Botao de salvar --}}

                            <div class="form-group mt-1">
                                <a href="{{route("home")}}" class="btn btn-secondary">Cancelar</a>
                                <input 
                                    type="submit" 
                                    value="Salvar" 
                                    class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
    
@endsection

@section('script_content')
    <script>

        // Funcao de listar cidades quando for selecionado o estado
        $("#select_estados").change(function() {            
            $.get("/exercicio_chronos-main/public/api/estado_id/cidades/" + this.value, function(cidades){
                $("#select_cidades").empty();
                $('#select_cidades').append("<option selected value='' disabled> Cidade </option>");
                $.each(cidades, function(key, value){
                    $('#select_cidades').append('<option name="cidade_id" value=' + value.id + '>' + value.nome + '</option>');
                });
            })
        });

        // Funcao para manipular o comportamento do checkbox outro - Selecionado = habilitado e requerido | Não selecionado = desabilitado e nao requerido
        $("#checkbox_outro").click(function(){
            if(this.checked){
                $("#input_text_checkbox_outro").prop("required", true);
                $("#input_text_checkbox_outro").prop("disabled", false);
            }else{
                $("#input_text_checkbox_outro").prop("required", false);
                $("#input_text_checkbox_outro").prop("disabled", true);
            }
        });
    </script>
@endsection
