@extends('layouts.plantilla')

@section('titulo','Modificacion de Oximetro')



@section('subTitulo', ' COSTO FIJO  - MODIFICACION DE COSTO FIJO')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Costo Fijo N° {{$costoFijo->idCostoFijo}}</h3>
            <form action="/modificarCostoFijo" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idCostoFijo" value="{{$costoFijo->idCostoFijo }}">
                <p>
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" maxlength="252" id="descripcion" cols="30" rows="10">{{$costoFijo->descripcion }}</textarea> 
                    @error('descripcion')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>   
                <p>
                    <label for="valor">Costo Fijo</label>
                    <input type="number" name="valor" id="valor" value="{{ $costoFijo->valor  }}">
                    @error('valor')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p> 
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminDesglose'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div>
 
 

@endsection