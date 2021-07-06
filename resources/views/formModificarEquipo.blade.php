@extends('layouts.plantilla')

@section('titulo','Modificacion de Equipo')



@section('subTitulo', 'INVENTARIO  - MODIFICACION DE EQUIPO')

@section('contenido')
 

<div class="content-formulario content-alta">
    <div class="contact-wrapper">
        <div class="modifica-form alta">
            <h3>Equipo N° {{$equipo->idEquipo}}</h3>
            <form action="/modificarEquipo/{$equipo->idEquipo}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idEquipo" value="{{$equipo->idEquipo }}">

                <p>
                    <label for="numSerie">Numero de Serie</label>
                    <input  maxlength="30" type="text" name="numSerie" id="numSerie" autocomplete="off" value="{{ $equipo->numSerie  }}" placeholder="{{ $equipo->numSerie  }}">
                </p>
                <p>
                    <label for="nombre">Concentrador</label> 
                    <select name="nombre" id="nombre" >
                        <option value="{{ $equipo->nombre  }}">{{ $equipo->nombre  }} - Actual</option>
                        <option value="Respironics" >Respironics</option>
                        <option value="Airsep" >Airsep</option>
                        <option value="Yuwell" >Yuwell</option>
                    </select>
                    @error('nombre')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="hsCompra">Horas de Compra</label>
                    <input  maxlength="15" type="number" name="hsCompra" id="hsCompra" autocomplete="off" value="{{ $equipo->hsCompra  }}" placeholder="{{ $equipo->hsCompra  }}">
                    @error('hsCompra')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="hsUltCam">Horas del Ultimo Cambio</label>
                    <input maxlength="15"  type="number" name="hsUltCam" id="hsUltCam" autocomplete="off" value="{{ $equipo->hsUltCam  }}" placeholder="{{ $equipo->hsUltCam}}">
                    @error('hsUltCam')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="hsAct">Horas Actuales</label>
                    <input maxlength="15"  type="number" name="hsAct" id="hsAct" autocomplete="off" value="{{ $equipo->hsAct  }}" placeholder="{{ $equipo->hsAct  }}">
                    @error('hsAct')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="hsProxCam">Horas del Proximo Cambio</label>
                    <input  maxlength="15" type="number" name="hsProxCam" id="hsProxCam" autocomplete="off" value="{{ $equipo->hsProxCam  }}" placeholder="{{ $equipo->hsProxCam  }}">
                    @error('hsProxCam')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="psi">Psi</label>
                    <input step=".01" type="number" name="psi" id="psi" autocomplete="off" value="{{ $equipo->psi  }}" placeholder="{{ $equipo->psi }}">
                </p>
                <p>
                    <label for="estado">Disponibilidad</label> 
                    <select name="estado" id="estado" >
                        <option value="{{ $equipo->estado  }}">{{ $equipo->estado  }} - ACTUAL</option>
                        <option value="Disponible" >Disponible</option>
                        <option value="Revisar" >Revisar</option>
                        <option value="Reparacion" >Reparacion</option>
                    </select>
                    @error('estado')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="concen2lpm">Concentracion a 2lpm </label>
                    <input min="0" step=".01" type="number" name="concen2lpm" id="concen2lpm" autocomplete="off" value="{{ $equipo->concen2lpm }}" placeholder="{{ $equipo->concen2lpm }}">
                    @error('concen2lpm')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="concen4lpm">Concentracion a 4lpm</label>
                    <input min="0" step=".01" type="number" name="concen4lpm" id="concen4lpm" autocomplete="off" value="{{ $equipo->concen4lpm }}" placeholder="{{ $equipo->concen4lpm }}">
                    @error('concen4lpm')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="imgE">Cargar Imagen</label>
                    <input type="file" accept="image/*" name="imgE" id="imgE">
                </p>
                <p>
                    <label for="mantenimiento">Mantenimiento</label>
                    <textarea  maxlength="252"  rows="3" cols="50" type="text" name="mantenimiento"  id="mantenimiento">{{ $equipo->mantenimiento}}</textarea>
                </p>
                <p> 
                    <label for="comentario">Fallos</label>
                    <textarea  maxlength="252"  rows="3" cols="50"  type="text" name="comentario" id="comentario">{{ $equipo->comentario }}</textarea>
                </p>
                <p>
                    <button class="btn-verModificar" type="button" onclick="ver2('{{$equipo->imgE}}')">Ver Imagen</button> 

                </p>  
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminEquipos'" type="button">Volver</button>
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
<script src="../js/alertas.js"></script>
 

@endsection