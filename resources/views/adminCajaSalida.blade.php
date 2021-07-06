@extends('layouts.plantilla')

@section('titulo','Administrador De Caja')



@section('subTitulo', 'CAJA SALIDA')

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
        <!--CONTROLA SI HAY UN ERROR EN EL FORMULARIO DE MODIFICACION-->
        @if ($errors->any())
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "No se pudo Agregar el Gasto",
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
                        <th>N° Salida</th>  
                        <th>Alta de Salida:</th>  
                        <th>Fecha Inicio</th>  
                        <th>Costo</th> 
                        <th>Descripcion</th>
                        <th>Origen de Dinero</th>
                        <th>Concepto</th>
                        <th>Medio de Pago</th> 

                        <th colspan="2" class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajaSalidas as $caja)

                    <tr>  
                        <td> {{ $caja->idSalida }} </td> 
                        <td> {{ $caja->usuario }} </td> 
                        @php   
                            $fecha=date("d/m/Y", strtotime($caja->fecha));
                        @endphp
                        <td> {{ $fecha }} </td> 
                        <td> {{ $caja->costo }} </td>
                        <td> <button type="button" onclick="ver('{{$caja->descripcion }}')">Ver</button></td>
                        <td> {{ $caja->cuenta }} </td>
                        <td>
                            @if($caja->tipo=='garantiaActivas')
                                Garantias Activas
                            @else
                                Propio del Usuario
                            @endif 
                        </td>  
                        <td> {{ $caja->medioPago }} </td>  

                         

                        @if($caja->tipo=='propioUsuario')  
                            <td>
                                <a href="/formModificarCajaSalida/{{ $caja->idSalida }}" >
                                    <button type="submit" class="btn-update"><i class="fas fa-pen"></i></i></button>
                                </a>
                            </td>
                            <td>
                                <form action="/eliminarCajaSalida/{{ $caja->idSalida }}" method="POST" class="formulario-eliminar">
                                    @csrf
                                    <input type="hidden" name="idUsuario" value="{{ $caja->idUsuario }}">
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </form>    
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif

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

                            <h1>Agregar Nuevo Gasto</h1>
                            <form action="/agregarGastoSalida" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <!--CODIGO PHP PARA OBTENER LA FECHA ACTUAL-->
                                    @php 
                                        $fecha= date("d/m/Y");  
                                        $fechaOriginal= date("Y-m-d");  
                                    @endphp
                                    <label for="fecha">Fecha</label>
                                    <input readonly type="text"   id="fecha" autocomplete="off" value="{{ $fecha }}" >
                                    <input readonly type="hidden" name="fecha"   value="{{ $fechaOriginal }}" >
                                </p>
                                <p>
                                    <label for="usuario">Usuario que Hace la Salida:</label>
                                    <input readonly type="text" name="usuario" id="usuario" value="{{ Auth::user()->name }} {{ Auth::user()->apellido }}" >
                                    <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                                </p>
                                <p>
                                    <label for="cuenta">Origen del Dinero:</label>
                                    <select name="cuenta" id="cuenta"> 
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
                                    <label for="dineroGarantiaLiquidas">Dinero de Garantia Liquidas</label>
                                    <input readonly type="number" id="dineroGarantiaLiquidas" placeholder="Seleccione Origen de Dinero">
                                </p>
                                <p>
                                    <label for="tipo">Concepto</label>
                                    <select disabled name="tipo" id="tipo"> 
                                        <option value="">Seleccione un Concepto</option>  
                                        <option value="propioUsuario">Propio del Usuario</option>   
                                        <option value="garantiaActivas">Garantias Activas</option>  
                                    </select>
                                    @error('tipo')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                
                                <p>
                                    <label for="tipoSalida">Tipo de Salida</label>
                                    <select name="tipoSalida" id="tipoSalida" >
                                        <option value="">Selecciona el Tipo de Salida</option>
                                        <option value="compraEquipo" >Compra de Equipo</option>
                                        <option value="otros" >Otros</option>
                                    </select>
                                    @error('tipoSalida')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="costo">Costo  </label>
                                    <input type="number" name="costo" id="costo" autocomplete="off" value="{{ old('costo') }}" >
                                    @error('costo')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                 
                                <p>
                                    <label for="descripcion">Descripcion</label>
                                    <textarea name="descripcion" maxlength="252" id="descripcion" cols="30" rows="10">{{ old('descripcion') }}</textarea> 
                                    @error('descripcion')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p>
                                    <label for="medioPago">Medio De Pago</label>
                                    <select disabled name="medioPago" id="medioPagoGasto"  >
                                        <option value="">Selecciona Medio De Pago</option>
                                        <option value="Efectivo" >Efectivo</option>
                                        <option value="Bank" >Bank</option>
                                        <option value="Mercado Pago" >Mercado Pago</option>
                                        <option value="Uala" >Ualá</option>
                                    </select>
                                    @error('medioPago')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <button class="btn-verModificar" id="btn-gasto-agregar" type="sumbit">Agregar Gasto</button>
                                </p>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>  

    <div class="paginacion">
        {{$cajaSalidas->links()}}
    </div>

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>  
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection