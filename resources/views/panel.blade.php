@extends('layouts.plantilla')

@section('titulo','HHOxigeno')



@section('subTitulo', 'PANEL')

@section('contenido')
 
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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO NO SE ENCONTRO UN ALQUILER -->
        @if ( isset($mensaje2) )
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "{{ $mensaje2 }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
        <!--CONTROLA SI HAY UN ERROR -->
        @if ($errors->any())
                <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "Error al Realizar La Operacion",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif



<div class="panel">
    @if (auth()->user()->hasRoles(['admin','administrador']))

        <div class="grid-container"> 
                <div class="grid-item" id="btn-abrir-popup">
                    <div class="icono">
                        <i class="fas fa-plus-square"></i>
                    </div>
                    <div class="icono-titulo">
                        AGREGAR ALQUILER
                    </div>
                </div>  
                <div class="grid-item" id="btn-abrir-popup-gasto">
                    <div class="icono">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="icono-titulo">
                        AGREGAR GASTO
                    </div> 
                </div>  

                <div class="grid-item" id="btn-abrir-popup-buscar">
                    <div class="icono">
                        <i class="fas fa-search"></i> 
                    </div>
                    <div class="icono-titulo">
                        BUSCAR ALQUILER
                        
                    </div> 
                </div>  

                <div class="grid-item" id="urlCambio">
                    <div class="icono">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="icono-titulo">
                        CAMBIO      
                    </div> 
                </div>
            
                <div class="grid-item" id="btn-abrir-popup-renta">
                    <div class="icono">
                        @foreach ($rentab as $renta)
                            <span class="val-renta">{{$renta->valor}}</span> <i class="fas fa-percentage"></i>
                        @endforeach
                    </div>
                    <div class="icono-titulo">
                        RENTABILIDAD ANUAL
                    </div>
                </div>
            
                <div class="grid-item" id="btn-abrir-popup-tarea">
                    <div class="icono">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="icono-titulo">
                        AGREGAR TAREAS
                    </div>
                </div> 
                <div class="grid-item" id="btn-abrir-popup-reposicion">
                    <div class="icono">
                        <i class="fas fa-balance-scale-left"></i>
                    </div>
                    <div class="icono-titulo">
                        AGREGAR REPOSICION
                    </div>
                </div> 
            
        </div>
    @else
        <div class="grid-container-logistica"> 

            <div class="grid-item" id="btn-abrir-popup-buscar">
                <div class="icono">
                    <i class="fas fa-search"></i> 
                </div>
                <div class="icono-titulo">
                    BUSCAR ALQUILER
                    
                </div> 
            </div>   
            <div class="grid-item" id="urlCalendario">
                <div class="icono">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="icono-titulo">
                    CALENDARIO 
                </div> 
            </div> 
        </div>   
    @endif     
    
