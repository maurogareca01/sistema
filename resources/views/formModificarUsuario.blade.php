@extends('layouts.plantilla')

@section('titulo','Modificacion de Usuario')



@section('subTitulo', 'USUARIOS  - MODIFICACION DE USUARIOS')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Usuario  {{$usuario->name}} {{$usuario->apellido}}</h3>
            <form action="/modificarUsuario/{$usuario->id}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$usuario->id }}">
                       
                <p> 
                    <label for="name">Nombre</label>
                    <input type="text" name="name" value="" autocomplete="off" placeholder="{{$usuario->name}}"> 
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p> 
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" value="" autocomplete="off" placeholder="{{$usuario->apellido}}"> 
                    @error('apellido')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p> 
                    <label for="email">Email</label>
                    <input type="email" name="email" value=" " autocomplete="off" placeholder="{{$usuario->email}}"> 
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p> 
                <p>
                    <label for="sueldo" >{{ __('Sueldo') }}</label>
                    <input id="sueldo" type="number" name="sueldo" value="{{$usuario->sueldo}}"  autocomplete="off" autofocus placeholder="">
                    @error('sueldo')
                        <span class="error">{{ $message }}</span>
                    @enderror  
                </p> 
                
                <p> 
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol" >
                        <option value="">Seleccione un Rol</option>
                        <option  value="admin" >Admin</option>
                        <option value="administrador">Administrador</option>
                        <option value="logistica">Logistica</option>
                    </select>
                    @error('rol')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>     

                <p id="tipoUser">
                    <label for="tipo" >{{ __('Perfil Financiero') }}</label>
                    <input readonly type="text" id="tipo" name="tipo" value="{{ $usuario->tipo}}"  > 
                </p>   

                
                <p>
                    <label for="usuario" >{{ __('Usuario') }}</label>
                    <input id="usuario" type="text" name="usuario" value=""  autocomplete="off" autofocus placeholder="{{ $usuario->usuario }}">
                    @error('usuario')
                        <span class="error">{{ $message }}</span>
                    @enderror  
                </p>  
                <p>
                    <label for="estadoCuenta">Estado Cuenta</label>
                    <select name="estadoCuenta" id="estadoCuenta" >
                        <option value="">Seleccione un Estado</option> 
                        <option value="Activada">Activar</option>
                        <option value="Desactivada">Desactivar</option>
                    </select>
                    @error('estadoCuenta')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>  
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminUsuarios'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        /////////FORM DE REGISTER DE USUARIO
        $('#rol').on('change', function() {
            var rol = $(this).val();
 
            if(rol=='admin'){
                $('#tipoUser').empty();
                $('#tipoUser').append(
                    "<label for='tipo' >{{ __('Perfil Financiero') }}</label>"+ 
                    "<select name='tipo' id='tipo' >"+
                        "<option value='' >Seleccione Perfil Financiero</option>"+
                        "<option value='Control de Efectivo' >Control de Efectivo</option>"+
                        "<option value='Control Digital'>Control Digital</option>"+ 
                    "</select>"+
                    "@error('tipo')"+
                        "<span class='error'>{{ $message }}</span>"+
                    "@enderror"
                );
            }else{
                $('#tipoUser').empty();
                $('#tipoUser').append(
                    "<label for='tipo' >{{ __('Perfil Financiero') }}</label>"+
                    "<select name='tipo' id='tipo' >"+ 
                        "<option value='Usuario Operacional'>Usuario Operacional</option>"+ 
                    "</select>"+
                    "@error('tipo')"+
                        "<span class='error'>{{ $message }}</span>"+
                    "@enderror"
                );
            }
        });

    })

</script>   
 

@endsection