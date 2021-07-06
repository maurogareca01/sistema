@extends('layouts.plantilla')

@section('titulo','Modificacion de Tarea')



@section('subTitulo', 'TAREAS  - MODIFICACION DE TAREA')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Tarea N° {{$tarea->idTarea}}</h3>
            <form action="/modificarTarea/{$tarea->idTarea}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idTarea" value="{{$tarea->idTarea }}">
                
                <p>
                    <label for="altaUsuario">Alta de Tarea:</label>
                    <input readonly type="text" name="altaUsuario" id="altaUsuario" autocomplete="off" value=" {{ $tarea->altaUsuario }} " > 
                </p>    
                <p>
                    <label for="idAsignada">Asignar a:</label>
                    <select name="idAsignada" id="idAsignada" >
                        <option value="{{$tarea->usuarioAsignada}}">{{ $tarea->usuarioAsignada }} - ACTUAL</option> 
                        @foreach($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->apellido}} - {{ $usuario->rol }}</option> 
                        @endforeach
                    </select>
                    @error('idAsignada')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>  
                <p> 
                    <label for="descripcion">Descripcion</label>
                    <textarea style="height: 130px;" maxlength="80" rows="7" cols="50"   type="text" name="descripcion" id="descripcion">{{ $tarea->descripcion }}</textarea>
                    @error('descripcion')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" autocomplete="off" value="{{ $tarea->fecha }}" >
                    @error('fecha')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminTareas'" type="button">Volver</button>
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