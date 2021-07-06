@extends('layouts.plantilla')

@section('titulo','Administrador De Cambios')



@section('subTitulo', 'CAMBIOS ')

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
                        <th>N° Servicio</th>
                        <th>Respironics</th>
                        <th>Airsep</th>
                        <th>Yuwell</th>
                        <th>Tubo 680L</th>
                        <th>Tubo 415L</th>
                        <th>Oximetro</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th> 
                        <th colspan="2 ">CAMBIO</th>
                         

                         
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)

                    <tr>
                            <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $pedido->fechaInicio;
                            $fechaInicio = date("d/m/Y", strtotime($originalDate)); 
                            $originalDate = $pedido->fechaFin;
                            $fechaFin = date("d/m/Y", strtotime($originalDate)); 
                        @endphp
                        <td> {{ $pedido->idPedido }} </td>
                        <td> {{ $pedido->nombreCliente }} </td>
                        <td> 
                            S-{{$pedido->idServicio}}@if($pedido->dispoER!=0)R
                            @elseif($pedido->dispoEA!=0)A
                            @elseif($pedido->dispoEY!=0)Y
                            @endif 
                        </td>
                        <td> 
                            @php if($pedido->dispoER<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td> 
                            @php if($pedido->dispoEA<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td> 
                            @php if($pedido->dispoEY<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td> 
                            @php if($pedido->dispoT1<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td> 
                            @php if($pedido->dispoT415<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td> 
                            @php if($pedido->dispoO<>0){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $fechaFin }}</td>
                        <td class="{{  
                            $pedido->estadoPedido=='Espera' ? 'espera': 
                            ($pedido->estadoPedido =='Entrega' ? 'entrega' : 
                            ($pedido->estadoPedido =='Entregado' ? 'entregado' : 
                            ($pedido->estadoPedido =='Retirar' ? 'retirar' : 
                            ($pedido->estadoPedido =='Retirado' ? 'retirado' : 'espera'   )))) 
                            }} ">
                            <button type="button" disabled class="btn-color">{{ $pedido->estadoPedido }}</button> 
                        </td>
                        <td>
                            <input type="hidden" value="{{$pedido->cambio}}" id="{{$pedido->idPedido}}">
                            <button type="button" onclick="com('{{$pedido->idPedido}}')">Cambio</button>
                        </td>
                        @if ($pedido->dispoERCambio==0 && $pedido->dispoEACambio==0  && $pedido->dispoEYCambio==0  && $pedido->dispoT1Cambio==0  && $pedido->dispoT415Cambio==0  && $pedido->dispoOCambio==0 )
                            <td>
                                <a href="/formCambioPedido/{{ $pedido->idPedido }}" class="btn-update">
                                    <i class="fas fa-retweet"></i>
                                </a>
                            </td>    
                        @else
                            <td></td>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
              
        </div>   
 
    </div>
</div>   
<div class="paginacion">
    {{$pedidos->links()}}
</div>  

<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->

@endsection