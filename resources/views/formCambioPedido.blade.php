@extends('layouts.plantilla')

@section('titulo','Cambio de Alquiler')



@section('subTitulo', 'CAMBIO  - CAMBIO DE ALQUILER')

@section('contenido')
 

<div class="content-formulario content-alta" >
    <div class="contact-wrapper">
        <div class="modifica-form  ">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/modificarCambioPedido/{$Pedido->idPedido}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}">
                
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
                            <option value="">
                                @if ($pedido->dispoER<>0)
                                    R {{ $pedido->dispoER }} - Actual
                                @elseif ($pedido->dispoEA<>0)
                                    A {{ $pedido->dispoEA }} - Actual
                                @else
                                    Y {{ $pedido->dispoEY }} - Actual
                                @endif
                            </option>
                            <option value="0">No Cambiar</option>               
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
                        <textarea   placeholder="Sin Fallos" maxlength="252" name="comenC" id="comenC" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoC" value="0">
                @endif


                @if ($pedido->dispoT1<>0)
                    <p> 
                        <label for="dispoT1">Tubo de 680 Litros</label>
                        <select  name="dispoT1" id="dispoT1" >
                            <option value="">T{{ $pedido->dispoT1 }} - Actual</option>
                            <option value="0">No Cambiar</option>               
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
                        <textarea   placeholder="Sin Fallos" maxlength="252" name="comenT1" id="comenT1" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoT1" value="0">
                @endif

                @if ($pedido->dispoT415<>0)
                    <p> 
                        <label for="dispoT415">Tubo de 415 Litros</label>
                        <select  name="dispoT415" id="dispoT415" >
                            <option value="">T{{ $pedido->dispoT415 }} - Actual</option>
                            <option value="0">No Cambiar</option>               
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
                        <textarea   placeholder="Sin Fallos" maxlength="252" name="comenT415" id="comenT415" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoT415" value="0">
                @endif

                @if ($pedido->dispoO<>0)
                    <p> 
                        <label for="dispoO">Oximetro</label>
                        <select  name="dispoO" id="dispoO" >
                            <option value="">X{{ $pedido->dispoO }} - Actual</option>
                            <option value="0">No Cambiar</option>               
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
                        <textarea   placeholder="Sin Fallos" maxlength="252" name="comenO" id="comenO" cols="30" rows="10"></textarea>
                    </p>
                @else
                    <input type="hidden" name="dispoO" value="0">
                @endif

                @php
                    $HoyF=date("Y-m-d"); 
                    $HoyH=date("H:i"); 
                @endphp
                <p>
                    <label for="fechaInicio">Fecha Entrega/Cambio</label>
                    <input  type="datetime-local" name="fechaInicio" id="fechaInicio" autocomplete="off" min="{{$HoyF.'T'.$HoyH}}" >
                    @error('fechaInicio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="logistica">Logistica de Entrega y Retiro</label>
                    <select name="logistica" id="logistica">
                        <option value="">Personal de Logistica</option>
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
                    <textarea maxlength="252" rows="3" cols="50" type="text" name="comentarios" id="comentarios">{{  $pedido->comentarios }}</textarea>
                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminCambios'" type="button">Volver</button>
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