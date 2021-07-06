@extends('layouts.plantilla')

@section('titulo','Administrador De Alertas')



@section('subTitulo', 'ALERTAS')

@section('contenido')
 

<div class="inven-tablas">
 
    <div class="tablas">
        <h1 class="titulo-dispo"> {{$tipoAlerta}}  <br> Desde: {{$alertInicio}} <br>Hasta: {{$alertFinal}}</h1>
         
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>Estado de Alerta</th>
                        <th>Tipo</th>
                        <th>Identificador</th>
                        <th>Descripcion</th> 
                        <th>Fecha</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($alertas as $alerta)

                        <tr> 
                            <td><b>{{$alerta->estadoPedido}}</b></td>
                            <td>
                                @if($alerta->bandera=='tarea')
                                    Tarea  
                                @else
                                    Alquiler
                                @endif        
                            </td>
                            <td>
                                @if($alerta->bandera=='tarea')
                                    <b>{{$alerta->idTarea}}</b>
                                @else
                                    <b>{{$alerta->idPedido}}</b>
                                @endif 
                            </td>
                            <td >
                                <button type="button" onclick="verAlert('{{ $alerta->descripcion }}','{{ $alerta->nombreCliente }}','{{ $alerta->dni }}','{{ $alerta->bandera }}')">Ver</button>
                            </td>
                                
                            <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                            @php
                                $originalDate = $alerta->start;
                                $startA = date("d/m/Y H:i ", strtotime($originalDate));  
                                $startT = date("d/m/Y", strtotime($originalDate));  
                            @endphp

                            <td>
                                @if($alerta->bandera=='tarea')
                                    {{$startT}}
                                @else
                                    {{$startA}}
                                @endif
                            </td> 
                        </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>    
    </div>

        

</div>    
<div class="paginacion">
    {{$alertas->links()}}
</div>

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection