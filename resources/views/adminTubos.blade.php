@extends('layouts.plantilla')

@section('titulo','Administrador de Tubos')



@section('subTitulo', 'INVENTARIO  -  TUBOS ')

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
        <!--CONTROLA SI HAY UN ERROR EN EL FORMULARIO DE MODIFICACION-->
        @if ($errors->any())
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "No se pudo Agregar el Tubo",
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
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Tubo" autocomplete="off">
                            
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
                        <th>N° Tubo</th>
                        <th>Descripcion</th>
                        <th>N° Serie</th>
                        <th>Año</th>
                        <th>Fecha PH</th>
                        <th>Fecha Prox Ph</th>
                        <th>Proximo a Vencer</th>
                        <th>Vencido</th>
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
                    @foreach($tubos as $tubo)

                    <tr>
                        <td> T{{ $tubo->idTubo }} </td>
                        <td> {{$tubo->descripcion}}</td>
                        <td class="ajusterTxt"> {{ $tubo->numSerie }} </td>
                        <td> {{ $tubo->año }}</td>
                        <td> {{$tubo->fechaPh}}</td>
                        <td> {{$tubo->fechaProxPh}} </td>
                        <td> {{$tubo->proximoVencer}}</td>

                        @php    $fechaHoy=date("Y-m") @endphp
                        <td class="{{$tubo->vencido=='Si' ? 'NoDisponible': 'Disponible' }}">  
                            <button type="button" class="btn-color">{{ $tubo->vencido   }}</button>
                        </td>
                        
                        <td>
                            <input type="hidden" value="{{$tubo->mantenimiento}}" id="{{$tubo->idTubo}}-man">
                            <button type="button" onclick="com('{{$tubo->idTubo}}-man')">Ver</button>
                    
                        </td>
                        <td>
                            <input type="hidden" value="{{$tubo->comentario}}" id="{{$tubo->idTubo}}-com">
                            <button type="button" onclick="com('{{$tubo->idTubo}}-com')">Ver</button>
                        </td>
                        <td class="{{  
                            $tubo->estado=='Disponible' ? 'Disponible': 
                            ($tubo->estado =='En Uso' ? 'Disponible' : 'entrega')}}">

                            @if($tubo->estado=='Revisar')
                            <form action="/cambiarEstadoTubo/{{ $tubo->idTubo }}" method="POST" class="cambiar-estado-revisar">
                                @csrf
                                <input type="hidden"  name="estado" value="{{$tubo->estado}} " class="cambiar-estado">
                                <button type="submit" class="btn-color"> {{$tubo->estado}} </button>
                            </form>
                            @elseif($tubo->estado=='Reparacion' && $tubo->vencido=='Si')
                                <form action="/cambiarEstadoTuboVencido/{{ $tubo->idTubo }}" method="POST" class="cambiar-estado-reparacion-vencido">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$tubo->estado}} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{$tubo->estado}} </button>
                                </form>
                            @elseif($tubo->estado=='Reparacion')
                                <form action="/cambiarEstadoTubo/{{ $tubo->idTubo }}" method="POST" class="cambiar-estado-reparacion">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$tubo->estado}} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{$tubo->estado}} </button>
                                </form>
                            @else
                                <button type="button" disabled class="btn-color"> {{$tubo->estado}} </button>
                            @endif
                        </td>

                        <td>
                            <button type="button" onclick="ver2('{{$tubo->imgT}}')">Ver</button>
                        </td>
                        <td>
                            <a href="/formModificarTubo/{{ $tubo->idTubo }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        <td>
                            <form action="/eliminarTubo/{{ $tubo->idTubo }}" method="POST" class="formulario-eliminar">
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
                        
                        <div class="modifica-form">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Tubo</h1>
                            <form action="/agregarTubo" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <label for="numSerie">Numero de Serie</label>
                                    <input class="completo"  maxlength="30" type="text" name="numSerie" id="numSerie" autocomplete="off" value="{{ old('numSerie') }}" >
                                    @error('numSerie')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                
                                <p>
                                    <label for="descripcion">Descripcion</label>
                                    <select class="completo"  name="descripcion" id="Descripcion" >
                                        <option value="">Selecciona Tubo</option>
                                        <option value="680L" > TUBO 680L</option>
                                        <option value="415L" >TUBO 415L</option>
                                    </select>
                                    @error('descripcion')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p>
                                    <label for="año">Año</label>
                                    <input  class="completo" min="1970" max="2155" type="number" name="año" id="año" autocomplete="off" value="{{ old('año') }}" >
                                    @error('año')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p>
                                    <label for="fechaPh">Fecha PH</label>
                                    <input class="completo"  min="0" type="month" name="fechaPh" id="fechaPh" autocomplete="off" value="{{ old('fechaPh')  }}" >
                                    @error('fechaPh')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p>
                                    <label for="estado">Disponibilidad</label>
                                    <select  class="completo"  name="estado" id="estado" >
                                        <option value="">Selecciona Disponibilidad</option>
                                        <option value="Disponible">Disponible</option>
                                        <option value="Revisar">Revisar</option>
                                        <option value="Reparacion">Reparacion</option>
                                    </select>
                                    @error('estado')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p>
                                <p> 
                                    <label for="mantenimiento">Mantenimiento</label>
                                    <textarea maxlength="252"   rows="3" cols="50" type="text" name="mantenimiento" id="mantenimiento">{{ old('mantenimiento') }}</textarea>
                                </p>
                                
                                
                                <p>
                                    <label for="imgT">Cargar Imagen</label>
                                    <input type="file" accept="image/*" name="imgT" id="imgT">
                                </p>
                                <p>
                                    <button class="btn-verModificar button-completo" disabled id="btn-tubo-agregar" type="sumbit">Agregar Tubo</button>
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
    {{$tubos->links()}}
</div>
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
<script src="js/formu-ajax.js"></script>  <!--SCRIPT DE FORM-->



@endsection