</div> 
<br>
<br>
<br>
<br>
<br>
<br>
<!-- AGREGAR ALQUILER-->
<div class="overlay" id="overlay">
    <div class="popup" id="popup">

        <div class="content-formulario content-alta4">

            <div class="contact-wrapper">
                
                <div class="modifica-form alta4">
                <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                    <h1>Agregar Nuevo Alquiler</h1>
                    <form action="/agregarPedido" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="usuario" id="usuario" value="{{ Auth::user()->name }} {{ Auth::user()->apellido }}">         
                        <input type="hidden" name="dispoER" id="dispoER">
                        <input type="hidden" name="dispoEA" id="dispoEA">
                        <input type="hidden" name="dispoEY" id="dispoEY">
                        <input type="hidden" name="dispoT1" id="dispoT1">
                        <input type="hidden" name="dispoT415" id="dispoT415"> 
                        <input type="hidden" name="dispoO" id="dispoO">
                        <input type="hidden" name="imgServ" id="imgServ">

                        
                        <p class="secc-a">
                            <label for="idServicio">Servicio</label>
                            <select name="idServicio" id="idServicio" class="completo">
                                <option value="">Seleccione un Servicio</option>
                                @foreach($servicios as $servicio)
                                <option value="{{ $servicio->idServicio }}" >
                                    
                                    S-{{$servicio->idServicio}}{{--@if($servicio->dispoER!=0)R
                                    @elseif($servicio->dispoEA!=0)A
                                    @elseif($servicio->dispoEY!=0)Y
                                    @endif
                                    --}} - {{ $servicio->nombreServ }}
                                </option> 
                                @endforeach 
                            </select>
                            @error('idServicio')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p>
                        <p class="span-Dispo secc-b" > 
                            <span class="span-barra ">RES</span>
                            <span class="span-barra">ARS</span>
                            <span class="span-barra">YUW</span>
                            <span class="span-barra">T/680L</span>
                            <span class="span-barra">T/415L</span>
                            <span >OXI</span>
                            <span class="span-barra" id="con-res" >-
                                <input type="hidden" name="NumeroDispoER" >
                            </span>
                            <span class="span-barra" id="con-ars" >-
                                <input type="hidden" name="NumeroDispoEA" >
                            </span>
                            <span class="span-barra" id="con-yuw" >-
                                <input type="hidden" name="NumeroDispoEY" >
                            </span>
                            <span class="span-barra"  id="tubo1m" >-
                                <input type="hidden" name="NumeroDispoT1" >
                            </span>
                            <span class="span-barra" id="tubo415">-
                                <input type="hidden" name="NumeroDispoT415" >
                            </span>
                            <span id="oximetro" >-
                                <input type="hidden" name="NumeroDispoO" >
                            </span>
                                
                        </p>
                        
                        <p id="descripcion" class="secc-c">
                            <label for="descripcion">Descripcion</label>
                            <input readonly type="text" name="descripcion" id="descripcion" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                            <input type="hidden" name="nombreServ" id="nombreServ" value="">
                        </p>
                        <p id="costoServ">
                            <label for="costoServ">Costo de Servicio</label>
                            <input readonly type="number" min="0" name="costoServ" id="costoServ" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                        </p>
                        <p id="garantia">
                            <label for="garantia">Garantia</label>
                            <input readonly type="number" min="0" name="garantia" id="garantiaValor" autocomplete="off" value="" placeholder="Seleccione un Servicio">
                        </p>
                        <p>
                            <label for="costoEnvio" id="medioPagoLabel">Costo de Envio</label>
                            <input type="number" name="costoEnvio" id="medioPago" autocomplete="off" value="{{ old('costoEnvio') }}" placeholder="Costo Envio">
                            <select  name="medioPagoEnvio" id="medioPago" >
                                <optgroup label="Envio">
                                <option value="" >Seleccione Medio De Pago</option>
                                <option value="Efectivo" >Efectivo</option>
                                <option value="Bank" >Bank</option>
                                <option value="Mercado Pago" >Mercado Pago</option>
                                <option value="Uala" >Uala</option>
                                <option value="A Confirmar" >A Confirmar</option>
                            </select> 
                            @error('costoEnvio')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p>
                        <p>
                            <label for="medioPago" id="medioPagoLabel">Medios de Pago</label>
                            <select class="completo" name="medioPagoAlquiler" id="medioPago" >
                                <optgroup label="Alquiler">
                                <option value="" >Seleccione Medio De Pago</option>
                                <option value="Efectivo" >Efectivo</option>
                                <option value="Bank" >Bank</option>
                                <option value="Mercado Pago" >Mercado Pago</option>
                                <option value="Uala" >Uala</option>
                                <option value="A Confirmar" >A Confirmar</option>
                            </select> 
                            <select name="medioPagoGarantia" id="medioPago" class="medioPagoG completo">
                                <optgroup label="Garantia">
                                <option value="" >Seleccione Medio De Pago</option> 
                                <option value="Efectivo" >Efectivo</option>
                                <option value="Bank" >Bank</option>
                                <option value="Mercado Pago" >Mercado Pago</option>
                                <option value="Uala" >Uala</option>
                                <option value="A Confirmar" >A Confirmar</option>
                            </select>  
                            @error('medioPagoAlquiler')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p>
                        <p>
                            <label for="nombreCliente">Nombre del Cliente</label>
                            <input maxlength="35" class="completo" type="text" name="nombreCliente" id="nombreCliente" autocomplete="off" value="{{ old('nombreCliente')  }}" >
                            @error('nombreCliente')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        
                        <p>
                            <label for="dni">Dni</label>
                            <input maxlength="30"  class="completo" type="number" name="dni" id="dni" autocomplete="off" value="{{ old('dni')  }}" >
                            @error('dni')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>

                        <p>
                            <label for="direccion">Direccion</label>
                            <input  maxlength="30" class="completo"  required type="text" name="direccion" id="direccion" autocomplete="off" value="{{ old('direccion')  }}" >
                            @error('direccion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        <p>
                            <label for="localidad">Localidad</label>
                            <input  maxlength="30" class="completo"  required type="text" name="localidad" id="localidad" autocomplete="off" value="{{ old('localidad')  }}" >
                            @error('localidad')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        <p>
                            <label for="telefono">Telefono</label>
                            <input  maxlength="18" class="completo"  type="number" name="telefono" id="telefono" autocomplete="off" value="{{ old('telefono')  }}" >
                            @error('telefono')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        
                        <p>
                            <label for="fechaInicio">Fecha Entrega</label>
                            <input  class="completo" type="datetime-local" name="fechaInicio" id="fechaInicio" autocomplete="off" value="{{ old('fechaInicio')  }}" >
                            @error('fechaInicio')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        <p>
                            <label for="dias">Mes/Meses</label>
                            <select class="completo"  name="dias" id="dias" >
                                <option value="">La cantidad de Meses</option>
                                <option value="15" >15 Dias</option>
                                <option value="1" >1 Mes</option>
                                <option value="2" >2 Meses</option>
                                <option value="3" >3 Meses</option>
                                <option value="4" >4 Meses</option>
                                <option value="5" >5 Meses</option>
                                <option value="6" >6 Meses</option>
                                <option value="7" >7 Meses</option>
                                <option value="8" >8 Meses</option>
                                <option value="9" >9 Meses</option>
                                <option value="10" >10 Meses</option>
                                <option value="11" >11 Meses</option>
                                <option value="12" >12 Meses</option>
                            </select>
                            @error('dias')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p>
                        <p id="fechaFin"> 
                            <label for="fechaFin">Fecha Finalizacion</label>
                            <input  readonly type="text"   autocomplete="off" value="{{ old('fechaFin')  }}" >
                            <input readonly type="hidden" name="fechaFin"  autocomplete="off" value="{{ old('fechaFin')  }}" > 
                        </p>
                        <p>
                            <label for="recibe">Recibe</label>
                            <input  maxlength="30"  class="completo" type="text" name="recibe" id="recibe" autocomplete="off" value="{{ old('recibe')  }}" >
                            @error('recibe')
                                <span class="error">{{ $message }}</span>
                            @enderror </p>
                        <p>
                            <label for="email">Email</label>
                            <input  maxlength="60" type="email" name="email" id="email" autocomplete="off" value="{{ old('email')  }}">
                        </p>
                        <p> 
                            <label for="comentarios">Comentarios</label>
                            <textarea maxlength="252" rows="3" cols="50" type="text" name="comentarios" id="comentarios">{{ old('comentarios') }}</textarea>
                        </p>
                        <p id="btn-pedido-agregar"> 
                            <button class="btn-verModificar button-completo"  disabled  type="sumbit" id="btn-alquiler-agregar">Agregar Alquiler</button>
                        </p>                               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<!--AGREGAR GASSTO-->
<div class="overlay" id="overlay-gasto">
    <div class="popup" id="popup-gasto">

        <div class="content-formulario content-alta">

            <div class="contact-wrapper">
                
                <div class="modifica-form alta">
                <p href="#" id="btn-cerrar-popup-gasto" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                    <h1>Agregar Nuevo Gasto</h1>
                    <form action="/agregarGastoSalida" method="POST" enctype="multipart/form-data">
                    @csrf
                        <p>
                            <!--CODIGO PHP PARA OBTENER LA FECHA ACTUAL-->
                            @php 
                                $fecha= date("d/m/Y");  
                            @endphp
                            <label for="fecha">Fecha</label>
                            <input readonly type="text" name="fecha" id="fecha" autocomplete="off" value="{{ $fecha }}" >
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
                                @foreach($usuadmin as $user)
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
                            <label for="costo">Costo  </label>
                            <input type="number" name="costo" id="costo" autocomplete="off" value="{{ old('costo') }}" >
                            @error('costo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                            
                        <p>
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" maxlength="252" id="descripcion" cols="30" rows="10">{{ old('concepto') }}</textarea> 
                            @error('descripcion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        <p>
                            <label for="medioPago">Medio De Pago</label>
                            <select  disabled name="medioPago" id="medioPagoGasto"  >
                                <option value="">Selecciona Medio De Pago</option>
                                <option value="Efectivo" >Efectivo</option>
                                <option value="Bank" >Bank</option>
                                <option value="Mercado Pago" >Mercado Pago</option> 
                                <option value="Ualá" >Ualá</option>
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
<!--BUSCAR ALQUILER-->
<div class="overlay" id="overlay-buscar"> 
    <div class="popup" id="popup-buscar">

        <div class="content-formulario-busca">

            <div class="contact-wrapper-busca">
                
                <div class="busca">
                    <p id="btn-cerrar-popup-buscar" class="btn-cerrar-popup-busca"><i class="fas fa-times-circle"></i></p>
                    <div class="box">           
                        <form action="/adminPedidos">
                            <h1>Buscar Alquiler</h1>
                            <input class="search-busca" type="text" name="buscar" value="" placeholder="N° Alquiler  /  Dni  /  Nombre / Tel. / Direccion" autocomplete="off">
                            <input type="hidden" name="buscarBandera" value="si" >
                            
                            <button type="submit" class="buscar"><i class="fas fa-search"></i></button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div> 
<!--AGREGAR TAREAS-->
<div class="overlay" id="overlay-tarea">
    <div class="popup" id="popup-tarea">

        <div class="content-formulario content-alta">

            <div class="contact-wrapper">
                
                <div class="modifica-form ">
                <p href="#" id="btn-cerrar-popup-tarea" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                    <h1>Agregar Nueva Tarea</h1>
                    <form action="/agregarTarea" method="POST" enctype="multipart/form-data">
                    @csrf 

                        
                        <p>
                            <label for="altaUsuario">Alte de Tarea:</label>
                            <input readonly type="text" name="altaUsuario" id="altaUsuario" autocomplete="off" value=" {{Auth::user()->name}}  {{Auth::user()->apellido}}" > 
                        </p>    
                        <p>
                            <label for="idAsignada">Asignar a:</label>
                            <select  name="idAsignada" id="idAsignada" >
                                <option value="">Selecciona un Usuario</option> 
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }} - {{ $usuario->rol }}</option> 
                                @endforeach
                                
                            </select>
                            @error('idAsignada')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p>  
                        <p id="descripcion">
                            <label for="descripcion">Descripcion</label>
                            <textarea style="height: 130px;" maxlength="80" name="descripcion" id="descripcion" cols="7" rows="50" placeholder="Escriba su Tarea a Realizar">{{ old('descripcion') }}</textarea>    
                            @error('descripcion')
                                <span class="error">{{ $message }}</span>
                            @enderror 
                        </p> 
                        <p>
                            @php
                                $fechaHoy=date("Y-m-d");
                            @endphp
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" autocomplete="off" min="{{$fechaHoy }}" value="{{$fechaHoy}}" >
                            @error('fecha')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>
                        <p id="btn-pedido-agregar"> 
                            <button  class="btn-verModificar" id="btn-tarea-agregar" type="sumbit"  >Agregar Tarea</button>
                        </p>                               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   
<!--MODIFICAR RENTABILIDAD-->
<div class="overlay" id="overlay-renta"> 
    <div class="popup" id="popup-renta">

        <div class="content-formulario-busca">

            <div class="contact-wrapper-busca">
                
                <div class="busca">
                    <p id="btn-cerrar-popup-renta" class="btn-cerrar-popup-busca"><i class="fas fa-times-circle"></i></p>
                    <div class="box">           
                        <form action="/modificarRentabilidad" method="POST" enctype="multipart/form-data">
                        @csrf 
                            <h1>Rentabilidad Anual</h1>
                            @foreach($rentab as $renta)
                                <input class="search-renta" type="number" step="0.01" name="renta" value="{{ $renta->valor }}"  autocomplete="off">
                                <input type="hidden" name="idRenta" value="{{ $renta->idRentabilidad }}" >
                            @endforeach
                            <button type="submit" class="renta"><i class="fas fa-percentage"></i></button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
 <!--AGREGAR REPOSICION-->
 <div class="overlay" id="overlay-reposicion">
    <div class="popup" id="popup-reposicion">

        <div class="content-formulario content-alta">

            <div class="contact-wrapper">
                
                <div class="modifica-form alta">
                <p href="#" id="btn-cerrar-popup-reposicion" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                    <h1>Agregar Nueva Reposición</h1>
                    <form action="/agregarDesgloseActivo" method="POST" enctype="multipart/form-data">
                    @csrf  
                        <p>
                            <!--CODIGO PHP PARA OBTENER LA FECHA ACTUAL-->
                            @php 
                                $fecha= date("d/m/Y");  
                            @endphp
                            <label for="fecha">Fecha</label>
                            <input readonly type="text" name="fecha" id="fecha" autocomplete="off" value="{{ $fecha }}" >
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
                            <input type="number" name="reponer" id="reponer" value="{{ old('reponer') }}">
                            @error('reponer')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </p>               
                        <p>
                            <label for="descripcionReponer">Descripcion</label>
                            <textarea name="descripcion" maxlength="252" id="descripcionReponer" cols="30" rows="10">{{ old('descripcion') }}</textarea> 
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
 


<script src="js/btnClick.js"></script>  <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
@endsection