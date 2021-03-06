 
<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Iniciar Sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu Contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@extends('layouts.app')

@section('titulo','HHOxigeno-Sistema')

 

@section('contenido')
<div class="login"> 
    <div class="login-box">
        <div class="scroll-login">
            <div class="avatar">
                <img src="img/hh_oxigeno_b.png"  alt="">
            </div>
            <h1>Acceder</h1> 

            <form method="POST" action="{{ route('login') }}">
               @csrf
            
                <label for="usuario" class="">{{ __('Usuario') }}</label> 
                <input id="email" type="text" class="" name="usuario" value="{{ old('email') }}" required autofocus  autocomplete="off">
                @error('usuario')
                    <span class="error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
 
                <label for="password" class="">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="" name="password" required>
                @error('password')
                    <span class="error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror   
                    
                <button type="submit" class="">
                    {{ __('Iniciar Sesión') }}
                </button> 
            </form> 
        </div>
    </div>
</div>
@endsection
 