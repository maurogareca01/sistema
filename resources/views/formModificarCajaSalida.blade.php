@extends('layouts.plantilla')

@section('titulo','Modificacion de Salida')



@section('subTitulo', 'CAJA  - MODIFICACION DE SALIDA')

@section('contenido')
 

<div class="content-formulario content-alta">
    <div class="contact-wrapper">
        <div class="modifica-form alta">
            <h3>Salida N° {{$cajaSalida->idSalida}}</h3>
            <form action="/modificarCajaSalida/{$caja->idSalida}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idSalida" value="{{$cajaSalida->idSalida }}"> 
                <input type="hidden" name="costoViejo" value="{{$cajaSalida->costo }}"> 
                
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
                        <option value="{{$cajaSalida->idUsuario }}">{{$cajaSalida->cuenta }}</option> 
                    </select>
                    @error('cuenta')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>  
                <p>
                    <label for="tipo">Concepto</label>
                    <select name="tipo" id="tipo"> 
                        <option selected value="{{$cajaSalida->tipo }}">
                            @if($cajaSalida->tipo=='garantiaActivas')
                                Garantias Activas 
                            @else
                                Propio del Usuario 
                            @endif    
                        </option>    
                    </select>
                    @error('tipo')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="tipoSalida">Tipo de Salida</label>
                    <select name="tipoSalida" id="tipoSalida" >
                        <option selected value="{{$cajaSalida->tipoSalida}}"> 
                            @if($cajaSalida->tipoSalida=='otros')
                                Otros
                            @else
                                Compra de Equipo
                            @endif  
                        </option>    
                    </select>
                    @error('tipoSalida')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="costo">Costo  </label>
                    <input type="number" name="costo" id="costo" autocomplete="off" value="{{$cajaSalida->costo}}" >
                    @error('costo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="descripcion">Descripcion</label>
                    <textarea rows="3" cols="50" maxlength="252" type="text" name="descripcion"  id="descripcion">{{ $cajaSalida->descripcion}}</textarea>
                    @error('descripcion')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="medioPago">Medio De Pago</label>
                    <select   name="medioPago" id="medioPagoGasto"  >
                        <option value="{{ $cajaSalida->medioPago}}">{{ $cajaSalida->medioPago}} </option> 
                    </select>
                    @error('medioPago')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                  
                 
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminCajaSalida'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/formu-ajax.js')}}"></script>  
 

@endsection