@extends('layouts.plantilla')

@section('titulo','Fecha de Retiro de Alquiler')



@section('subTitulo', 'ELEGIR FECHA DEL RETIRO - ALQUILER')

@section('contenido')
 

<div class="content-formulario " >
    <div class="contact-wrapper">
        <div class="modifica-form ">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/modificarPedidoPFecha/{$Pedido->idPedido}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}"> 
                <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                @php
                    $originalDate = $pedido->fechaRetiro;
                    $fechaRetiroF = date("Y-m-d", strtotime($originalDate));   
                    $fechaRetiroH = date("H:i", strtotime($originalDate));   
                    $HoyR=date("Y-m-d");  
                @endphp
                <p>
                    <label for="fechaRetiro">Fecha de Retiro</label>
                    <input type="datetime-local" name="fechaRetiro"  id="fechaRetiro"  value="{{ $fechaRetiroF.'T'.$fechaRetiroH }}">
                    
                    @error('fechaRetiro')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p> 
                <p>
                    <label for="logisticaR">Logistica Retiro</label>
                    <select name="logisticaR" id="logisticaR">
                        <option value="">Personal de Logistica</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}} - {{$user->rol}}</option>
                        @endforeach
                    </select>
                    @error('logisticaR')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminPedidos'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Elegir Fecha De Retiro</button>
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