@extends('layouts.app')

@section('titulo','Registro de Usuario')


 
@section('contenido')
<div class="login"> 
    <div class="login-box large ">
        <div class="scroll-register">
            <h1>Cambio de Contraseña</h1> 
            <form method="POST" action="/modificarPassword" >

                @csrf  
                <input name="id" type="hidden"  value="{{$usuario->id}}"> 
                <div>
                    <label for="usuario">{{ __('Usuario') }}</label>
                    <input readonly id="usuario" type="text"  value="{{$usuario->usuario}}"> 
                </div>
                <div>
                    <label for="mypassword">{{ __('Introduce La Actual Contraseña') }}</label>
                    <input id="mypassword" type="password" name="mypassword" >

                    @error('mypassword')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </div> 
                <div>
                    <label for="password">{{ __('Nueva Contraseña') }}</label>
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
                    <button onclick="location.href='/adminUsuarios'" type="button" class="volver-register">
                            {{ __('Volver') }}
                    </button>
                </div>
                <div>  
                    <button type="submit" id="btn-register-agregar">
                            {{ __('Cambiar') }}
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
 