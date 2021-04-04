@extends('layouts.main_layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col">

                <div>
                    <a href="{{route("novo_cliente")}}" class="btn btn-primary">Cadastrar Cliente <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    @if (count($clientes) === 0)
        <p>Ainda não existem clientes cadastrados</p>
    @else

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>email</th>
                    <th>cidade</th>
                    <th>estado</th>
                    <th>Hobbies</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente["nome"] }}</td>
                        <td>{{ $cliente["email"] }}</td>
                        <td>{{ $cliente["cidade"]["nome"] }}</td>
                        <td>{{ $cliente["cidade"]["estado"]["nome"] }}</td>
                        
                        <td>
                            <ul class="list-group sm">
                            @foreach ($cliente["hobbies"] as $hobbie)
                                <li class="list-group-item sm">{{$hobbie["nome"]}}</li>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route("editar_cliente", ["id" => $cliente["id"]])}}" class="btn btn-primary sm"><i class="fa fa-pencil"></i></a>
                            <a href="{{route("remover_cliente",["id" => $cliente["id"]])}}" class="btn btn-danger sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
    @endif
@endsection
