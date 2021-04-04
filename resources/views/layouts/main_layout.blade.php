<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Exercicio Chronos</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{asset('assets\fontawesome\font-awesome.min.css')}}">

    {{-- jQuery --}}
    <script src="{{asset('assets\jquery.min.js')}}"></script>
</head>
<body>

    <h1 class="text-center">Exercicio Chronos</h1>
    <hr>
    @yield('content')
    
    {{-- libs --}}
    <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
    @yield('script_content')
</body>
</html>
