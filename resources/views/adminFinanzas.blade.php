@extends('layouts.plantilla')

@section('titulo','Administrador De Finanzas')



@section('subTitulo', 'FINANZAS ')

@section('contenido')
 

<div class="inven-tablas">
    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminGaran-Finan">Garantias </a></li>
                <li><a href="/adminFinanzas">Finanzas</a></li> 
                <li><a href="/adminDesglose">Desglose</a></li> 
            </ul>
        </div>
        <div class="cartelGaran">
            <button type="button">
                Garantias Hoy : ${{$garantiaTotal}}
            </button>
        </div>    
        
    </div>
    
    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Finanza" autocomplete="off">
                            
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
                        <th>N° Pedido</th> 
                        <th>Nombre Cliente</th>
                        <th>Cuenta de:</th> 
                        <th>Fecha de Inicio</th>
                        <th>Monto</th>
                        <th>Fecha de Retiro</th>
                        <th>Dias Invertido</th>
                        <th>Rentabilidad Anual</th>
                        <th>Ganancia</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($finanzas as $finanza)

                    <tr>
                        <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate1 = $finanza->fechaInicio;
                            $fechaInicio = date("d/m/Y", strtotime($originalDate1)); 
                            $originalDate2 = $finanza->fechaFin;
                            $fechaFin = date("d/m/Y", strtotime($originalDate2)); 
                        @endphp

                        <td>{{ $finanza->idPedido }} </td>
                        <td>{{ $finanza->nombreCliente }} </td>
                        <td>{{ $finanza->usuario }} </td>
                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $finanza->monto}} </td> 
                        <td>{{ $fechaFin }}</td>
                        <td>{{ $finanza->diasInvertido}} </td>
                        <td>{{ $finanza->rentabAnual}} </td>
                        <td>{{ $finanza->ganancia}} </td>
                        
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
        
    </div>

        

</div>    
    <div class="paginacion">
        {{$finanzas->links()}}
    </div>


@endsection