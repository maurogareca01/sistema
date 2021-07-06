@extends('layouts.plantilla')

@section('titulo','Administrador Desglose')



@section('subTitulo', 'DESGLOSE')

@section('contenido')
 

<div class="inven-tablas">
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO LA ACTUALIZACION DE GARANTIAS ACTIVAS -->
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
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO LA REPOSICION DE GARANTIAS -->
    
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
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION DE  REPOSICION DE GARANTIAS -->
    
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
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION DE  REPOSICION DE GARANTIAS -->
    
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
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN CAMBIO DE ESTADO DE REPOSICION DE GARANTIAS -->
    
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
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN CAMBIO DE ESTADO DE REPOSICION DE GARANTIAS -->
    
    @if (session('mensaje6'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('mensaje6') }}",
            showConfirmButton: false,
            timer: 2000
            }) 
        </script>
    @endif

    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION DE  COSTO FIJO -->
    
    @if (session('mensaje7'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('mensaje7') }}",
            showConfirmButton: false,
            timer: 2000
            }) 
        </script>
    @endif
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION DE  REPOSICION DE GARANTIAS -->
    
    @if (session('mensaje8'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('mensaje8') }}",
            showConfirmButton: false,
            timer: 2000
            }) 
        </script>
    @endif
    
    <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION DE FONDO HH -->
    
    @if (session('mensaje9'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('mensaje9') }}",
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
            title: "No se pudo Agregar",
            showConfirmButton: false,
            timer: 2000
            }) 
        </script>
    @endif 

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
         
        <br>
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>Cuenta De:</th>  
                        <th>Garantias Activas</th>
                        <th>FCI</th>
                        <th>Plazo Fijo</th>
                        <th>Activos</th>
                        <th>Efectivo</th>
                        <th>Liquidas Hoy</th>
                        <th>Estado</th>
                        <th> </th>
                         
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)

                    <tr> 
                        <td>{{ $usuario->name }} {{ $usuario->apellido }} </td>
                        <td> {{ $usuario->garantiaActiva }} </td>
                        <td> 
                            @if($usuario->porcenFci)
                                <b>[ {{ $usuario->porcenFci }}% ] </b>
                            @endif
                            {{ $usuario->fci }} 
                        </td>
                        <td> 
                            @if($usuario->porcenPlazoFijo)
                                <b>[ {{ $usuario->porcenPlazoFijo }}% ] </b>
                            @endif
                            {{ $usuario->plazoFijo }} 
                        </td>
                        <td> {{ $usuario->activos}} </td>
                        <td> {{ $usuario->efectivo}} </td>
                        <td>{{ $usuario->liquidasHoy}}</td>
                        <td> 
                            @if ($usuario->estado=='peligro') 
                                <i class="fas fa-exclamation-circle" style="font-size:30px;color:#cf4429;"></i>
                            @else 
                                <i class="fas fa-check" style="font-size:30px;"></i> 
                            @endif

                        </td>
                        <td>
                            @if($usuario->tipo != 'Control de Efectivo')
                                <a href="/formModificarGarantiasUsuarios/{{ $usuario->id }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endif    
                        </td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
        </div>  
    </div>
    <br>
    <br>
    <div class="tablas">
        <h1 class="titulo-dispo">--Costo Fijos--Desglose Fondo liquidez HH--</h1>
          
        <div class="content desglose">
            
            <table class="content-table">
                <thead>
                    <tr>
                    <th>Descripcion</th>  
                    <th>Costo</th>
                    <th colspan="2" class="text-center">
                        <p href="" class="btn-add" id="btn-abrir-popup-CostoFijo">
                            <i class="fas fa-plus-square"></i> 
                        </p>
                    </th>
                        
                    </tr>
                </thead>
                <tbody>
                <tr>
                <td>Sueldos</td>
                <td> {{ $sueldos}} </td>
                <td> </td>
                <td> </td>
                </tr>
                    
                    @foreach($costoFijo as $costo)

                    
                    <td> {{ $costo->descripcion}} </td>
                    <td> {{ $costo->valor}} </td> 
                    <td>
                        <a href="/formModificarCostoFijo/{{ $costo->idCostoFijo }}" class="btn-update">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form action="/eliminarCostoFijo/{{ $costo->idCostoFijo }}" method="POST" class="formulario-eliminar">
                            @csrf
                            <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                        </form>    
                    </td>

                    </tr>
                
                    @endforeach
                    

                </tbody>
            </table>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>Cuenta</th>  
                        <th>Cash</th>
                        <th>Bank</th>
                        <th>Total</th>
                        <th>
                        <p href="" class="btn-add" id="btn-abrir-popup-fondoHH">
                            <i class="fas fa-pen"></i>
                        </p>
                        </th>                     
                    </tr>
                </thead>
                <tbody>
                <tr>  
                     
                    <td> {{ $fondoHH->cuenta}} </td>
                    <td> {{ $fondoHH->cash}} </td>
                    <td> {{ $fondoHH->bank}} </td>  
                    <td> {{ $fondoHH->total}} </td>  
                    <td>
                        
                    </td>
                </tr>
                 
                    

                </tbody>
            </table>
         </div>  
    </div>
    
    
    <br>
    <br>

    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscarSalida" value="" placeholder="Buscar Salida" autocomplete="off">
                            
                        <button type="submit"  class="search-btn">
                             <i class="fas fa-search"></i>
                        </button>
                         
                    </div>
                </form>
            
        </div>
        <div class="content ">
            <table class="tabla-garantiaActiva">
                <thead>
                    <tr>
                        <th>N° Salida</th>  
                        <th>Alta de Salida:</th>  
                        <th>Fecha Inicio</th>  
                        <th>Costo</th> 
                        <th>Descripcion</th>
                        <th>Origen de Dinero</th>
                        <th>Concepto</th>
                        <th>Medio de Pago</th>
 
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajaSalidas as $caja)

                    <tr>  
                        @php
                            $originalDate = $caja->fecha;
                            $fecha = date("d/m/Y ", strtotime($originalDate));  
                        @endphp
                        <td> {{ $caja->idSalida }} </td> 
                        <td> {{ $caja->usuario }} </td> 
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
  

                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table> 
        </div>  
        <div class="paginacion">
            {{$cajaSalidas->links()}}
        </div>
    </div>

    <br>
    <br>

    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminDesglose">Reposiciones</a></li>  
            </ul> 
        </div>
        <div class="cartelGaran"> 
            <button onclick="location.href='/adminDesgloseArchivados'" type="button">Reposiciones Archivadas</button>
        </div> 
    </div> 
    <div class="tablas">
        <h1 class="titulo-dispo">--Reposicion - Desglose Activos--</h1>

        <div class="content-input">
            <form>    
                <div class="input">
                    <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Reposicion" autocomplete="off">
                        
                    <button type="submit"  class="search-btn">
                            <i class="fas fa-search"></i>
                    </button>
                        
                </div>
            </form>
        </div> 
        <div class="content">
            <table class="tabla-reposicion">
                <thead>
                    <tr>
                        <th>N° de Reposicion:</th>  
                        <th>Fecha:</th>  
                        <th>Alta de Reposicion:</th>
                        <th>Cuenta a Reponer:</th>
                        <th>Dinero</th>
                        <th>Descripcion</th>
                        <th>Medio de Pago</th>
                        <th  class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-balance-scale-left"></i>
                            </p>
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($desgloseActivos as $des)

                    <tr> 
                        @php
                            $fecha=date("d/m/Y",strtotime($des->fecha));
                        @endphp
                        <td>{{ $des->idDesglose }}</td>
                        <td>{{ $fecha }}</td>
                        <td>{{ $des->altaUsuario }}</td>
                        <td>{{ $des->reponeUsuario }}</td>
                        <td>{{ $des->dinero }}</td>
                        <td><button type="button" onclick="ver('{{$des->descripcion }}')">Ver</button></td>
                        <td>{{ $des->medioDePago }}</td>
                        @if($des->estado=='Visible')
                            <td>
                                <form action="/archivarReposicionDesgloseActivo/{{$des->idDesglose }}" method="POST" class="formulario-archivar">
                                    @csrf
                                    <input type="hidden" name="idDesglose" value="{{$des->idDesglose }}">
                                    <button type="submit" class="btn-update"><i class="fas fa-folder-open"></i></button>
                                </form>    
                            </td>
                        @else
                            <td></td>
                        @endif
                        <!--
                        <td> 
                            <a href="/formModificarDesgloseActivos/{{$des->idDesglose }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        <td>
                            <form action="/eliminarDesgloseActivos/{{$des->idDesglose }}" method="POST" class="formulario-eliminar">
                                @csrf
                                <input type="hidden" name="idDesglose" value="{{$des->idDesglose }}">
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td>
                         -->
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
        </div>  
        <div class="paginacion">
            {{$desgloseActivos->links()}}
        </div>
    </div>

    <br>
    <br>

    <div class="overlay" id="overlay">
            <div class="popup" id="popup">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nueva Reposición</h1>
                            <form action="/agregarDesgloseActivo" method="POST" enctype="multipart/form-data">
                            @csrf  
                                <p>
                                    <!--CODIGO PHP PARA OBTENER LA FECHA ACTUAL-->
                                    @php 
                                        $fecha= date("d/m/Y");  
                                        $fechaOriginal= date("Y-m-d");  
                                    @endphp
                                    <label for="fecha">Fecha</label>
                                    <input readonly type="text"  id="fecha" autocomplete="off" value="{{ $fecha }}" >
                                    <input readonly type="hidden" name="fecha"  value="{{ $fechaOriginal }}" >
                                </p> 
                                <p>
                                    <label for="usuario">Usuario:</label>
                                    <input readonly type="text" name="usuario" id="usuario" value="{{ Auth::user()->name }} {{ Auth::user()->apellido }}" >
                                    <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                                </p>   
                                <p>
                                    <label for="cuenta">Cuenta a Reponer:</label>
                                    <select name="cuenta" id="cuenta"> 
                                        <option value="">Seleccione una Cuenta</option>
                                        @foreach($usuActivos as $user)
                                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}}</option>
                                        @endforeach
                                    </select>
                                    @error('cuenta')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>       
                                <p>
                                    <label for="reponer">Dinero A Reponer</label>
                                    <input type="number" name="reponer" value="{{ old('reponer') }}">
                                    @error('reponer')
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
                                    <label for="medioPagoDesglose">Medio De Pago</label>
                                    <select name="medioPagoDesglose" id="medioPagoDesglose"  >
                                        <option value="">Selecciona Medio De Pago</option>
                                        <option value="Efectivo" >Efectivo</option>
                                        <option value="Bank" >Bank</option>
                                        <option value="Mercado Pago" >Mercado Pago</option>
                                        <option value="Uala" >Ualá</option>
                                    </select>
                                    @error('medioPagoDesglose')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>  
                                <p>
                                    <button class="btn-verModificar" id="btn-desgloseReposicion-agregar" type="sumbit">Reponer Dinero</button>
                                </p>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>
    
    
    
    <div class="overlay" id="overlay-CostoFijo">
            <div class="popup" id="popup-CostoFijo">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup-CostoFijo" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Costo Fijo</h1>
                            <form action="/agregarCostoFijo" method="POST" enctype="multipart/form-data">
                            @csrf                  
                                <p>
                                    <label for="descripcion">Descripcion</label>
                                    <textarea name="descripcion" maxlength="252" id="descripcion" cols="30" rows="10">{{ old('descripcion') }}</textarea> 
                                    @error('descripcion')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>   
                                <p>
                                    <label for="valor">Costo Fijo</label>
                                    <input type="number" name="valor" id="valor" value="{{ old('valor') }}">
                                    @error('valor')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p> 
                                <p>
                                    <button class="btn-verModificar" id="btn-desgloseReposicion-agregar" type="sumbit">Agregar Costo Fijo</button>
                                </p>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>

    <div class="overlay" id="overlay-fondoHH">
            <div class="popup" id="popup-fondoHH">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup-fondoHH" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Modificar Fondo HH</h1>
                            <form action="/modificarFondoHH" method="POST" enctype="multipart/form-data">
                            @csrf                  
                                <p>
                                    <label for="cash">Cash</label>
                                    <input type="number" name="cash" id="cash" value="{{ $fondoHH->cash }}">
                                    @error('cash')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>   
                                
                                <p>
                                    <label for="bank">Bank</label>
                                    <input type="number" name="bank" id="bank" value="{{  $fondoHH->bank }}">
                                    @error('bank')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p> 
                                <p>
                                    <button class="btn-verModificar" id="btn-desgloseReposicion-agregar" type="sumbit">Modificar Fondo HH</button>
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
        {{$usuarios->links()}}
    </div>

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/popupBtn-cerrar.js"></script>
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/formu-ajax.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->

@endsection