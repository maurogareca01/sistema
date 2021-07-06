@extends('layouts.app')

@section('titulo','Registro de Usuario')


 
@section('contenido')
<div class="login">  
    <div class="login-box large ">
        <div class="scroll-register">
            <h1>Registro De Usuario</h1> 
            <form method="POST" action="/registro" >

                    @csrf 
                    <div>
                        <label for="name">{{ __('Nombre') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder=""  autocomplete="off" autofocus>
                        @error('name')
                            <span class="error">{{ $message }}</span> 
                        @enderror
                    </div>    
                    <div>
                        <label for="apellido">{{ __('Apellido') }}</label>
                        <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}"  autocomplete="off" autofocus>
                        @error('apellido')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div>
                        <label for="email">{{ __('E-Mail') }}</label>
                        <input id="email" type="email"  name="email" value="{{ old('email') }}"  autocomplete="off">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </div>  
                    <div>
                        <label for="sueldo" >{{ __('Sueldo') }}</label>
                        <input id="sueldo" type="number" min="0" name="sueldo" value="{{ old('sueldo') }}"  autocomplete="off" autofocus>
                        @error('sueldo')
                            <span class="error">{{ $message }}</span>

                        @enderror  
                    </div>  
                    <div> 
                        <label for="rol">Rol</label> 
                        <select  name="rol" id="rol" >
                            <option value="">Seleccione un Rol</option>
                            <option value="admin" >Admin</option>
                            <option value="administrador">Administrador</option>
                            <option value="logistica">Logistica</option>
                        </select>
                        @error('rol')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </div>   
                    <div id="tipoUser">
                        <label for="tipo" >{{ __('Perfil Financiero') }}</label>
                        <select disabled name="tipo" id="tipo" >  
                            <option  value="">Seleccione Rol</option>
                        </select>
                        @error('tipo')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </div>  
                    <div>
                        <label for="usuario">{{ __('Usuario') }}</label>
                        <input id="usuario" type="text" name="usuario" value="{{ old('usuario') }}"  autocomplete="off" autofocus>
                        @error('usuario')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" name="password"  autocomplete="new-password">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </div>    
                    
                    <div>
                        <label for="password-confirm" >{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password"  name="password_confirmation"  autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </div>     
                    <div>  
                        <button type="submit" id="btn-register-agregar">
                                {{ __('Registrar') }}
                        </button> 
                    </div>
                    <div>
                        <button onclick="location.href='/adminUsuarios'" type="button" class="volver-register">
                                {{ __('Volver') }}
                        </button>
                    </div>
                    
                
            </form>
        </div>
    </div> 
</div> 
<script>
    $("#btn-register-agregar").on("click", function(e) {
    $(this).attr("disabled", true);
    $(this).closest("form").submit()
    })

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
</script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
 
@endsection
 