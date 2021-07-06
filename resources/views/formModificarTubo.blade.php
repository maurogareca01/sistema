@extends('layouts.plantilla')

@section('titulo','Modificacion de Tubo')



@section('subTitulo', 'INVENTARIO  - MODIFICACION DE TUBO')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Equipo N° {{$tubo->idTubo}}</h3>
            <form action="/modificarTubo/{$tubo->idTubo}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idTubo" value="{{$tubo->idTubo }}">

                <p>
                    <label for="numSerie">Numero de Serie</label>
                    <input  maxlength="30" type="text" name="numSerie" id="numSerie" autocomplete="off" value="{{ $tubo->numSerie  }}" placeholder="{{ $tubo->numSerie  }}">
                    @error('numSerie')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="año">Año</label>
                    <input type="number" name="año" id="año" autocomplete="off" value="{{ $tubo->año  }}" placeholder="{{ $tubo->año  }}">
                    @error('año')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="fechaPh">Fecha de PH</label>
                    <input min="0" type="month" name="fechaPh" id="fechaPh" autocomplete="off" value="{{ $tubo->fechaPh  }}" placeholder="{{ $tubo->fechaPh  }}">
                    @error('fechaPh')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="estado">Disponibilidad</label> 
                        <select name="estado" id="estado" >
                            <option value="{{ $tubo->estado  }}">{{ $tubo->estado  }} - ACTUAL</option>
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
                        <select name="descripcion" id="descripcion" >
                            <option value="{{ $tubo->descripcion  }}">TUBO {{ $tubo->descripcion  }} - ACTUAL</option>
                            <option value="680L" >TUBO 680L</option>
                            <option value="415L" >TUBO 415L</option>
                        </select>
                        @error('descripcion')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                </p>  
                <p> 
                    <label for="comentario">Fallos</label>
                    <textarea  maxlength="252"  rows="3" cols="50"  type="text" name="comentario" id="comentario">{{ $tubo->comentario }}</textarea>
                </p>
                
                <p>
                    <label for="imgT">Cargar Imagen</label>
                    <input type="file" accept="image/*" name="imgT" id="imgT">
                </p>
                <p> 
                    <label for="mantenimiento">Mantenimiento</label>
                    <textarea  maxlength="252"  rows="3" cols="50"   type="text" name="mantenimiento" id="mantenimiento">{{ $tubo->mantenimiento }}</textarea>
                </p>
                
                <p>
                    <button  class="btn-verModificar" type="button" onclick="ver2('{{$tubo->imgT}}')">Ver Imagen</button><br>
                </p>
                
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminTubos'" type="button">Volver</button>
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
<script src="../js/alertas.js"></script>

@endsection