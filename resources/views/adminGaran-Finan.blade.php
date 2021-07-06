@extends('layouts.plantilla')

@section('titulo','Administrador De Garantias')



@section('subTitulo', 'GARANTIAS ')

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
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Garantia" autocomplete="off">
                            
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
                        <th>Alta de Alquiler</th> 
                        <th>N° Pedido</th> 
                        <th>Nombre de Cliente</th>
                        <th>Monto</th>
                        <th>Medio de Pago Garantia</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Egreso</th>
                        <th>Cuenta de:</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($garantias as $garantia)

                    <tr>
                        <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate1 = $garantia->fechaInicio;
                            $fechaInicio = date("d/m/Y", strtotime($originalDate1)); 
                            $originalDate2 = $garantia->fechaFin;
                            $fechaFin = date("d/m/Y", strtotime($originalDate2)); 
                        @endphp
                        <td > {{ $garantia->usuario }} </td>
                        <td> {{ $garantia->idPedido }} </td>
                        <td> {{ $garantia->nombreCliente }} </td>
                        <td> {{ $garantia->monto}} </td>
                        <td> {{ $garantia->medioPagoGarantia}} </td>
                        <td>{{ $fechaInicio }}</td>
                        <td>{{ $fechaFin }}</td>
                        <td> {{ $garantia->estaEnCaja}} </td>
                        
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
        
    </div>

        

</div>    
    <div class="paginacion">
        {{$garantias->links()}}
    </div>


@endsection