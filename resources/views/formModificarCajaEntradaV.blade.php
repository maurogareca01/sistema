@extends('layouts.plantilla')

@section('titulo','Modificacion de Entrada')



@section('subTitulo', 'CAJA  - MODIFICACION DE ENTRADA VARIOS')

@section('contenido')
 

<div class="content-formulario content-alta">
    <div class="contact-wrapper">
        <div class="modifica-form alta">
            <h3>Entrada N° {{$cajaEntradaV->idEntradaVarios}}</h3>
            <form action="/modificarCajaEntradaV/{{$cajaEntradaV->idEntradaVarios }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idEntradaV" value="{{$cajaEntradaV->idEntradaVarios }}">
 
                <p>
                    <label for="usuario">A Nombre de Quien Entro:</label>
                    <select name="usuario" id="usuario"> 
                        <option value="{{$cajaEntradaV->usuario }}">{{$cajaEntradaV->usuario }} - ACTUAL</option>
                        @foreach($usuario as $user)
                            <option value="{{$user->name}} {{$user->apellido}}">{{$user->name}} {{$user->apellido}}</option>
                        @endforeach
                    </select>
                    @error('usuario')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <label for="cuenta">A Que Cuenta se Dirige el Dinero:</label>
                    <select name="cuenta" id="cuenta"> 
                        <option value="{{$cajaEntradaV->cuenta }}">{{$cajaEntradaV->cuenta }} - ACTUAL</option>
                        @foreach($usuario as $user)
                            <option value="{{$user->name}} {{$user->apellido}}">{{$user->name}} {{$user->apellido}}</option>
                        @endforeach
                    </select>
                    @error('cuenta')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
 
                <p>
                    <label for="dineroEntrada">Dinero de Entrada</label>
                    <input type="number" name="dineroEntrada" id="dineroEntrada" autocomplete="off" value="{{ $cajaEntradaV->dineroEntrada }}" >
                    @error('dineroEntrada')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="medioCobro">Medio De Cobro</label>
                    <select name="medioCobro" id="medioCobro" >
                        <option value="{{ $cajaEntradaV->medioCobro }}">{{ $cajaEntradaV->medioCobro }} - ACTUAL</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                    </select>
                    @error('medioCobro')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" maxlength="252" cols="30" rows="10">{{ $cajaEntradaV->descripcion }}</textarea> 
                    @error('descripcion')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="costoEnvio">Costo Envio</label>
                    <input type="number" name="costoEnvio" id="costoEnvio" autocomplete="off" value="{{ $cajaEntradaV->costoEnvio }}" >
                    @error('costoEnvio')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminCajaEntradaV'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div>
 <br>
 <br>
 <br>

@endsection