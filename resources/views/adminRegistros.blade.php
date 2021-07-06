@extends('layouts.plantilla')

@section('titulo','Administrador De Registros')



@section('subTitulo', 'REGISTROS')

@section('contenido')
 

<div class="inven-tablas">

       
       
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
    
    <div class="tablas">
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
                        <th>Cliente</th>
                        <th>Domicilio</th>
                        <th>localidad</th>
                        <th>Servicio</th>
                        <th>Producto</th>
                        <th>Descripcion</th> 
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Renovacion-Vencimiento</th>
                        <th>Dias</th>
                        <th>Meses de Uso</th>
                        <th>Entrega</th>
                        <th>Retiro</th>
                        <th>Estado</th> 
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)

                    <tr>
                         <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $registro->fechaInicio;
                            $fechaInicio = date("d/m/Y ", strtotime($originalDate)); 
                            $originalDate = $registro->fechaFin;
                            $fechaFin = date("d/m/Y", strtotime($originalDate)); 
                        @endphp
                        <td>{{ $registro->idPedido }} </td>
                        <td>{{ $registro->nombreCliente }} </td>
                        <td>{{ $registro->direccion }}</td>
                        <td>{{ $registro->localidad }}</td>
                        <td>S{{ $registro->idServicio }}</td>
                        <td>{{ $registro->nomServicio }} </td>
                        <td>{{$registro->descripcion}} </td> 
                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $fechaFin }}</td>
                        <td>{{ $registro->dias}}</td>
                        <td>{{ $registro->mesesDeUso}}</td> 
                        <td>{{$registro->logisticaE}}</td>
                        <td>{{$registro->logisticaR}}</td>

                        <td class="{{  
                            $registro->estadoPedido=='Espera' ? 'espera': 
                            ($registro->estadoPedido =='Entrega' ? 'entrega' : 
                            ($registro->estadoPedido =='Entregado' ? 'entregado' : 
                            ($registro->estadoPedido =='Retirar' ? 'retirar' : 
                            ($registro->estadoPedido =='Retirado' ? 'retirado' : 'vencido'   )))) 
                            }} "> 
                            @if($registro->estadoPedido=='Entrega')
                                <form action="/cambiarEstadoPedidoP/{{ $registro->idPedido }}" method="POST" class="cambiar-estado-entrega">
                                    @csrf
                                    <input type="hidden"  name="estadoPedido" value="{{ $registro->estadoPedido }} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $registro->estadoPedido}} </button>
                                </form>
                            @endif
                            @if($registro->estadoPedido=='Entregado')
                                <form action="/vercambiarEstadoPedidoPFecha/{{$registro->idPedido}}" method="get" class="cambiar-estado-entregado">
                                    @csrf
                                    
                                        <input type="hidden"  name="estadoPedido" value="{{ $registro->estadoPedido }} " class="cambiar-estado">
                                        <button type="submit" class="btn-color" id="btn-abrir-popup-elegir-fecha"> {{ $registro->estadoPedido}} </button>
                                        
                                </form> 
                            @endif
                            @if($registro->estadoPedido=='Retirar')
                                <form action="/cambiarEstadoPedidoP/{{ $registro->idPedido }}" method="POST" class="cambiar-estado-retirar">
                                    @csrf
                                    <input type="hidden"  name="estadoPedido" value="{{ $registro->estadoPedido }} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $registro->estadoPedido}} </button>
                                </form>
                            @endif
                            @if($registro->estadoPedido=='Retirado')
                                <form action="/cambiarEstadoPedidoP/{{ $registro->idPedido }}" method="POST" class="cambiar-estado-retirado">
                                    @csrf
                                    <input type="hidden"  name="estadoPedido" value="{{ $registro->estadoPedido }} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $registro->estadoPedido}} </button>
                                </form>  
                            @endif 
                            @if($registro->estadoPedido=='Vencido')
                                <form action="/formModificarPedidoVencidoP/{{$registro->idPedido}}" method="get" class="cambiar-estado-vencido">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $registro->idPedido }}">
                                    <button type="submit" class="btn-color" onclick="vencido('{{ $registro->idPedido }}')"> {{ $registro->estadoPedido}} </button>
                                </form>
                            @endif 
                        </td>
                        @if($registro->estadoPedido=='Entrega') 
                            <td >
                                <a href="/formModificarPedido/{{ $registro->idPedido }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td> 
                            <td>
                                <div id="btn-abrir-popup-comentarios-{{$registro->idPedido}}" >
                                    <button type="submit" onclick="comentarios('{{$registro->idPedido}}')" class="btn-comenta">
                                        @if($registro->comentarios=='')
                                            <i class="fas fa-comment"></i>
                                        @else
                                            <i class="far fa-comment-dots"></i>    
                                        @endif    
                                    </button>
                                </div>
                                <div class="overlay" id="overlay-comentarios-{{$registro->idPedido}}">
                                    <div class="popup" id="popup-comentarios-{{$registro->idPedido}}">
                                        <div class="content-formulario content-alta">
                                            <div class="contact-wrapper">
                                                <div class="modifica-form ">
                                                <p href="#" id="btn-cerrar-popup-comentarios-{{$registro->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                    <h1>Comentarios De Alquiler N°: {{$registro->idPedido}}</h1>
                                                    <form action="/vencidoComentarios/{{$registro->idPedido}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                        <p>
                                                            <label for="comentarios">Comentarios</label>
                                                            <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$registro->comentarios}}</textarea>
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
                                <a href="/formUbicacionGarantiaEntrega/{{ $registro->idPedido }}" class="btn-update">
                                    <i class="fas fa-truck"></i>
                                </a> 
                            </td>  
                            <td>
                                <form action="/eliminarPedido/{{ $registro->idPedido }}" method="POST" class="formulario-eliminar">
                                    @csrf
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </form> 
                            </td>
                        @endif 
                        @if($registro->estadoPedido=='Vencido')
                            <td colspan="4">
                                <div id="btn-abrir-popup-comentarios-{{$registro->idPedido}}" >
                                    <button type="submit" onclick="comentarios('{{$registro->idPedido}}')" class="btn-comenta">
                                        @if($registro->comentarios=='')
                                            <i class="fas fa-comment"></i>
                                        @else
                                            <i class="far fa-comment-dots"></i>    
                                        @endif    
                                    </button>
                                </div>
                                <div class="overlay" id="overlay-comentarios-{{$registro->idPedido}}">
                                    <div class="popup" id="popup-comentarios-{{$registro->idPedido}}">
                                        <div class="content-formulario content-alta">
                                            <div class="contact-wrapper">
                                                <div class="modifica-form ">
                                                <p href="#" id="btn-cerrar-popup-comentarios-{{$registro->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                    <h1>Comentarios De Alquiler N°: {{$registro->idPedido}}</h1>
                                                    <form action="/vencidoComentarios/{{$registro->idPedido}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                        <p>
                                                            <label for="comentarios">Comentarios</label>
                                                            <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$registro->comentarios}}</textarea>
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
                        @if($registro->estadoPedido=='Entregado')
                            <td colspan="2"></td>
                            <td >
                                <a href="/formModificarPedido/{{ $registro->idPedido }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td> 
                            <td>
                                <div id="btn-abrir-popup-comentarios-{{$registro->idPedido}}" >
                                    <button type="submit" onclick="comentarios('{{$registro->idPedido}}')" class="btn-comenta">
                                        @if($registro->comentarios=='')
                                            <i class="fas fa-comment"></i>
                                        @else
                                            <i class="far fa-comment-dots"></i>    
                                        @endif    
                                    </button>
                                </div>
                                <div class="overlay" id="overlay-comentarios-{{$registro->idPedido}}">
                                    <div class="popup" id="popup-comentarios-{{$registro->idPedido}}">
                                        <div class="content-formulario content-alta">
                                            <div class="contact-wrapper">
                                                <div class="modifica-form ">
                                                <p href="#" id="btn-cerrar-popup-comentarios-{{$registro->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                    <h1>Comentarios De Alquiler N°: {{$registro->idPedido}}</h1>
                                                    <form action="/vencidoComentarios/{{$registro->idPedido}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                        <p>
                                                            <label for="comentarios">Comentarios</label>
                                                            <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$registro->comentarios}}</textarea>
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
                        @if($registro->estadoPedido=='Retirar')
                            <td></td>
                                
                            <td >
                                <a href="/formModificarPedido/{{ $registro->idPedido }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td> 
                            <td>
                                <div id="btn-abrir-popup-comentarios-{{$registro->idPedido}}" >
                                    <button type="submit" onclick="comentarios('{{$registro->idPedido}}')" class="btn-comenta">
                                        @if($registro->comentarios=='')
                                            <i class="fas fa-comment"></i>
                                        @else
                                            <i class="far fa-comment-dots"></i>    
                                        @endif    
                                    </button>
                                </div>
                                <div class="overlay" id="overlay-comentarios-{{$registro->idPedido}}">
                                    <div class="popup" id="popup-comentarios-{{$registro->idPedido}}">
                                        <div class="content-formulario content-alta">
                                            <div class="contact-wrapper">
                                                <div class="modifica-form ">
                                                <p href="#" id="btn-cerrar-popup-comentarios-{{$registro->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                    <h1>Comentarios De Alquiler N°: {{$registro->idPedido}}</h1>
                                                    <form action="/vencidoComentarios/{{$registro->idPedido}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                        <p>
                                                            <label for="comentarios">Comentarios</label>
                                                            <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$registro->comentarios}}</textarea>
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
                                <a href="/vercambiarEstadoPedidoPFecha/{{ $registro->idPedido }}" class="btn-update">
                                    <i class="fas fa-truck"></i>
                                </a>
                            </td> 
                        @endif 
                        @if($registro->estadoPedido=='Retirado')
                        <td colspan="4">
                            <div id="btn-abrir-popup-comentarios-{{$registro->idPedido}}" >
                                <button type="submit" onclick="comentarios('{{$registro->idPedido}}')" class="btn-comenta">
                                    @if($registro->comentarios=='')
                                        <i class="fas fa-comment"></i>
                                    @else
                                        <i class="far fa-comment-dots"></i>    
                                    @endif    
                                </button>
                            </div>
                            <div class="overlay" id="overlay-comentarios-{{$registro->idPedido}}">
                                <div class="popup" id="popup-comentarios-{{$registro->idPedido}}">
                                    <div class="content-formulario content-alta">
                                        <div class="contact-wrapper">
                                            <div class="modifica-form ">
                                            <p href="#" id="btn-cerrar-popup-comentarios-{{$registro->idPedido}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                <h1>Comentarios De Alquiler N°: {{$registro->idPedido}}</h1>
                                                <form action="/vencidoComentarios/{{$registro->idPedido}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                    <p>
                                                        <label for="comentarios">Comentarios</label>
                                                        <textarea maxlength="252" name="comentarios" id="comentarios" cols="3" rows="50">{{$registro->comentarios}}</textarea>
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

                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>   
  
    </div>
</div>   
<div class="paginacion">
        {{$registros->links()}}
    </div> 
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
 

@endsection