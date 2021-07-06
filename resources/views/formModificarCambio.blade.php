@extends('layouts.plantilla')

@section('titulo','Modificacion de Cambio de Alquiler')



@section('subTitulo', 'MODIFICAR CAMBIO DE ALQUILER')

@section('contenido')
 

<div class="content-formulario content-alta" >
    <div class="contact-wrapper">
        <div class="modifica-form  ">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/modificarCambio/{{ $pedido->idPedido }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}">
                <input type="hidden" name="idCalendario" id="idCalendario"  value="{{$calendario->idCalendario }}">
                
                <p>
                    <label for="idServicio">Servicio</label>
                    <input readonly type="text" name="idServicio" id="idServicio" autocomplete="off" value="S-{{ $pedido->idServicio }}@php if($pedido->dispoER<>0)
                    {echo '-R';
                    }if($pedido->dispoEA<>0){echo '-A';}if($pedido->dispoEY<>0){echo '-Y';}
                    @endphp " >
                </p>

                                            
                <p >
                    <label for="descripcion">Descripcion</label>
                    <input readonly type="text" name="descripcion" id="descripcion" autocomplete="off" value="{{ $pedido->descripcion }}" placeholder="{{ $pedido->descripcion }}">
                </p>
                <p >
                    <label for="costoServ">Costo de Servicio</label>
                    <input readonly type="number" min="0" name="costoServ" id="costoServ" autocomplete="off" value="{{ $pedido->costoServ }}" placeholder="{{ $pedido->costoServ }}">
                </p>
                <p>
                    <label for="garantia">Garantia</label>
                    <input readonly type="number" min="0" name="garantia" id="garantia" autocomplete="off" value="{{ $pedido->garantia }}" placeholder="{{ $pedido->garantia }}">
                </p>
                 
                @if ($pedido->dispoER<>0 || $pedido->dispoEA<>0 || $pedido->dispoEY<>0)
                    <p> 
                        <label for="dispoC">Concentrador</label>
                        <select name="dispoC" id="dispoC" >
                            @if ($pedido->dispoERCambio != 0)
                                <option value="{{$pedido->dispoERCambio}}">
                                    R {{ $pedido->dispoERCambio }} - Seleccionado Para Cambiar
                                </option>
                            @elseif ($pedido->dispoEACambio != 0)
                                <option value="{{$pedido->dispoEACambio}}">
                                    A {{ $pedido->dispoEACambio }} - Seleccionado Para Cambiar
                                </option>
                            @elseif ($pedido->dispoEYCambio != 0)
                                <option value="{{$pedido->dispoEYCambio}}">
                                    Y {{ $pedido->dispoEYCambio }} - Seleccionado Para Cambiar
                                </option> 
                            @endif
                            @if ($pedido->dispoER != 0)
                                <option value="">R{{ $pedido->dispoER }} - Actual Usando</option>
                            @elseif ($pedido->dispoEA != 0)
                                <option value="">A{{ $pedido->dispoEA }} - Actual Usando</option>
                            @elseif ($pedido->dispoEY != 0)
                                <option value="">Y{{ $pedido->dispoEY }} - Actual Usando</option>
                            @endif
  
                            @foreach($equipos as $equipo)
                                <option  value="{{ $equipo->idEquipo}}">
                                @if ($equipo->nombre=='Respironics')
                                    R
                                @elseif ($equipo->nombre=='Airsep' )
                                    A
                                @else
                                    Y
                                @endif
                                {{$equipo->idEquipo}} -  Disponible</option>
                            @endforeach
                        </select>
                        @error('dispoC')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>
                    <p>
                        <label for="comenC">
                            Fallos Del Concentrador
                            @if ($pedido->dispoER<>0)
                                R {{ $pedido->dispoER }} - Actual
                            @elseif ($pedido->dispoEA<>0)
                                A {{ $pedido->dispoEA }} - Actual
                            @else
                                Y {{ $pedido->dispoEY }} - Actual
                            @endif
                        </label>
                        <textarea   placeholder="{{ $calendario->cambio }}" maxlength="252" name="comenC" id="comenC" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoC" value="0">
                @endif


                @if ($pedido->dispoT1<>0)
                    <p> 
                        <label for="dispoT1">Tubo de 680 Litros</label>
                        <select  name="dispoT1" id="dispoT1" >
                            @if ($pedido->dispoT1Cambio !=0)
                                <option value="{{ $pedido->dispoT1Cambio }}">T{{ $pedido->dispoT1Cambio }} - Actual</option>
                            @endif 
                            <option value="">T{{ $pedido->dispoT1 }} - Actual Usando</option>
                            @foreach($tubos1M as $tubo1M)
                            <option value="{{ $tubo1M->idTubo  }}" >T{{ $tubo1M->idTubo  }} -  Disponible</option>
                                
                            @endforeach
                        </select>
                        @error('dispoT1')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>
                    <p>
                        <label for="comenT1">Fallos Del Tubo      T{{ $pedido->dispoT1 }}</label>
                        <textarea   placeholder="{{ $calendario->cambio }}" maxlength="252" name="comenT1" id="comenT1" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoT1" value="0">
                @endif

                @if ($pedido->dispoT415<>0)
                    <p> 
                        <label for="dispoT415">Tubo de 415 Litros</label>
                        <select  name="dispoT415" id="dispoT415" >
                            @if ($pedido->dispoT415Cambio !=0)
                                <option value="{{ $pedido->dispoT415Cambio }}">T{{ $pedido->dispoT415Cambio }} - Actual</option>
                            @endif 
                            <option value="">T{{ $pedido->dispoT415 }} - Actual Usando</option>
                            @foreach($tubos415M as $tubo415M)
                                <option value="{{ $tubo415M->idTubo  }}" >T{{ $tubo415M->idTubo  }} -  Disponible</option>
                                
                            @endforeach
                        </select>
                        @error('dispoT415')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>
                    <p>
                        <label for="comenT415">Fallos Del Tubo      T{{ $pedido->dispoT415 }}</label>
                        <textarea   placeholder="{{ $calendario->cambio }}" maxlength="252" name="comenT415" id="comenT415" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoT415" value="0">
                @endif

                @if ($pedido->dispoO<>0)
                    <p> 
                        <label for="dispoO">Oximetro</label>
                        <select  name="dispoO" id="dispoO" >
                            @if ($pedido->dispoOCambio !=0)
                                <option value="{{ $pedido->dispoOCambio }}">X{{ $pedido->dispoOCambio }} - Seleccionado Para Cambiar</option>
                            @endif
                            <option value="">X{{ $pedido->dispoO }} - Actual Usando</option>
                            @foreach($oximetros as $oximetro)
                            <option value="{{ $oximetro->idOximetro  }}" >X{{ $oximetro->idOximetro }}  -  Disponible</option>
                                
                            @endforeach
                        </select>
                        @error('dispoO')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>
                    <p>
                        <label for="comenO">Fallos Del Oximetro      X{{ $pedido->dispoO }}</label>
                        <textarea   placeholder="{{ $calendario->cambio }}" maxlength="252" name="comenO" id="comenO" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoO" value="0">
                @endif

                @php
                    $HoyF=date("Y-m-d"); 
                    $HoyH=date("H:i"); 
                    $fechaAño = date("Y-m-d", strtotime($calendario->start)); 
                    $fechaHora = date("H:i", strtotime($calendario->start)); 

                @endphp
                <p>
                    <label for="fechaInicio">Fecha Entrega/Cambio</label>
                    <input required type="datetime-local" name="fechaInicio" id="fechaInicio" autocomplete="off"  value="{{$fechaAño.'T'.$fechaHora}}" >
                    @error('fechaInicio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="logistica">Logistica de Entrega y Retiro</label>
                    <select name="logistica" id="logistica">
                        <option value="{{$calendario->idUsuario}}">{{$calendario->logisticaE}} - ACTUAL</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}} - {{$user->rol}}</option>
                        @endforeach
                    </select>
                    @error('logistica')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p> 
                    <label for="comentarios">Comentarios</label>
                    <textarea maxlength="252" rows="3" cols="50" type="text" name="comentarios" id="comentarios">{{$pedido->comentarios}}</textarea>
                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminCambiosH'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Hacer Cambio</button>
                </p>   
                                           
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
<script src="{{ asset('js/formu-ajax.js') }}"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
 
@endsection