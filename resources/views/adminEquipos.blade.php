@extends('layouts.plantilla')

@section('titulo','Administrador De Equipos')



@section('subTitulo', 'INVENTARIO  -  EQUIPOS ')

@section('contenido')
 

<div class="inven-tablas">

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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION -->
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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION -->
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
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UN CAMBIO DE ESTADO -->
        @if (session('cambio'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('cambio') }}",
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
                title: "No se pudo Agregar el Equipo",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif   
    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminEquipos">Equipos</a></li>
                <li><a href="/adminTubos">Tubos</a></li>
                <li><a href="/adminOximetros">Oximetros</a></li>
                <li><a href="/adminServicios">Servicios</a></li>
            </ul>
        </div>
    </div>
    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Equipo" autocomplete="off">
                            
                        <button type="submit"  class="search-btn">
                             <i class="fas fa-search"></i>
                        </button>
                         
                    </div>
                </form>
            
        </div>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>N° Equipo</th>
                        <th>N° Serie</th>
                        <th>Nombre</th>
                        <th>Horas</th>
                        <th>Vencido</th> 
                        <th>Psi (5 a 7)</th>
                        <th>Concen-2lpm</th>
                        <th>Concen- 4lpm</th>
                        <th>Manteni- <br> miento</th>
                        <th>Fallos</th>
                        <th>Estado</th>

                        <th>Imagen</th>

                        <th colspan="2" class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipos as $equipo)

                    <tr>
                        <td> 
                            @if($equipo->nombre=='Respironics')R{{ $equipo->idEquipo }} 
                            @elseif($equipo->nombre=='Airsep')A{{ $equipo->idEquipo }} 
                            @elseif($equipo->nombre=='Yuwell')Y{{ $equipo->idEquipo }} 
                            @endif 

                        </td>
                        <td> {{ $equipo->numSerie }} </td>
                        <td> {{ $equipo->nombre }} </td>
                        <td>
                            <button type="button" onclick="verHs('{{$equipo->hsCompra}}','{{$equipo->hsAct}}','{{$equipo->hsUltCam}}','{{$equipo->hsProxCam}}')">Horas</button>
                        </td>
                        <td class="{{  
                            $equipo->vencido=='No' ? 'Disponible': 
                            ($equipo->vencido =='Si' ? 'NoDisponible' : 'entrega')}}"> 
                            <button type="button" class="btn-color">{{ $equipo->vencido   }}</button>  
                        </td> 
                        <td> {{ $equipo->psi }}</td>
                        <td> {{ $equipo->concen2lpm }}</td>
                        <td> {{ $equipo->concen4lpm }}</td>
                        <td>
                            <button type="button" onclick="ver('{{$equipo->mantenimiento}}')">Ver</button>
                        </td>

                        <td>
                            <input type="hidden" value="{{$equipo->comentario}}" id="{{ $equipo->idEquipo }}">
                            <button type="button" onclick="com('{{ $equipo->idEquipo }}')">Ver</button>
                        </td>

                        <td class="{{  
                            $equipo->estado=='Disponible' ? 'Disponible': 
                            ($equipo->estado =='En Uso' ? 'Disponible' : 'entrega')}}">

                            @if($equipo->estado=='Revisar')
                            <form action="/cambiarEstadoEquipo/{{ $equipo->idEquipo }}" method="POST" class="cambiar-estado-revisar">
                                @csrf
                                <input type="hidden"  name="estado" value="{{$equipo->estado}} " class="cambiar-estado">
                                <button type="submit" class="btn-color"> {{$equipo->estado}} </button>
                            </form>
                            @elseif($equipo->estado=='Reparacion')
                                <form action="/cambiarEstadoEquipo/{{ $equipo->idEquipo }}" method="POST" class="cambiar-estado-reparacion">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$equipo->estado}} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{$equipo->estado}} </button>
                                </form>
                            @else
                                <button type="button" disabled class="btn-color"> {{$equipo->estado}}</button>
                            @endif
                        </td>
                        

                        <td>
                            <button type="button" onclick="ver2('{{$equipo->imgE}}')">Ver</button>
                        </td>
                        <td>
                            <a href="/formModificarEquipo/{{ $equipo->idEquipo }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        <td>
                            <form action="/eliminarEquipo/{{ $equipo->idEquipo }}" method="POST" class="formulario-eliminar">
                                @csrf
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  

        <div class="overlay" id="overlay">
            <div class="popup" id="popup">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Equipo</h1>
                            <form action="/agregarEquipo" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <label for="numSerie">Numero de Serie</label>
                                    <input  maxlength="30" type="text" name="numSerie" id="numSerie" autocomplete="off" value="{{ old('numSerie') }}" >
                                </p>
                                <p>
                                    <label for="nombre">Tipo/Nombre</label>
                                    <select  class="completo" name="nombre" id="nombre" >
                                        <option value="">Selecciona Concentrador</option>
                                        <option value="Respironics">Respironics</option>
                                        <option value="Airsep">Airsep</option>
                                        <option value="Yuwell">Yuwell</option>
                                    </select>
                                    @error('nombre')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="hsCompra">Horas de Compra</label>
                                    <input maxlength="15" type="number" name="hsCompra" id="hsCompra" autocomplete="off" value="{{ old('hsCompra') }}" >
                                    @error('hsCompra')
                                        <span class="error">{{ $message }}</span>
                                    @enderror     
                                </p>
                                <p>
                                    <label for="hsAct">Horas Actuales</label>
                                    <input maxlength="15"  type="number" name="hsAct" id="hsAct" autocomplete="off" value="{{ old('hsAct')  }}" >
                                    @error('hsAct')
                                        <span class="error">{{ $message }}</span>
                                    @enderror  
                                </p>
                                <p>
                                    <label for="hsProxCam">Horas del Proximo Cambio</label>
                                    <input maxlength="15"  type="number" name="hsProxCam" id="hsProxCam" autocomplete="off" value="{{ old('hsProxCam')  }}">
                                    @error('hsProxCam')
                                        <span class="error">{{ $message }}</span>
                                    @enderror  
                                </p>
                                <p>
                                    <label for="psi">Psi</label>
                                    <input min="0" step=".01" type="number" name="psi" id="psi" autocomplete="off" value="{{ old('psi')  }}" >
                                </p>
                                <p>
                                    <label for="estado">Disponibilidad</label>
                                    <select  class="completo"  name="estado" id="estado" >
                                        <option value="">Selecciona Disponibilidad</option>
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
                                    <input  class="completo"   min="0" step=".01" type="number" name="concen2lpm" id="concen2lpm" autocomplete="off" value="{{ old('concen2lpm') }}" >
                                    @error('concen2lpm')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="concen4lpm">Concentracion a 4lpm</label>
                                    <input  class="completo"  min="0" step=".01"  type="number" name="concen4lpm" id="concen4lpm" autocomplete="off" value="{{ old('concen4lpm')}}">
                                    @error('concen4lpm')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="mantenimiento">Mantenimiento</label>
                                    <textarea  rows="3" cols="50" maxlength="252" type="text" name="mantenimiento"  id="mantenimiento">{{ old('mantenimiento')}}</textarea>
                                </p> 
                                <p>
                                    <label for="imgE">Cargar Imagen</label>
                                    <input type="file" accept="image/*" name="imgE" id="imgE">
                                </p>
                                <p>
                                    <button class="btn-verModificar button-completo" disabled id="btn-equipo-agregar" type="sumbit">Agregar Equipo</button>
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
        {{$equipos->links()}}
    </div>
<br>
<br>
<br> 
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
<script src="js/formu-ajax.js"></script>  <!--SCRIPT DE FORM-->


@endsection