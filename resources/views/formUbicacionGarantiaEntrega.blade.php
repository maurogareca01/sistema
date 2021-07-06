@extends('layouts.plantilla')

@section('titulo','Ubicaion del Dinero')



@section('subTitulo', 'ALQUILERES - CUENTA DE DINERO / LOGISTICA ENTREGA')

@section('contenido')
 
<div class="content-formulario content-alta" >
    <div class="contact-wrapper">
        <div class="modifica-form alta">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/formCambiosFinales/{{ $pedido->idPedido }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}">
                <input type="hidden" name="usuario" id="usuario" value="{{$pedido->usuario }}">
                <input type="hidden" name="estadoPedido" id="estadoPedido"  value="{{$pedido->estadoPedido }}">
                <input type="hidden" name="nombreServ" id="nombreServ"  value="{{ $pedido->nombreServ }}" > 
                
                <p id="descripcion">
                    <label for="descripcion">Descripcion</label>
                    <input readonly type="text" name="descripcion" id="descripcion" autocomplete="off" value="{{ $pedido->descripcion }}" placeholder="{{ $pedido->descripcion }}">
                </p>
                <p id="costoServ">
                    <label for="costoServ">Costo de Servicio</label>
                    <input readonly type="number" name="costoServ" id="costoServ" autocomplete="off" value="{{ $pedido->costoServ }}" placeholder="{{ $pedido->costoServ }}">
                </p>
                <p id="garantia">
                    <label for="garantia">Garantia</label>
                    <input  readonly type="number"  name="garantia" id="garantia" autocomplete="off" value="{{ $pedido->garantia }}" placeholder="{{ $pedido->garantia }}">
                </p>
                <p>
                    <label for="costoEnvio" id="medioPagoLabel">Costo de Envio</label>
                    <input type="number" name="costoEnvio" id="medioPago" autocomplete="off" value="{{ $pedido->costoEnvio }}" placeholder="{{ $pedido->costoEnvio }}">
                    <select  name="medioPagoEnvio" id="medioPago" >
                        <optgroup label="Envio">
                        <option value="" >{{ $pedido->medioPagoEnvio }} - ACTUAL</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                        <option value="Uala" >Uala</option>
                        <option value="No Se Cobra" >No Se Cobra</option>
                    </select> 
                    @error('costoEnvio')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                    @error('medioPagoEnvio')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>

                @if ($pedido->medioPagoAlquiler=='A Confirmar')
                    <p>
                        <label for="medioPagoAlquiler">Medio de Pago de Alquiler</label>
                        <select  name="medioPagoAlquiler" >
                            <optgroup label="Alquiler">
                            <option value="" >Seleccione Medio De Pago</option>
                            <option value="Efectivo" >Efectivo</option>
                            <option value="Bank" >Bank</option>
                            <option value="Mercado Pago" >Mercado Pago</option>
                            <option value="Uala" >Uala</option> 
                        </select> 
                        @error('medioPagoAlquiler')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>    
                @else   
                    <p>
                        <label for="medioPagoAlquiler">Medio de Pago de Alquiler</label>
                        <input readonly type="text" name="medioPagoAlquiler"  value="{{ $pedido->medioPagoAlquiler}}" >
                    </p>
                @endif
                @if ($pedido->medioPagoGarantia=='A Confirmar')
                    <p>
                        <label for="medioPagoGarantia">Medio de Pago de Garantia</label>
                        <select  name="medioPagoGarantia" id="medioPagoGarantia" >
                            <optgroup label="Alquiler">
                            <option value="" >Seleccione Medio De Pago</option>
                            <option value="Efectivo" >Efectivo</option>
                            <option value="Bank" >Bank</option>
                            <option value="Mercado Pago" >Mercado Pago</option>
                            <option value="Uala" >Uala</option> 
                        </select> 
                        @error('medioPagoGarantia')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>    
                @else   
                    <p>
                        <label for="medioPagoGarantia">Medio de Pago de Garantia</label>
                        <input readonly type="text" name="medioPagoGarantia" id="medioPagoGarantia" value="{{ $pedido->medioPagoGarantia}}" >
                    </p>
                @endif
                
                @if($garantia)

                    <input type="hidden" name="idUsuarioG" id="idUsuarioG"  value="{{$garantia->idUsuario}}">
                    <input type="hidden" name="estaEncajaG" id="estaEnCajaG"  value="{{ $garantia->estaEnCaja }}">
                    
                    <p>
                        <label for="idUsuario">Cobro de Garantia</label> 
                        <select name="idUsuario" id="idUsuario">
                            <option value="{{$garantia->idUsuario}}">{{$garantia->estaEnCaja}}</option>  
                        </select>
                    </p>
                @endif
                <p>
                    <label for="idUsuarioAlquiler">Cobro de Alquiler</label>
                    <select   name="idUsuarioAlquiler" id="idUsuarioAlquiler">
                        <option value="{{$pedido->idCobro}}">{{$pedido->cuentaCobro}}</option>   
                    </select>
                    @error('idUsuarioAlquiler')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 

                <p>
                    <label for="logisticaE">Logistica Entrega</label>
                    <select name="logisticaE" id="logisticaE">
                        <option value="{{ $pedido->idLogisticaE}}" >{{ $pedido->logisticaE  }} - ACTUAL</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}} - {{$user->rol}}</option>
                        @endforeach
                    </select>
                    @error('logisticaE')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 


                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminPedidos'" type="button">Volver</button>
                </p>  
                <p>
                    <button class="btn-verModificar" type="sumbit">Cargar Alquiler</button>
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
