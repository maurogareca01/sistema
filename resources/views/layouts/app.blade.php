<!DOCTYPE html>
<html lang="es-ar">
<head>

    <meta charset="utf-8">

    <meta name="keywords" content="" />

    <meta name="description" content="" />

    <meta name="distribution" content="global" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="author" content="EstudioMG" />

    <meta name="copyright" content="EstudioMG" />

    <meta http-equiv=”Content-Language” content=”es”/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>
     

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css" integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
    <!--ESTILOS CSS-->
    <link rel="stylesheet" href="{{ asset('css/estilo-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fuente.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo-inventario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo-tablas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo-formularios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo-calendario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo-sesion.css') }}">
    
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js" integrity="sha256-YS9kklqEaLYBFpFsHZhoRQna5D2+RSAi/3V4+fXi9qQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js" integrity="sha256-Tlk+p3ciy9hAmL4sRwEpIKxlycqXMaoYj6Jaw2NirHI=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    

    <script src="{{ asset('js/btnClick.js') }}"></script>
</head>
<body> 
    <main>
        @yield('contenido')  
    </main>
</body>
</html>