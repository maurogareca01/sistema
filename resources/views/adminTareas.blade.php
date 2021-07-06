@extends('layouts.plantilla')

@section('titulo','Administrador De Tareas')



@section('subTitulo', 'TAREAS')

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
                title: "No se pudo Agregar La Tarea",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif   
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CAMBIA EN ESTADO DEL PEDIDO A ENTREGADO -->
        @if (session('mensaje4'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje4') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif 
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO NO HAY STOCK DE COSAS -->
        @if (session('mensaje5'))
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('mensaje5') }}",
                    showConfirmButton: false,
                    timer: 2000
                    }) 
                </script>
        @endif 
    <div class="tablas">
        <div class="content-input">
            
                <form>    
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Tarea" autocomplete="off">
                            
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
                        <th>N° Tarea</th> 
                        <th>Alta de Tarea:</th>
                        <th>Descripcion</th>
                        <th>Fecha a Realizar</th>
                        <th>Asignada a:</th>
                        <th>Estado</th>

                        @if (!auth()->user()->hasRoles(['logistica']))

                        <th colspan="2" class="text-center">
                            <p  class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $tarea)

                    <tr>
                             
                         <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $tarea->fecha;
                            $fecha = date("d/m/Y ", strtotime($originalDate));  
                        @endphp
                        <td> {{ $tarea->idTarea }} </td> 
                        <td> {{ $tarea->altaUsuario }}</td>
                        <td>
                            <button type="button" onclick="ver('{{$tarea->descripcion}}')">Ver</button>
                        </td>
                        <td>{{$fecha}}</td>
                        <td class="{{  
                            $tarea->idAsignada=='Asignacion Pendiente' ? 'entrega': 
                             'asignada' 
                            }} "> 
                            @if($tarea->idAsignada=='Asignacion Pendiente')
                                <button type="button" class="btn-color"> {{ $tarea->idAsignada}} </button>
                            @else 
                                {{ $tarea->usuarioAsignada}}
                            @endif   
                        </td>
                         
                        <td class="{{  
                            $tarea->estado=='Pendiente' ? 'entrega':'entregado'}} ">
                            
                            @if($tarea->estado=='Pendiente')
                                <form action="/cambiarEstadoTarea/{{ $tarea->idTarea }}" method="POST" class="cambiar-estado-pendiente">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{ $tarea->estado }} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $tarea->estado}} </button>
                                </form>
                            @elseif($tarea->estado=='Realizada')
                                <form action="/cambiarEstadoTarea/{{ $tarea->idTarea  }}" method="POST" class="cambiar-estado-realizado">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{ $tarea->estado }} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{ $tarea->estado}} </button>
                                </form>
                            @endif 
                        </td> 
                        
                        @if (!auth()->user()->hasRoles(['logistica']))

                            <td>
                                <a href="/formModificarTarea/{{ $tarea->idTarea }}" class="btn-update">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            <td>
                                <form action="/eliminarTarea/{{ $tarea->idTarea }}" method="POST" class="formulario-eliminar">
                                    @csrf
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </form>    
                            </td>
                        @endif 
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>   

        @if (!auth()->user()->hasRoles(['logistica']))

            <div class="overlay" id="overlay">
                <div class="popup" id="popup">

                    <div class="content-formulario content-alta">

                        <div class="contact-wrapper">
                            
                            <div class="modifica-form ">
                            <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                <h1>Agregar Nueva Tarea</h1>
                                <form action="/agregarTarea" method="POST" enctype="multipart/form-data">
                                @csrf 
    
                                    
                                    <p>
                                        <label for="altaUsuario">Alte de Tarea:</label>
                                        <input readonly type="text" name="altaUsuario" id="altaUsuario" autocomplete="off" value=" {{Auth::user()->name}}  {{Auth::user()->apellido}}" > 
                                    </p>    
                                    <p>
                                        <label for="idAsignada">Asignar a:</label>
                                        <select  name="idAsignada" id="idAsignada" >
                                            <option value="">Selecciona un Usuario</option> 
                                            @foreach($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }} - {{ $usuario->rol }}</option> 
                                            @endforeach
                                            
                                        </select>
                                        @error('idAsignada')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p>  
                                    <p id="descripcion">
                                        <label for="descripcion">Descripcion</label>
                                        <textarea style="height: 130px;" maxlength="80" name="descripcion" id="descripcion" cols="7" rows="50" placeholder="Escriba su Tarea a Realizar">{{ old('descripcion') }}</textarea>    
                                        @error('descripcion')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p> 
                                    <p>
                                        @php
                                            $fechaHoy=date("Y-m-d");
                                        @endphp
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" autocomplete="off" min="{{$fechaHoy }}" value="{{$fechaHoy}}" >
                                        @error('fecha')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p id="btn-pedido-agregar"> 
                                        <button  class="btn-verModificar" id="btn-tarea-agregar" type="sumbit"  >Agregar Tarea</button>
                                    </p>                               
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        @endif 


    </div>
</div>   
<div class="paginacion">
        {{$tareas->links()}}
    </div> 

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
<!--
<script src="js/moment-with-locales.js"></script>
<script src="js/moment.js"></script>
                                        -->
@endsection