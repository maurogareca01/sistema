@extends('layouts.plantilla')

@section('titulo','Modificacion deL Ph')



@section('subTitulo', 'INVENTARIO  - ACTUALIZACION DEL PH')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Equipo N° {{$tubo->idTubo}}</h3>
            <form action="/modificarTuboPH/{$tubo->idTubo}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idTubo" value="{{$tubo->idTubo }}">
 
                 
                <p>
                    @php
                        $fechaHoy=date('Y-m')
                    @endphp
                    <label for="fechaPh">Fecha de PH</label>
                    <input  type="month" name="fechaPh" id="fechaPh" autocomplete="off" min="{{ $fechaHoy  }}" value="{{ $fechaHoy  }}" placeholder="{{ $tubo->fechaPh  }}">
                    @error('fechaPh')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                        
                
                <p> 
                    <label for="comentario">Fallos</label>
                    <textarea readonly rows="3" cols="50"  type="text" name="comentario" id="comentario">{{ $tubo->comentario }}</textarea>
                </p>
                
                 
                
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminTubos'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Actualizar  PH</button>
                </p>                                
            </form>
        </div>
    </div>
</div>

<script src="../js/alertas.js"></script>

@endsection