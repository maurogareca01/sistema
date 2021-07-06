@extends('layouts.plantilla')

@section('titulo','Administrador De Alquileres')
 
@section('subTitulo', 'ALQUILERES')

@section('contenido')
 

<div class="inven-tablas">

        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN ALTA -->
        @if (session('mensaje'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION -->
        @if (session('mensaje2'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje2') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION -->
        @if (session('mensaje3'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje3') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif 
        <!--CONTROLA SI HAY UN ERROR EN EL FORMULARIO DE AGREGAR-->
        @if ($errors->any())
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "No se pudo Agregar el Alquiler",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif   
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIA EN ESTADO DEL PEDIDO A ENTREGADO -->
        @if (session('mensaje4'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje4') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif 
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO NO HAY STOCK DE COSAS -->
        @if (session('mensaje5'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('mensaje5') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif 
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE RONOVO UN ALQUILER -->
        @if (session('mensaje6'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('mensaje6') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif 
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIO LA LOGISTA O CUENTA-->
        @if (session('mensaje7'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('mensaje7') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIO COMENTARIOS EN LA PARATE DE ALQUILER VENCIDO-->
        @if (session('mensaje8'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('mensaje8') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIO COMENTARIOS EN LA PARATE DE ALQUILER VENCIDO-->
        @if (session('mensaje9'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('mensaje9') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif 
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIO COMENTARIOS EN LA PARATE DE ALQUILER VENCIDO-->
        @if (session('mensaje10'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('mensaje10') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif 
        
    <div class="tablas">
        <div class="sopala-inventario">
            <div class=" inventario">
                <ul class="inven">
                    @if (!auth()->user()->hasRoles(['logistica']))
                        <li><a href="/adminPedidos">Alquileres</a></li>
                        <li><a href="/adminPedidosArchivados">Archivados</a></li>
                    @else
                        <li><a href="/adminPedidos">Alquileres</a></li>
                    @endif    
                </ul>
            </div>
        </div>
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Alquiler" autocomplete="off">
                            
                        <button type="submit"  class="search-btn">
                             <i class="fas fa-search"></i>
                        </button>
                         
                    </div>
                </form>
            
        </div>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>N° Alquiler</th>
                        <th>Usuario</th>
                        <th>N° Servicio</th>
                        <th>Costo Servicio</th>
                        <th>Garantia</th>
                        <th>Costo Envio</th>
                        <th>Medio De Pago Alquiler</th>
                        <th>Medio De Pago Garantia</th> 
                        <th>Cliente</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Dias</th>
                        <th>Descargas</th>
                        <th>Estado</th>
                        @if (!auth()->user()->hasRoles(['logistica']))  
                            <th colspan="4" class="text-center">
                                <p  class="btn-add" id="btn-abrir-popup">
                                    <i class="fas fa-plus-square"></i>
                                </p>
                            </th> 
                        @endif    
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)

                    <tr>
                            <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $pedido->fechaInicio;
                            $fechaInicio = date("d/m/Y ", strtotime($originalDate)); 
                            $originalDate = $pedido->fechaFin;
                            $fechaFin = date("d/m/Y", strtotime($originalDate)); 
                        @endphp
                        <td> {{ $pedido->idPedido }} </td>
                        <td> {{ $pedido->usuario }} </td>
                        <td>
                            <button type="button" onclick="verServ('{{ $pedido->idServicio }}','{{ $pedido->nombreServ }}','{{ $pedido->descripcion }}','{{ $pedido->imgServ }}','{{$pedido->dispoER}}','{{$pedido->dispoEA}}','{{$pedido->dispoEY}}','{{$pedido->dispoT1}}','{{$pedido->dispoT415}}','{{$pedido->dispoO}}')">
                            S-{{$pedido->idServicio}}@if($pedido->dispoER!=0)R
                            @elseif($pedido->dispoEA!=0)A
                            @elseif($pedido->dispoEY!=0)Y
                            @endif 
                            </button>
                        </td>
                        <td> {{ $pedido->costoServ }}</td>
                        <td> {{ $pedido->garantia }}</td>
                        <td> {{ $pedido->costoEnvio }} </td> 
                        <td class="{{  
                            $pedido->medioPagoAlquiler=='A Confirmar' ? 'entrega':'bien' }}"> 
                            {{$pedido->medioPagoAlquiler}} 
                        </td>
                        <td class="{{  
                            $pedido->medioPagoGarantia=='A Confirmar' ? 'entrega':'bien' }}"> 
                            {{$pedido->medioPagoGarantia}} 
                        </td>
                         
                        <td>
                            <button type="button" 
                            onclick="verClien('{{$pedido->nombreCliente}}',
                            '{{$pedido->dni}}',
                            '{{$pedido->direccion}}',
                            '{{$pedido->localidad}}',
                            '{{$pedido->telefono}}',
                            '{{$pedido->email}}',
                            '{{$pedido->recibe}}',
                            '{{$pedido->imgDniF}}',
                            '{{$pedido->imgDniD}}',
                            '{{$pedido->imgOrden}}')">
                            @php
                                $nombre = explode(" ", $pedido->nombreCliente);
                            @endphp

                            {{$nombre[0]}}
                        
                        
                        </button>
                        </td>

                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $fechaFin }}</td>
                        <td>{{ $pedido->dias}}</td>
                        <td>
                            <button type="button" onclick="verPdfs('{{$pedido->idPedido}}')">Descargas</button>
                        </td> 
                        @if (auth()->user()->hasRoles(['logistica']))
                            <td class="{{  
                                $pedido->estadoPedido=='Espera' ? 'espera': 
                                ($pedido->estadoPedido =='Entrega' ? 'entrega' : 
                                ($pedido->estadoPedido =='Entregado' ? 'entregado' : 
                                ($pedido->estadoPedido =='Retirar' ? 'retirar' : 
                                ($pedido->estadoPedido =='Retirado' ? 'retirado' : 'espera'   )))) 
                                }} ">
                                @if($pedido->estadoPedido=='Entrega')
                                    <form action="/cambiarEstadoPedidoP/{{ $pedido->idPedido }}" method="POST" class="cambiar-estado-entrega">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form>
                                @endif
                                @if($pedido->estadoPedido=='Retirar')
                                    <form action="/cambiarEstadoPedidoP/{{ $pedido->idPedido }}" method="POST" class="cambiar-estado-retirar">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form>
                                @endif
                            </td>  
                        @else  
                            <td class="{{  
                                $pedido->estadoPedido=='Espera' ? 'espera': 
                                ($pedido->estadoPedido =='Entrega' ? 'entrega' : 
                                ($pedido->estadoPedido =='Entregado' ? 'entregado' : 
                                ($pedido->estadoPedido =='Retirar' ? 'retirar' : 
                                ($pedido->estadoPedido =='Retirado' ? 'retirado' : 
                                ($pedido->estadoPedido =='Vencido' ? 'retirar' : 
                                ($pedido->estadoPedido =='Archivado' ? 'archivado' : 'espera' )))))) 
                                }} ">
                                @if($pedido->estadoPedido=='Espera') 
                                    <form action="/formUbicacionGarantiaEspera/{{$pedido->idPedido}}" method="get" class="cambiar-estado-espera">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form> 
                                @endif
                                @if($pedido->estadoPedido=='Entrega')
                                    <form action="/cambiarEstadoPedidoP/{{ $pedido->idPedido }}" method="POST" class="cambiar-estado-entrega">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form>
                                @endif
                                @if($pedido->estadoPedido=='Entregado')
                                    <form action="/vercambiarEstadoPedidoPFecha/{{ $pedido->idPedido }}" method="get" class="cambiar-estado-entregado">
                                        @csrf 
                                            <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                            <button type="submit" class="btn-color" id="btn-abrir-popup-elegir-fecha"> {{ $pedido->estadoPedido}} </button>
                                            
                                    </form> 
                                @endif
                                @if($pedido->estadoPedido=='Retirar')
                                    <form action="/cambiarEstadoPedidoP/{{ $pedido->idPedido }}" method="POST" class="cambiar-estado-retirar">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form>
                                @endif
                                @if($pedido->estadoPedido=='Retirado')
                                    <form action="/cambiarEstadoPedidoP/{{ $pedido->idPedido }}" method="POST" class="cambiar-estado-retirado">
                                        @csrf
                                        <input type="hidden"  name="estadoPedido" value="{{ $pedido->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                    </form>  
                                @endif
                                @if($pedido->estadoPedido=='Vencido')
                                    <form action="/formModificarPedidoVencidoP/{{$pedido->idPedido}}" method="get" class="cambiar-estado-vencido">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $pedido->idPedido }}">
                                        <button type="submit" class="btn-color" onclick="vencido('{{ $pedido->idPedido }}')"> {{ $pedido->estadoPedido}} </button>
                                    </form>
                                @endif 
                                @if($pedido->estadoPedido=='Archivado')
                                    <button type="button" disabled class="btn-color"> {{ $pedido->estadoPedido}} </button>
                                @endif 

                            </td>
                            
                        @endif
  


                        @if (!auth()->user()->hasRoles(['logistica']))
                        
                            @if ($pedido->estadoPedido=='Espera')
                                 <td></td>
                                <td>
                                    <a href="/formModificarPedido/{{ $pedido->idPedido }}" class="btn-update">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td> 
                                <td>
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <form action="/eliminarPedido/{{ $pedido->idPedido }}" method="POST" class="formulario-eliminar">
                                        @csrf
                                        <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>    
                                </td> 
                                
                            @endif 
                            @if ($pedido->estadoPedido=='Retirar') 
                                <td></td>
                                
                                <td >
                                    <a href="/formModificarPedido/{{ $pedido->idPedido }}" class="btn-update">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td> 
                                <td>
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <a href="/vercambiarEstadoPedidoPFecha/{{ $pedido->idPedido }}" class="btn-update">
                                        <i class="fas fa-truck"></i>
                                    </a>
                                </td>    
                            @endif 
                            @if($pedido->estadoPedido=='Entrega')

                                <td>
                                    <a href="/formModificarPedido/{{ $pedido->idPedido }}" class="btn-update">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td> 
                                <td>
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <a href="/formUbicacionGarantiaEntrega/{{ $pedido->idPedido }}" class="btn-update">
                                        <i class="fas fa-truck"></i>
                                    </a> 
                                </td>  
                                <td>
                                    <form action="/eliminarPedido/{{ $pedido->idPedido }}" method="POST" class="formulario-eliminar">
                                        @csrf
                                        <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                    </form> 
                                </td>
                            @endif   
                            @if($pedido->estadoPedido=='Retirado')
                                <td colspan="4">
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            @endif  
                            @if($pedido->estadoPedido=='Entregado')
                                <td></td> 
                                @if ($pedido->dispoERCambio==0 && $pedido->dispoEACambio==0  && $pedido->dispoEYCambio==0  && $pedido->dispoT1Cambio==0  && $pedido->dispoT415Cambio==0  && $pedido->dispoOCambio==0 )
                                    <td>
                                        <a href="/formModificarPedido/{{ $pedido->idPedido }}" class="btn-update">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </td> 
                                @else 
                                    <td>Cambio Pendiente</td>  
                                @endif  
                                <td>
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                               
                                <td>  
                                    @if ($pedido->email!='')
                                        <form action="/enviarArchivos/{{ $pedido->idPedido }}" method="POST" class="enviar-archivos">
                                            @csrf
                                                <button type="submit" class="btn-update" id="btn-abrir-popup-email">
                                                    <i class="fas fa-at"></i>
                                                </button>  
                                        </form>
                                    @else    
                                        <button  type="submit" class="btn-delete" id="btn-abrir-popup-email">
                                            <i class="fas fa-at"></i>
                                        </button> 
                                    @endif 
                                </td>
                                 
                                
                            @endif   
                            
                            @if($pedido->estadoPedido=='Vencido')
                                <td colspan="4">
                                    <div id="btn-abrir-popup-comentarios-{{$pedido->idPedido}}" >
                                        <button type="submit" onclick="comentarios('{{$pedido->idPedido}}')" class="btn-comenta">
                                            @if($pedido->comentarios=='')
                                                <i class="fas fa-comment"></i>
                                            @else
                                                <i class="far fa-comment-dots"></i>    
                                            @endif    
                                        </button>
                                    </div>
                                    <div class="overlay" id="overlay-comentarios-{{$pedido->idPedido}}">
                                        <div class="popup" id="popup-comentarios-{{$pedido->idPedido}}">
                                            <div class="content-formulario content-alta">
                                                <div class="contact-wrapper">
                                                    <div class="modifica-form ">
                                                    <p href="#" id="btn-cerrar-popup-comentarios-{{$pedido->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                        <h1>Comentarios De Alquiler N°: {{$pedido->idPedido}}</h1>
                                                        <form action="/vencidoComentarios/{{$pedido->idPedido}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <p>
                                                                <label for="comentarios">Comentarios</label>
                                                                <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$pedido->comentarios}}</textarea>
                                                            </p>
                                                            <p>
                                                                <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Comentarios</button>
                                                            </p>                                
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td> 
                            @endif    
                        @endif    
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>   

        @if (!auth()->user()->hasRoles(['logistica']))

            <div class="overlay" id="overlay">
                <div class="popup" id="popup">

                    <div class="content-formulario content-alta4">

                        <div class="contact-wrapper">
                            
                            <div class="modifica-form alta4">
                                <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                <h1>Agregar Nuevo Alquiler</h1>
                                <form action="/agregarPedido" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="usuario" id="usuario" value="{{ Auth::user()->name }} {{ Auth::user()->apellido }}">         
                                    <input type="hidden" name="dispoER" id="dispoER">
                                    <input type="hidden" name="dispoEA" id="dispoEA">
                                    <input type="hidden" name="dispoEY" id="dispoEY">
                                    <input type="hidden" name="dispoT1" id="dispoT1">
                                    <input type="hidden" name="dispoT415" id="dispoT415"> 
                                    <input type="hidden" name="dispoO" id="dispoO">
                                    <input type="hidden" name="imgServ" id="imgServ">
 
                                    
                                    <p class="secc-a">
                                        <label for="idServicio">Servicio</label>
                                        <select name="idServicio" id="idServicio" class="completo">
                                            <option value="">Seleccione un Servicio</option>
                                            @foreach($servicios as $servicio)
                                            <option value="{{ $servicio->idServicio }}" >
                                              
                                                S-{{$servicio->idServicio}}{{--@if($servicio->dispoER!=0)R
                                                @elseif($servicio->dispoEA!=0)A
                                                @elseif($servicio->dispoEY!=0)Y
                                                @endif
                                                --}} - {{ $servicio->nombreServ }}
                                            </option> 
                                            @endforeach 
                                        </select>
                                        @error('idServicio')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p>
                                    <p class="span-Dispo secc-b" > 
                                        <span class="span-barra ">RES</span>
                                        <span class="span-barra">ARS</span>
                                        <span class="span-barra">YUW</span>
                                        <span class="span-barra">T/680L</span>
                                        <span class="span-barra">T/415L</span>
                                        <span >OXI</span>
                                        <span class="span-barra" id="con-res" >-
                                            <input type="hidden" name="NumeroDispoER" >
                                        </span>
                                        <span class="span-barra" id="con-ars" >-
                                            <input type="hidden" name="NumeroDispoEA" >
                                        </span>
                                        <span class="span-barra" id="con-yuw" >-
                                            <input type="hidden" name="NumeroDispoEY" >
                                        </span>
                                        <span class="span-barra"  id="tubo1m" >-
                                            <input type="hidden" name="NumeroDispoT1" >
                                        </span>
                                        <span class="span-barra" id="tubo415">-
                                            <input type="hidden" name="NumeroDispoT415" >
                                        </span>
                                        <span id="oximetro" >-
                                            <input type="hidden" name="NumeroDispoO" >
                                        </span>
                                         
                                    </p>
                                    
                                    <p id="descripcion" class="secc-c">
                                        <label for="descripcion">Descripcion</label>
                                        <input readonly type="text" name="descripcion" id="descripcion" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                                        <input type="hidden" name="nombreServ" id="nombreServ" value="">
                                    </p>
                                    <p id="costoServ">
                                        <label for="costoServ">Costo de Servicio</label>
                                        <input readonly type="number" min="0" name="costoServ" id="costoServ" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                                    </p>
                                    <p id="garantia">
                                        <label for="garantia">Garantia</label>
                                        <input readonly type="number" min="0" name="garantia" id="garantiaValor" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                                    </p>
                                    <p>
                                        <label for="costoEnvio" id="medioPagoLabel">Costo de Envio</label>
                                        <input type="number" name="costoEnvio" id="medioPago" autocomplete="off" value="{{ old('costoEnvio') }}" placeholder="Costo Envio">
                                        <select  name="medioPagoEnvio" id="medioPago" >
                                            <optgroup label="Envio">
                                            <option value="" >Seleccione Medio De Pago</option>
                                            <option value="Efectivo" >Efectivo</option>
                                            <option value="Bank" >Bank</option>
                                            <option value="Mercado Pago" >Mercado Pago</option>
                                            <option value="Uala" >Uala</option>
                                            <option value="A Confirmar" >A Confirmar</option>
                                        </select> 
                                        @error('costoEnvio')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p>
                                    <p>
                                        <label for="medioPago" id="medioPagoLabel">Medios de Pago</label>
                                        <select class="completo" name="medioPagoAlquiler" id="medioPago" >
                                            <optgroup label="Alquiler">
                                            <option value="" >Seleccione Medio De Pago</option>
                                            <option value="Efectivo" >Efectivo</option>
                                            <option value="Bank" >Bank</option>
                                            <option value="Mercado Pago" >Mercado Pago</option>
                                            <option value="Uala" >Uala</option>
                                            <option value="A Confirmar" >A Confirmar</option>
                                        </select> 
                                        <select name="medioPagoGarantia" id="medioPago" class="medioPagoG completo">
                                            <optgroup label="Garantia">
                                            <option value="" >Seleccione Medio De Pago</option> 
                                            <option value="Efectivo" >Efectivo</option>
                                            <option value="Bank" >Bank</option>
                                            <option value="Mercado Pago" >Mercado Pago</option>
                                            <option value="Uala" >Uala</option>
                                            <option value="A Confirmar" >A Confirmar</option>
                                        </select>  
                                        @error('medioPagoAlquiler')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p>
                                    <p>
                                        <label for="nombreCliente">Nombre del Cliente</label>
                                        <input maxlength="35" class="completo" type="text" name="nombreCliente" id="nombreCliente" autocomplete="off" value="{{ old('nombreCliente')  }}" >
                                        @error('nombreCliente')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    
                                    <p>
                                        <label for="dni">Dni</label>
                                        <input maxlength="30"  class="completo" type="number" name="dni" id="dni" autocomplete="off" value="{{ old('dni')  }}" >
                                        @error('dni')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p>
                                        <label for="direccion">Direccion</label>
                                        <input  maxlength="30" class="completo"  required type="text" name="direccion" id="direccion" autocomplete="off" value="{{ old('direccion')  }}" >
                                        @error('direccion')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        <label for="localidad">Localidad</label>
                                        <input  maxlength="30" class="completo"  required type="text" name="localidad" id="localidad" autocomplete="off" value="{{ old('localidad')  }}" >
                                        @error('localidad')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        <label for="telefono">Telefono</label>
                                        <input  maxlength="18" class="completo"  type="number" name="telefono" id="telefono" autocomplete="off" value="{{ old('telefono')  }}" >
                                        @error('telefono')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    
                                    <p>
                                        <label for="fechaInicio">Fecha Entrega</label>
                                        <input  class="completo" type="datetime-local" name="fechaInicio" id="fechaInicio" autocomplete="off" value="{{ old('fechaInicio')  }}" >
                                        @error('fechaInicio')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        <label for="dias">Mes/Meses</label>
                                        <select class="completo"  name="dias" id="dias" >
                                            <option value="">La cantidad de Meses</option>
                                            <option value="15" >15 Dias</option>
                                            <option value="1" >1 Mes</option>
                                            <option value="2" >2 Meses</option>
                                            <option value="3" >3 Meses</option>
                                            <option value="4" >4 Meses</option>
                                            <option value="5" >5 Meses</option>
                                            <option value="6" >6 Meses</option>
                                            <option value="7" >7 Meses</option>
                                            <option value="8" >8 Meses</option>
                                            <option value="9" >9 Meses</option>
                                            <option value="10" >10 Meses</option>
                                            <option value="11" >11 Meses</option>
                                            <option value="12" >12 Meses</option>
                                        </select>
                                        @error('dias')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p>
                                    <p id="fechaFin"> 
                                        <label for="fechaFin">Fecha Finalizacion</label>
                                        <input  readonly type="text"   autocomplete="off" value="{{ old('fechaFin')  }}" >
                                        <input readonly type="hidden" name="fechaFin"  autocomplete="off" value="{{ old('fechaFin')  }}" > 
                                    </p>
                                    <p>
                                        <label for="recibe">Recibe</label>
                                        <input  maxlength="30"  class="completo" type="text" name="recibe" id="recibe" autocomplete="off" value="{{ old('recibe')  }}" >
                                        @error('recibe')
                                            <span class="error">{{ $message }}</span>
                                        @enderror </p>
                                    <p>
                                        <label for="email">Email</label>
                                        <input  maxlength="60" type="email" name="email" id="email" autocomplete="off" value="{{ old('email')  }}">
                                    </p>
                                    <p> 
                                        <label for="comentarios">Comentarios</label>
                                        <textarea maxlength="252" rows="3" cols="50" type="text" name="comentarios" id="comentarios">{{ old('comentarios') }}</textarea>
                                    </p>
                                    <p id="btn-pedido-agregar"> 
                                        <button class="btn-verModificar button-completo"  disabled  type="sumbit" id="btn-alquiler-agregar">Agregar Alquiler</button>
                                    </p>                               
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            
        @endif

        
    </div> 


<div class="paginacion">
        {{$pedidos->links()}}
</div> 

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
<!--
<script src="js/moment-with-locales.js"></script>
<script src="js/moment.js"></script>
                                        -->
@endsection