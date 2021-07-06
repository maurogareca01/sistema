@extends('layouts.plantilla')

@section('titulo','Administrador De Usuarios')



@section('subTitulo', 'USUARIOS')

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
                title: "No se pudo Agregar el Equipo",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
    <div class="tablas"> 
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>N° Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Rol</th>
                        <th>Perfil</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Fecha Ingreso</th>
                        <th>Sueldo</th>
                        <th>Estado de Cuenta</th>
                        <th colspan="3" > 
                            <a href="/registroForm" class="btn-add"  >
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)

                    <tr>
                        <td> {{ $usuario->id }} </td>
                        <td> {{ $usuario->name }} </td>
                        <td> {{ $usuario->apellido }} </td>
                        <td> {{ $usuario->rol }}</td>
                        <td> {{ $usuario->tipo }}</td>
                        <td> {{ $usuario->usuario }}</td>
                        <td> {{ $usuario->email }}</td>
                        <td> {{ $usuario->fecha }}</td>
                        <td> {{ $usuario->sueldo }}</td>
                        <td> {{ $usuario->estadoCuenta }}</td>
                        
                        <td>
                            <a href="/formModificarUsuario/{{ $usuario->id}}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a> 
                        </td>
                        <td>
                            <a href="/formPasswordUsuario/{{ $usuario->id}}" class="btn-update">
                                <i class="fas fa-key"></i>
                            </a> 
                        </td>
                        <td>
                            <form action="/eliminarUsuario/{{ $usuario->id}}" method="POST" class="formulario-eliminar">
                                @csrf
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
    </div> 
    
    
    </div>    
    <div class="paginacion">
        {{$usuarios->links()}}
    </div>

<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection