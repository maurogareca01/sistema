@extends('layouts.plantilla')

@section('titulo','Administrador De Alquileres Archivados')



@section('subTitulo', 'ALQUILERES ARCHIVADOS')

@section('contenido')
 

<div class="inven-tablas">

    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIO EL ESTADO A ARCHIVADO -->
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

    <div class="tablas">
        <div class="sopala-inventario">
            <div class=" inventario">
                <ul class="inven">

                    <li><a href="/adminPedidos">Alquileres</a></li>
                    <li><a href="/adminPedidosArchivados">Archivados</a></li>
                </ul>
            </div>
        </div>
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Alquiler Archivado" autocomplete="off">
                            
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
                        <th>Medio De Pago</th>
                        <th>Cliente</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Dias</th>
                        <th>Descargas</th>
                        <th>Estado</th> 
                        <th></th> 
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
                            <button type="button" onclick="verServ('{{ $pedido->idServicio }}','{{ $pedido->nombreServ }}','{{ $pedido->descripcion }}','{{ $pedido->imgServ }}','{{$pedido->dispoER}}','{{$pedido->dispoEA}}','{{$pedido->dispoT1}}','{{$pedido->dispoT415}}','{{$pedido->dispoO}}')">
                            S-{{$pedido->idServicio}}@if($pedido->dispoER!=0)R
                            @elseif($pedido->dispoEA!=0)A
                            @endif 
                            </button>
                        </td>
                        <td> {{ $pedido->costoServ }}</td>
                        <td> {{ $pedido->garantia }}</td>
                        <td> {{ $pedido->costoEnvio }} </td>
                        <td> {{$pedido->medioPago}} </td>
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
                            {{$pedido->nombreCliente}}</button>
                        </td>

                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $fechaFin }}</td>
                        <td>{{ $pedido->dias *30}}</td>
                        <td>
                            <button type="button" onclick="verPdfs('{{$pedido->idPedido}}')">Descargas</button>
                        </td>
                        <td class="archivado">
                            <button type="submit" class="btn-color"> {{ $pedido->estadoPedido}} </button>
                        </td> 
                        <td>
                            <form action="/eliminarPedido/{{ $pedido->idPedido }}" method="POST" class="formulario-eliminar">
                                @csrf
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td> 
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>   

        
</div>   
<div class="paginacion">
        {{$pedidos->links()}}
</div> 
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
 
@endsection