@extends('layouts.plantilla')

@section('titulo','Administrador De Cambios Hechos')



@section('subTitulo', 'CAMBIOS HECHOS')

@section('contenido')
 

<div class="inven-tablas">

        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN CAMBIO -->
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
    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminCambios">Alquileres</a></li>
                <li><a href="/adminCambiosH">Cambios Hechos</a></li> 
            </ul>
        </div>
    </div>      
    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Alquiler Cambiado" autocomplete="off">
                            
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
                        <th>Descripcion Del Cambio</th>  
                        <th>Fecha Entrega/Retiro Cambio</th> 
                        <th colspan="3">Estado</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($cambios as $cambio) 
                    <tr>
                            
                        <td>{{ $cambio->idPedido }}</td>
                        <td>
                            <button type="button" onclick="verClien(
                            '{{$cambio->nombreCliente}}',
                            '{{$cambio->dni}}',
                            '{{$cambio->direccion}}',
                            '{{$cambio->localidad}}',
                            '{{$cambio->telefono}}',
                            '{{$cambio->email}}',
                            '{{$cambio->recibe}}',
                            '{{$cambio->imgDniF}}',
                            '{{$cambio->imgDniD}}',
                            '{{$cambio->imgOrden}}')">
                            {{$cambio->nombreCliente}}</button>
                        </td>
                        <td> 
                            <input type="hidden" value="{{$cambio->descripcion}}" id="{{$cambio->idCalendario}}">
                            <button type="button" onclick="com('{{$cambio->idCalendario}}')">Descripcion</button>
                        </td>
                        <td>{{$cambio->fechaInicio}}</td> 
                        
                        @if($cambio->estadoPedido=='Entrega/Retiro')
                            <td class="entrega">
                                <form action="/cambiarEstadoCambios/{{ $cambio->idCalendario }}" method="POST" class="cambiar-estado-cambio-entrega">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$cambio->estadoPedido}} " class="cambiar-estado">
                                    <button type="submit" class="btn-espera">{{$cambio->estadoPedido}}</button>
                                </form>
                            </td>      
                            <td>
                                <a href="/formModificarCambio/{{ $cambio->idCalendario }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>      
                            <td>
                                <form action="/eliminarCambio/{{ $cambio->idCalendario }}" method="POST" class="formulario-eliminar">
                                    @csrf
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </form>    
                            </td>
                        @else
                            <td colspan="3" class="{{$cambio->estadoPedido=='Entrega/Retiro' ? 'entrega': 'entregado'}}">
                                 
                                
                                    {{ $cambio->estadoPedido }}
                                
                                
                            </td>       
                        @endif
                        

                        
                         
                    </tr>
                    @endforeach
                </tbody>
            </table>
              
        </div>   

         
    </div>
</div>   
  

<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/alertas.js"></script>
@endsection