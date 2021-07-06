<!DOCTYPE html>
<html lang="es-ar">
<head>

    <meta charset="utf-8">

    <meta name="keywords" content="" />

    <meta name="description" content="" />

    <meta name="distribution" content="global" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

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
   
    <!--<link href="{{ asset('css/main.css') }}" rel='stylesheet' />-->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js" integrity="sha256-YS9kklqEaLYBFpFsHZhoRQna5D2+RSAi/3V4+fXi9qQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js" integrity="sha256-Tlk+p3ciy9hAmL4sRwEpIKxlycqXMaoYj6Jaw2NirHI=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


    <!--BARRA DE PROGRESO-->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/minimal.css') }}">


    <script>
        $(document).ready(function() {
             
            /////////////ACTIVE DE MENU////////
            var navi = document.getElementById('navi')
            var toggle = document.getElementById('toggle')
            toggle.addEventListener('click', function() {
                navi.classList.toggle('active');
                toggle.classList.toggle('active');
            }); 
 
            //JS PARA SABER LAS ALERTAS 

            $('#alertas').on('change', function() {
                var alerta = $("#alertas").val();
                var alertInicio = $("#alert-inicio").val();
                var alertFinal = $("#alert-final").val();
                /*
                console.log(alerta);
                console.log(alertInicio); 
                console.log(alertFinal);
                */
                if(alerta!=''){
                    $.ajax({ //ACTUALIZA LAS NOTIFICACIONES
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/alertas',
                        method: 'post',
                        data: {
                            alerta:alerta, 
                            alertInicio:alertInicio,
                            alertFinal:alertFinal,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {
                        var arregloAlerta = JSON.parse(res)
                        //console.log(arregloAlerta); 
                        
                        if(arregloAlerta.countAlerta==0){
                            var clase='NoHayAlertas'
                        }else{
                            var clase='SiHayAlertas'
                            
                        }

                        $('#alert-form').empty();
                        $('#alert-form').replaceWith(
                            "<form action='/adminAlertas' method='POST' id='alert-form'>"+
                                '@csrf'+
                                "<input type='hidden'  name='alerta' value='"+alerta+"'>"+
                                "<input type='hidden'  name='alertInicio' value='"+alertInicio+"'>"+
                                "<input type='hidden'  name='alertFinal' value='"+alertFinal+"'>"+
                                "<button type='submit' class='btn-color "+clase+"'>"+arregloAlerta.countAlerta+"</button>"+
                            "</form> "
                        );
    
                    });
                }
            })
            $('#alert-inicio').on('change', function() {
                var alerta = $("#alertas").val();
                var alertInicio = $("#alert-inicio").val();
                var alertFinal = $("#alert-final").val();
                /*
                console.log(alerta);
                console.log(alertInicio); 
                console.log(alertFinal);
                */
                if(alerta!=''){

                    $.ajax({ //ACTUALIZA LAS NOTIFICACIONES
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/alertas',
                        method: 'post',
                        data: {
                            alerta:alerta, 
                            alertInicio:alertInicio,
                            alertFinal:alertFinal,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {
                        var arregloAlerta = JSON.parse(res)
                        //console.log(arregloAlerta); 
                        
                        if(arregloAlerta.countAlerta==0){
                            var clase='NoHayAlertas'
                        }else{
                            var clase='SiHayAlertas'
                        }

                        $('#alert-form').empty();
                        $('#alert-form').replaceWith(
                            "<form action='/adminAlertas' method='POST' id='alert-form'>"+
                                '@csrf'+
                                "<input type='hidden'  name='alerta' value='"+alerta+"'>"+
                                "<input type='hidden'  name='alertInicio' value='"+alertInicio+"'>"+
                                "<input type='hidden'  name='alertFinal' value='"+alertFinal+"'>"+
                                "<button type='submit' class='btn-color "+clase+"'>"+arregloAlerta.countAlerta+"</button>"+
                            "</form> "
                        );
    
                    });
                }
            })
            $('#alert-final').on('change', function() {
                var alerta = $("#alertas").val();
                var alertInicio = $("#alert-inicio").val();
                var alertFinal = $("#alert-final").val();
               /* 
                console.log(alerta);
                console.log(alertInicio); 
                console.log(alertFinal);
                */
                if(alerta!=''){

                    $.ajax({ //ACTUALIZA LAS NOTIFICACIONES
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/alertas',
                        method: 'post',
                        data: {
                            alerta:alerta, 
                            alertInicio:alertInicio,
                            alertFinal:alertFinal,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {
                        var arregloAlerta = JSON.parse(res)
                        //console.log(arregloAlerta); 
                        
                        if(arregloAlerta.countAlerta==0){
                            var clase='NoHayAlertas'
                        }else{
                            var clase='SiHayAlertas'
                        }

                        $('#alert-form').empty();
                        $('#alert-form').replaceWith(
                            "<form action='/adminAlertas' method='POST' id='alert-form'>"+
                                '@csrf'+
                                "<input type='hidden'  name='alerta' value='"+alerta+"'>"+
                                "<input type='hidden'  name='alertInicio' value='"+alertInicio+"'>"+
                                "<input type='hidden'  name='alertFinal' value='"+alertFinal+"'>"+
                                "<button type='submit' class='btn-color "+clase+"'>"+arregloAlerta.countAlerta+"</button>"+
                            "</form> "
                        );
    
                    });
                }
            })
        });
    </script>
    
    
</head>
<body>
    <header>
        <div class="toggle" id="toggle">
            <div class="toggle-menu">
                <i class="fas fa-bars"></i>
            </div>
            <div id="usuario">
                <div class="name"> 
                    <h1>
                        @auth
                            {{Auth::user()->name}} / <i>{{Auth::user()->rol}}</i> 
                        @endauth 
                    </h1>
                </div>
            </div>
            
        </div>  
        <div class="header">
            <div id="usuario">
                <div class="name">
                    <h1>
                        @auth
                            {{Auth::user()->name}} /  
                            <i>{{Auth::user()->rol}}</i> 
                        @endauth
                    </h1>
                </div>
            </div>
            <div id="h1">
                <a href="/">HHOxigeno-Sistema</a>
            </div> 
            <div id="login"> 
                @auth 
                
                    <a class="" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Salir') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @endauth 
            </div>
            <div id="hh">
                <a href="/">HH</a>
            </div> 
        </div> 
        <div class="navigation" id="navi">
            <ul>
                <div class="navigation-scroll">

                <li>
                    <a href="/adminPedidos">
                        <span class="icon"><i class="fas fa-plus-square"></i></span>
                        <span class="title">Alquileres</span>
                    </a>    
                </li>
                <li>
                    <a href="/adminCalendario">
                        <span class="icon"> <i class="fas fa-calendar-alt"></i></span>
                        <span class="title">Calendario</span>
                    </a>    
                </li>
                @if (auth()->user()->hasRoles(['admin','administrador']))
                <li>
                    <a href="/adminEquipos">
                        <span class="icon"><i class="fas fa-dolly"></i></span>
                        <span class="title">Inventario</span>
                    </a>    
                </li>
                <li>
                    <a href="/adminRegistros">
                        <span class="icon"><i class="far fa-file-alt"></i></span>
                        <span class="title">Registros</span>
                    </a>    
                </li>
                <li>
                    <a href="/adminGaran-Finan">
                        <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                        <span class="title">Garantias y Finanzas</span>
                    </a>    
                </li>
                <li>
                    <a href="/adminCambios">
                        <span class="icon"><i class="fas fa-retweet"></i></span>
                        <span class="title">Cambios</span>
                    </a>    
                </li>
                <li>
                    <a href="/adminCaja">
                        <span class="icon"><i class="fas fa-cash-register"></i></span>
                        <span class="title">Caja</span>
                    </a>    
                </li>
                @endif    
                <li>
                    <a href="/adminTareas">
                        <span class="icon"><i class="fas fa-clipboard-list"></i></span>
                        <span class="title">Tareas</span>
                    </a>    
                </li> 
                @if (auth()->user()->hasRoles(['admin']))
                <li>
                    <a href="/adminUsuarios">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="title">Usuarios</span>
                    </a>    
                </li>
                @endif  
                @if (auth()->user()->hasRoles(['admin','administrador']))
                <li class="noHover">
                    <a> 
                        <span class="icon"><i class="fas fa-exclamation-triangle"></i></span> 
                        <select name="alerta" id="alertas">
                            <option value="">Alertas</option>
                            <option value="entregas">Entregas</option>
                            <option value="retiros">Retiros</option>
                            <option value="tareas">Tareas</option>
                            <option value="vencimientos">Vencimientos</option>
                        </select>
                        <span class="alert-valor" >
                            <form action="" method="POST" id="alert-form">
                                @csrf 
                                <button type="button" disabled class="btn-color"></button>
                            </form> 
                        </span>
                    </a>   
                    
                    <div class="fechas">
                        @php
                            $fecha=date("Y-m-d");
                            $fechaUnaSemana=date("Y-m-d",strtotime($fecha."+ 7 days"));
                        @endphp
                        <div>
                            <p>Desde:</p>
                            <input type="date" name="alert-inicio" id="alert-inicio" value="{{$fecha}}">
                        </div>
                        <div>
                            <p>Hasta:</p>
                            <input type="date" name="alert-final" id="alert-final" value="{{$fechaUnaSemana}}">
                        </div>
                    </div>  
                </li> 
                @endif  
                <li class="li-logout"> 
                    @auth 
                        <a   href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                           <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="title">Cerrar sesión</span>
                        </a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    @endauth  
                </li>
                </div>   

            </ul>
        </div>    
        


    </header>
    
    <div class="subTitulo">
            @yield('subTitulo')
    </div>
    <main>
        @yield('contenido')  
    </main>
    @if (auth()->user()->hasRoles(['admin','administrador']))

        <script>
            $(document).ready(function() {
                    $.ajax({ //VERIFICA SI HAY UNA BAJA GARANTIA LIQUIDAS
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/alertaGarantiaLiquidas',
                        method: 'post',
                        data: { 
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res){
                        var arreglo= JSON.parse(res)
 
                        if(arreglo.respuesta){
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                            }) 
                            Toast.fire({
                            icon: 'error',
                            title: 'POCAS GARANTIAS LIQUIDAS!! EN CUENTAS:'+arreglo.respuesta
                            })
                        }
                    })

                    
            })
        </script>
    @endif    
</body>
</html>