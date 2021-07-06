@extends('layouts.plantilla')

@section('titulo','Administrador De Caja')



@section('subTitulo', 'CAJA ENTRADA DE ALQUILERES')

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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN CAMBIO DE ESTADO DE FACTURA -->
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
        <!--CONTROLA SI HAY UN ERROR EN EL FORMULARIO DE MODIFICACION-->
        @if ($errors->any())
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "No se pudo Agregar el Equipo",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif   
    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminCaja">Caja</a></li>
                <li><a href="/adminCajaEntrada">Caja E/ Alquileres</a></li>
                <li><a href="/adminCajaEntradaV">Caja E/ Varios</a></li>
                <li><a href="/adminCajaSalida">Caja Salida</a></li> 
            </ul>
        </div>
    </div>
    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Entrada" autocomplete="off">
                            
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
                        <th>N° Alquiler</th> 
                        <th>Fecha Inicio</th>
                        <th>Servicio</th>
                        <th>Garantia</th>
                        <th>Costo Servicio</th>
                        <th>Costo Envio</th>
                        <th>Medio de Pago Alquiler</th>
                        <th>Medio de Pago Garantia</th>
                        <th>Medio de Pago Envio</th>
                        <th>Cuenta Cobro Alquiler</th>
                        <th>Total de Entrada</th>
                        <th>Facturada</th>
 
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajaEntradas as $caja)

                    <tr> 
                        <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $caja->fechaInicio;
                            $fechaInicio = date("d/m/Y ", strtotime($originalDate));  
                        @endphp
                        <td> {{ $caja->usuario }} </td>
                        <td> {{ $caja->idPedido }} </td>
                        <td> {{ $fechaInicio }} </td>
                        <td> {{ $caja->descripcion }} </td>
                        <td> {{ $caja->garantia }} </td>
                        <td> {{ $caja->costoServ }} </td>
                        <td> {{ $caja->costoEnvio }} </td>
                        <td> {{ $caja->medioPagoAlquiler }} </td> 
                        <td> {{ $caja->medioPagoGarantia }} </td> 
                        <td> {{ $caja->medioPagoEnvio }} </td> 
                        <td> {{ $caja->cuentaCobro }} </td> 
                        <td> {{ $caja->total }} </td>  

                        <td class="{{ $caja->facturado=='Si' ? 'entregado': 'retirar' }}"> 

                            @if($caja->facturado=='Si')
                                <form action="/cambiarEstadoFactura/{{ $caja->idEntrada }}" method="POST" class="cambiar-estado-factura-si">
                                    @csrf
                                    <input type="hidden"  name="idEntrada" value="{{ $caja->idEntrada }} " class="cambiar-estado">
                                    <input type="hidden"  name="tipoCaja" value="cajaEntrada" class="cambiar-estado">
                                    <input type="hidden"  name="faturado" value="{{ $caja->facturado}}" class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $caja->facturado}} </button>
                                </form>
                            @elseif($caja->facturado=='No')
                                <form action="/cambiarEstadoFactura/{{ $caja->idEntrada  }}" method="POST" class="cambiar-estado-factura-no">
                                    @csrf
                                    <input type="hidden"  name="idEntrada" value="{{ $caja->idEntrada }} " class="cambiar-estado">
                                    <input type="hidden"  name="tipoCaja" value="cajaEntrada" class="cambiar-estado">
                                    <input type="hidden"  name="faturado" value="{{ $caja->facturado}}" class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $caja->facturado}} </button>
                                </form>
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
        {{$cajaEntradas->links()}}
    </div>
<br>
<br>
<br>
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection