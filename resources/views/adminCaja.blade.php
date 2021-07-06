@extends('layouts.plantilla')

@section('titulo','Administrador De Caja')



@section('subTitulo', 'CAJA')

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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION DE CIERRE -->
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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION -->
        @if (session('mensaje5'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje5') }}",
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
                title: "No se pudo Hacer el Cierre",
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
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Salida" autocomplete="off">
                            
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
                        <th>Inicio de Cierre</th>  
                        <th>Fin de Cierre</th>  
                        <th>Ingreso Neto</th>  
                        <th>Ingreso Extra Logistico</th>  
                        <th>Ingreso de Finanzas</th> 
                        <th>Ingreso de Alquileres</th>
                        <th>Compra de Equipos</th>
                        <th>Gastos Netos</th>
                        <th>Gastos Totales</th>
                        <th>Total Neto</th>
                        <th>Caja Banco</th>
                        <th>Caja HH</th> 
                        <th>Comprobacion</th> 
                        <th colspan="3" class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caja as $caj)

                    <tr>  
                        @php   
                            $inicioCierre=date("d/m/Y", strtotime($caj->inicioCierre));
                            $finalCierre=date("d/m/Y", strtotime($caj->finalCierre));
                        @endphp
                        <td> {{ $inicioCierre }} </td> 
                        <td> {{ $finalCierre }} </td> 
                        <td> {{ $caj->ingresoNeto }} </td> 
                        <td> {{ $caj->ingresoExtraLogistica }} </td> 
                        <td> {{ $caj->ingresoFinanzas }} </td>
                        <td> {{ $caj->ingresoOxigeno }} </td>
                        <td> {{ $caj->comprasEquipos }} </td>
                        <td> {{ $caj->gastosNetos }} </td>
                        <td> {{ $caj->gastosTotales }} </td>
                        <td> {{ $caj->totalNeto }} </td> 
                        <td> {{ $caj->cajaBanco }} </td> 
                        <td> {{ $caj->cajaHH }} </td> 
                        <td> {{ $caj->celda }} </td> 
                        <td> 
                            <p class="btn-comenta" style="cursor: pointer;" onclick="verInformes('{{$caj->inicioCierre}}','{{$caj->finalCierre}}','{{$inicioCierre}}','{{$finalCierre}}')">
                                <i class="far fa-list-alt"></i>
                            </p>
                        </td> 
                        
                        <td>
                            <div id="btn-abrir-popup-caja-{{$caj->idCaja}}" >
                                <button type="submit" onclick="informe('{{$caj->idCaja}}')" class="btn-comenta">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="overlay" id="overlay-caja-{{$caj->idCaja}}">
                                <div class="popup" id="popup-caja-{{$caj->idCaja}}">
                                    <div class="content-formulario content-alta">
                                        <div class="contact-wrapper">
                                            <div class="modifica-form ">
                                            <p href="#" id="btn-cerrar-popup-caja-{{$caj->idCaja}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>
                                                <h1>Cambiar Fechas de Caja</h1> 
                                                <form action="/cambiarFechaCajaFinal/{{$caj->idCaja}}" method="POST" enctype="multipart/form-data">
                                                    @csrf 
                                                    <p>
                                                        <label for="inicio">Inicio de Quincena</label>
                                                        <input type="date" name="inicio" id="inicio" value="{{$caj->inicioCierre}}">
                                                        @error('inicio')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror 
                                                    </p>

                                                    <p>
                                                        <label for="final">Cierre de Quincena</label>
                                                        <input type="date" name="final" id="final" value="{{$caj->finalCierre}}">
                                                        @error('final')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror 
                                                    </p>
                                                    <p>
                                                        <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Modificar Fechas de Caja </button>
                                                    </p>                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </td> 
                        <td> 
                            <form action="/eliminarCajaFinal/{{ $caj->idCaja }}" method="POST" class="formulario-eliminar">
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

    <div class="overlay" id="overlay">
            <div class="popup" id="popup">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Cierre</h1>
                            <form action="/agregarCierre" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <label for="inicioCierre">Inicio de Quincena</label>
                                    <input type="date" name="inicioCierre" id="inicioCierre" value="">
                                    @error('inicioCierre')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>

                                <p>
                                    <label for="finalCierre">Cierre de Quincena</label>
                                    <input type="date" name="finalCierre" id="finalCierre" value="">
                                    @error('finalCierre')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Cierre</button>
                                </p>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>  


    <div class="paginacion">
        {{$caja->links()}}
    </div>

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>  
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection