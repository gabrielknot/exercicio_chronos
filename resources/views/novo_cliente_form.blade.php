@extends('layouts.main_layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">                
                <h3 class="text-center mb-3">Novo Cliente</h3>

                <form id="form_novo_cliente" action="{{route('novo_cliente_submit')}}" method="POST">

                    @csrf
                    
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4">

                            {{-- Input Nome --}}
                            <div class="form-group">
                                <label for="nome_novo_cliente">Nome:</label>
                                <input type="text" name="nome" id="nome_novo_cliente" class="form-control" required>
                            </div>

                            {{-- Input Email --}}
                            <div class="form-group">
                                <label for="email_novo_cliente">Email:</label>
                                <input type="email" name="email" id="email_novo_cliente" class="form-control" required>
                            </div>

                            
                            {{-- Select - Estados --}}
                            <select name="estado_id" id="select_estados" required>
                                <option selected disabled value="">Estado</option>
                                @foreach ($estados as $estado)
                                    <option value={{$estado["id"]}}>{{$estado["nome"]}}</option>
                                @endforeach    
                            </select>          
                            
                            
                            {{-- Select - Cidades --}}
                            <select name="cidade_id" id="select_cidades" required>
                                <option selected disabled value="">Cidade</option>
                                @foreach ($cidades as $cidades)
                                    <option value={{$estado["nome"]}}>{{$estado["nome"]}}</option>
                                @endforeach    
                            </select>       
                            
                            {{-- Hobbies --}}
                            <div class="form-group">
                              <label ><strong>Hobbies:</strong></label>
                             
                              {{-- Hobbies padrao --}}
                                @foreach ($hobbies as $hobbie)
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <input name={{"h" . $loop->index}} type="checkbox" value="{{$hobbie["id"]}}">
                                            <label for="checkbox_text">{{$hobbie["nome"]}}</label>
                                        </div>
                                    </div>
                                @endforeach
                                
                                {{-- Checkbox - Hobbie - Outro --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        
                                        <label for="checkbox_text" class="mr-5">Outro: </label>
                                        <input id="checkbox_outro" type="checkbox" aria-label="Checkbox for following text input" value="">
                                    </div>
                                    </div>

                                    {{-- Input Text Hobbie Outro --}}
                                    <input id="input_text_checkbox_outro" name="h_outro" type="text" class="form-control" aria-label="Text input with checkbox" disabled>
                                </div>
                            </div>

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
            $.get("/desafio_chronos-main/public/api/estado_id/cidades/" + this.value, function(cidades){
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
