@extends('layouts.plantilla')

@section('titulo','Administrador de Oximetros')



@section('subTitulo', 'INVENTARIO  -  OXIMETROS ')

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
                title: "No se pudo Agregar el Oximetro",
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
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Oximetro" autocomplete="off">
                            
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
                        <th>N° Oximetro</th>
                        <th>Descripcion</th>
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
                    @foreach($oximetros as $oximetro)

                    <tr>
                        <td> X{{ $oximetro->idOximetro }} </td>
                        <td>
                            <button type="button" onclick="ver('{{$oximetro->descripcion}}')">Ver</button>
                        </td> 
                        
                        <td>
                            <input type="hidden" value="{{$oximetro->comentario}}" id="{{$oximetro->idOximetro}}">
                            <button type="button" onclick="com('{{$oximetro->idOximetro}}')">Ver</button>
                        </td> 

                        <td class="{{  
                            $oximetro->estado=='Disponible' ? 'Disponible': 
                            ($oximetro->estado =='En Uso' ? 'Disponible' : 'entrega')}}">
                        
                            @if($oximetro->estado=='Revisar')
                                <form action="/cambiarEstadoOximetro/{{ $oximetro->idOximetro }}" method="POST" class="cambiar-estado-revisar">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$oximetro->estado}} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{$oximetro->estado}} </button>
                                </form>
                            @elseif($oximetro->estado=='Reparacion')
                                <form action="/cambiarEstadoOximetro/{{ $oximetro->idOximetro }}" method="POST" class="cambiar-estado-reparacion">
                                    @csrf
                                    <input type="hidden"  name="estado" value="{{$oximetro->estado}} " class="cambiar-estado">
                                    <button type="submit" class="btn-color"> {{$oximetro->estado}} </button>
                                </form>
                            @else
                                <button type="button" disabled class="btn-color"> {{$oximetro->estado}}</button>
                            @endif 
                        </td>

                        <td>
                            <button type="button" onclick="ver2('{{$oximetro->imgO}}')">Ver</button>
                        </td>
                        <td>
                            <a href="/formModificarOximetro/{{ $oximetro->idOximetro }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        <td>
                            <form action="/eliminarOximetro/{{ $oximetro->idOximetro }}" method="POST" class="formulario-eliminar">
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

                <div class="content-formulario  content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Oximetro</h1>
                            <form action="/agregarOximetro" method="POST" enctype="multipart/form-data">
                            @csrf
                                <p>
                                    <label for="estado">Disponibilidad</label>
                                    <select  name="estado" id="estado" >
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
                                    <label for="descripcion">Descripcion</label>
                                    <textarea rows="3" cols="50" maxlength="252" type="text" name="descripcion"  id="descripcion">{{ old('descripcion')}}</textarea>
                                </p>  
                                
                                <p>
                                    <label for="imgO">Cargar Imagen</label>
                                    <input type="file" accept="image/*" name="imgO" id="imgO">
                                </p>
                                <p>
                                    <button class="btn-verModificar" id="btn-oximetro-agregar" type="sumbit">Agregar Oximetro</button>
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
        {{$oximetros->links()}}
    </div>
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection