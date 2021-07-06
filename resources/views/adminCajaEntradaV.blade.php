@extends('layouts.plantilla')

@section('titulo','Administrador De Caja')



@section('subTitulo', 'CAJA ENTRADA VARIOS')

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
                title: "No se pudo Agregar la Entrada",
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
                        <th>N° Entrada</th> 
                        <th>Fecha</th>
                        <th>A Nombre de Quien Entro:</th>
                        <th>Cuenta</th>
                        <th>Dinero de Entrada</th>
                        <th>Costo Envio</th>
                        <th>Medio de Cobro</th>
                        <th>Descripcion</th>
                        <th>Total de Entrada</th>
                        <th>Facturada</th>

                        <th colspan="2" class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajaEntradaV as $caja)

                    <tr>  
                        <td> {{ $caja->idEntradaVarios }} </td>
                        @php   
                            $fecha=date("d/m/Y", strtotime($caja->fecha));
                        @endphp
                        <td> {{ $fecha }} </td>
                        <td> {{ $caja->usuario }} </td>
                        <td> {{ $caja->cuenta }} </td>
                        <td> {{ $caja->dineroEntrada }} </td>
                        <td> {{ $caja->costoEnvio }} </td>
                        <td> {{ $caja->medioCobro }} </td> 
                        <td> <button type="button" onclick="ver('{{$caja->descripcion }}')">Ver</button></td>
                        <td> {{ $caja->total }} </td> 

                        <td class="{{ $caja->facturado=='Si' ? 'entregado': 'retirar' }}"> 

                            @if($caja->facturado=='Si')
                                <form action="/cambiarEstadoFactura/{{ $caja->idEntradaVarios }}" method="POST" class="cambiar-estado-factura-si">
                                    @csrf
                                    <input type="hidden"  name="idEntradaVarios" value="{{ $caja->idEntradaVarios }} " class="cambiar-estado">
                                    <input type="hidden"  name="tipoCaja" value="cajaEntradaVarios" class="cambiar-estado">
                                    <input type="hidden"  name="faturado" value="{{ $caja->facturado}}" class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $caja->facturado}} </button>
                                </form>
                            @elseif($caja->facturado=='No')
                                <form action="/cambiarEstadoFactura/{{ $caja->idEntradaVarios  }}" method="POST" class="cambiar-estado-factura-no">
                                    @csrf
                                    <input type="hidden"  name="idEntradaVarios" value="{{ $caja->idEntradaVarios }} " class="cambiar-estado">
                                    <input type="hidden"  name="tipoCaja" value="cajaEntradaVarios" class="cambiar-estado">
                                    <input type="hidden"  name="faturado" value="{{ $caja->facturado}}" class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $caja->facturado}} </button>
                                </form>
                            @endif  

                        </td>  
                          
                        <td>
                            <a href="/formModificarCajaEntradaV/{{ $caja->idEntradaVarios }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                            </td>
                        <td>
                            <form action="/eliminarCajaEntradaV/{{ $caja->idEntradaVarios }}" method="POST" class="formulario-eliminar">
                                @csrf
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
        <div class="overlay" id="overlay">
            <div class="popup" id="popup">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nueva Entrada</h1>
                            <form action="/agregarGastoEntrada" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <!--CODIGO PHP PARA OBTENER LA FECHA ACTUAL-->
                                    @php 
                                        $fecha= date("d/m/Y");  
                                        $fechaOriginal= date("Y-m-d");  
                                    @endphp
                                    <label for="fecha">Fecha</label>
                                    <input readonly type="text"  id="fecha" autocomplete="off" value="{{ $fecha }}" >
                                    <input readonly type="hidden" name="fecha" value="{{ $fechaOriginal }}" >
                                     
                                </p>
                                <p>
                                    <label for="usuario">A Nombre de Quien Entro:</label>
                                    <select  class="completo"  name="usuario" id="usuario"> 
                                        <option value="">Seleccione un Usuario</option>
                                        @foreach($usuario as $user)
                                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}}</option>
                                        @endforeach
                                    </select>
                                    @error('usuario')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <label for="cuenta">A Que Cuenta se Dirige el Dinero:</label>
                                    <select class="completo" name="cuenta" id="cuenta"> 
                                        <option value="">Seleccione una Cuenta</option>
                                        @foreach($usuario as $user)
                                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}}</option>
                                        @endforeach
                                    </select>
                                    @error('cuenta')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <label for="dineroEntrada">Dinero de Entrada</label>
                                    <input class="completo"  type="number" name="dineroEntrada" id="dineroEntrada" autocomplete="off" value="{{ old('dineroEntrada') }}" >
                                    @error('dineroEntrada')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="medioCobro">Medio De Cobro</label>
                                    <select  class="completo" name="medioCobro" id="medioCobro" >
                                        <option value="">Selecciona Medio De Pago</option>
                                        <option value="Efectivo" >Efectivo</option>
                                        <option value="Bank" >Bank</option>
                                        <option value="Mercado Pago" >Mercado Pago</option>
                                        <option value="Uala" >Uala</option>
                                    </select>
                                    @error('medioCobro')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="descripcion">Descripcion</label>
                                    <textarea class="completo"  name="descripcion" id="descripcion" maxlength="252" cols="30" rows="10"></textarea> 
                                    @error('descripcion')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="costoEnvio">Costo Envio</label>
                                    <input type="number" name="costoEnvio" id="costoEnvio" autocomplete="off" value="{{ old('costoEnvio') }}" >
                                    @error('costoEnvio')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <button class="btn-verModificar button-completo" disabled type="sumbit">Agregar Entrada</button>
                                </p>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

        

</div>    
    <div class="paginacion">
        {{$cajaEntradaV->links()}}
    </div>

<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA FORM-->


@endsection