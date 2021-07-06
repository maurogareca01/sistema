@extends('layouts.plantilla')

@section('titulo','Renovación de Alquiler')



@section('subTitulo', 'ALQUILER  - RENOVACION DE ALQUILER VENCIDO')

@section('contenido')
 

<div class="content-formulario content-alta" >
    <div class="contact-wrapper">
        <div class="modifica-form alta">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/modificarPedidoVencidoP" method="POST" enctype="multipart/form-data">
            @csrf 
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}">
                <input type="hidden" name="usuario" id="usuario" value="{{$pedido->usuario }}">
                <input type="hidden" name="diasVencido" id="diasVencido" value="{{ $pedido->dias }}">
                <input type="hidden" name="nombreServ" id="nombreServ" autocomplete="off" value="{{ $pedido->nombreServ }}" >

                <p>
                    @php
                        if($pedido->dispoER<>0){
                            $idServicio=$pedido->idServicio.'R';
                        }else{
                            $idServicio=$pedido->idServicio;
                        }
                        if($pedido->dispoEA<>0){
                            $idServicio=$pedido->idServicio.'A';
                        }else{
                            $idServicio=$pedido->idServicio;
                        }
                    @endphp
                    <label for="idServicio">Servicio</label>
                    <input readonly type="text" name="idServicio" id="idServicio" autocomplete="off" value="S-{{$idServicio}}">
                </p>
                <p id="descripcion">
                    <label for="descripcion">Descripcion</label>
                    <input readonly type="text" name="descripcion" id="descripcion" autocomplete="off" value="{{ $pedido->descripcion }}" placeholder="{{ $pedido->descripcion }}">
                </p>
                <p id="costoServ">
                    <label for="costoServ">Costo de Servicio</label>
                    <input type="number" min="0" name="costoServ" id="costoServ" autocomplete="off" value="{{ $pedido->costoServ }}" placeholder="{{ $pedido->costoServ }}">
                </p>
                <p id="garantia">
                    <label for="garantia">Garantia</label>
                    <input readonly type="number" min="0" name="garantia" id="garantia" autocomplete="off" value="{{ $pedido->garantia }}" placeholder="{{ $pedido->garantia }}">
                </p>
                <p>
                    <label for="costoEnvio">Costo de Envio</label>
                    <input type="number" name="costoEnvio" id="costoEnvio" autocomplete="off" value="{{ $pedido->costoEnvio }}" placeholder="{{ $pedido->costoEnvio }}">
                </p>
                <p>
                    <label for="medioPago" id="medioPagoLabel">Medio de Pago</label>
                    <select name="medioPagoAlquiler">
                        <optgroup label="Alquiler">
                        <option value="" >Seleccione Medio De Pago</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                        <option value="Uala" >Uala</option>
                        <option value="A Confirmar" >A Confirmar</option>
                    </select> 
                    @error('medioPagoAlquiler')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="nombreCliente">Nombre del Cliente</label>
                    <input readonly required type="text" name="nombreCliente" id="nombreCliente" autocomplete="off" value="{{ $pedido->nombreCliente }}" placeholder="{{ $pedido->nombreCliente }}">
                </p>
                
                <p>
                    <label for="dni">Dni</label>
                    <input  readonly required type="number" name="dni" id="dni" autocomplete="off" value="{{ $pedido->dni }}" placeholder="{{ $pedido->dni }}" >
                </p>

                <p>
                    <label for="direccion">Direccion</label>
                    <input readonly required type="text" name="direccion" id="direccion" autocomplete="off" value="{{ $pedido->direccion }}" placeholder="{{ $pedido->direccion }}" >
                </p>
                <p>
                    <label for="localidad">Localidad</label>
                    <input  readonly required  type="text" name="localidad" id="localidad" autocomplete="off" value="{{ $pedido->localidad }}" placeholder="{{ $pedido->localidad }}" >
                </p>
                <p>
                    <label for="telefono">Telefono</label>
                    <input readonly type="number" name="telefono" id="telefono" autocomplete="off" value="{{ $pedido->telefono }}" placeholder="{{ $pedido->telefono }}">
                    @error('telefono')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" value="{{ $pedido->email }}" placeholder="{{ $pedido->email }}">
                 </p>
                <p>
                    <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                    @php
                        $originalDate = $pedido->fechaFin;
                        $fechaFin = date("Y-m-d", strtotime($originalDate));  
                        $fechaHoy = date("Y-m-d");  
                    @endphp

                    <label for="fechaInicio">Fecha De Renovación</label>
                    <input required type="date" name="fechaInicio"  id="fechaInicio" autocomplete="off" value="{{$fechaFin}}">
                    
                    @error('fechaInicio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="dias">Mes/Meses</label>
                    <select name="dias" id="dias" >
                        <option value="">La cantidad de Meses</option>
                        <option value="15" >15 Dias</option>
                        <option value="1" >1 Mes</option>
                        <option value="2" >2 Meses</option>
                        <option value="3" >3 Meses</option>
                        <option value="4" >4 Meses</option>
                        <option value="5" >5 Meses</option>
                        <option value="6" >6 Meses</option>
                        <option value="7" >7 Meses</option>
                        <option value="8" >8 Meses</option>
                        <option value="9" >9 Meses</option>
                        <option value="10" >10 Meses</option>
                        <option value="11" >11 Meses</option>
                        <option value="12" >12 Meses</option>
                    </select>
                    @error('dias')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p id="fechaFin"> 
                    <label for="fechaFin">Fecha Finalizacion</label>
                    <input readonly type="date" name="fechaFin" id="fechaFin" autocomplete="off" value="{{ $pedido->fechaFin }}" placeholder="{{ $pedido->fechaFin }}" >
                </p>
                <p>
                    <label for="idUsuario">Cuenta De Cobro:</label> 
                    <select name="idUsuario" id="idUsuario">
                        <option value="">Seleccione Una Cuenta</option>
                        @foreach($usuario as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}}</option>  
                        @endforeach
                    </select>
                    @error('idUsuario')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminPedidos'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Renovar Alquiler</button>
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