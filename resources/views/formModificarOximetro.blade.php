@extends('layouts.plantilla')

@section('titulo','Modificacion de Oximetro')



@section('subTitulo', 'INVENTARIO  - MODIFICACION DE OXIMETRO')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Equipo N° {{$oximetro->idOximetro}}</h3>
            <form action="/modificarOximetro/{$oximetro->idOximetro}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idOximetro" value="{{$oximetro->idOximetro }}">
                <p>
                    <label for="estado">Disponibilidad</label> 
                        <select name="estado" id="estado" >
                            <option value="{{ $oximetro->estado  }}">{{ $oximetro->estado  }} - ACTUAL</option> 
                            <option value="Disponible" >Disponible</option> 
                            <option value="Revisar" >Revisar</option>
                            <option value="Reparacion" >Reparacion</option>
                        </select>
                        @error('estado')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                </p>        
                <p> 
                    <label for="descripcion">Descripcion</label>
                    <textarea  maxlength="252"  rows="3" cols="50" type="text" name="descripcion" id="descripcion">{{ $oximetro->descripcion }}</textarea>
                </p> 
                <p>
                    <label for="imgO">Cargar Imagen</label>
                    <input type="file" accept="image/*" name="imgO" id="imgO">
                </p>
                
                <p> 
                    <label for="comentario">Fallos</label>
                    <textarea   maxlength="252" rows="3" cols="50"  type="text" name="comentario" id="comentario">{{ $oximetro->comentario }}</textarea>
                </p>
               
                <p> 
                    <button class="btn-verModificar" type="button" onclick="ver2('{{$oximetro->imgO}}')">Ver Imagen</button> 

                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminOximetros'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div>  
<script src="../js/alertas.js"></script>
 

@endsection