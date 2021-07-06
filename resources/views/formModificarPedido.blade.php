@extends('layouts.plantilla')

@section('titulo','Modificacion de Alquiler')



@section('subTitulo', 'ALQUILERES  - MODIFICACION DE ALQUILER')

@section('contenido')
 

<div class="content-formulario content-alta4" >
    <div class="contact-wrapper">
        <div class="modifica-form alta4">
            <h3>Alquiler N° {{$pedido->idPedido}}</h3>
            <form action="/modificarPedido/{$Pedido->idPedido}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idPedido" id="idPedido"  value="{{$pedido->idPedido }}">
                <input type="hidden" name="usuario" id="usuario" value="{{$pedido->usuario }}">
                <input type="hidden" name="estadoPedido" id="estadoPedido"  value="{{$pedido->estadoPedido }}">
                <input type="hidden" name="nombreServ" id="nombreServ"  value="{{ $pedido->nombreServ }}" >
                <input type="hidden" name="imgServ" id="imgServ" value="{{ $pedido->imgServ }}">

                <input type="hidden" name="" id="PedidoDispoER"  value="{{$pedido->dispoER }}">
                <input type="hidden" name="" id="PedidoDispoEA"  value="{{$pedido->dispoEA }}">
                <input type="hidden" name="" id="PedidoDispoEY"  value="{{$pedido->dispoEY }}">
                <input type="hidden" name="" id="PedidoDispoT1"  value="{{$pedido->dispoT1 }}">
                <input type="hidden" name="" id="PedidoDispoT415"  value="{{$pedido->dispoT415 }}">
                <input type="hidden" name="" id="PedidoDispoO"  value="{{$pedido->dispoO }}">
                
                <p class="secc-a">
                    <label for="idServicio">Servicio</label>
                    <select name="idServicio" id="idServicio" class="completo">
                        <option value="{{ $pedido->idServicio }}">
                            S-{{$pedido->idServicio}} 
                            - {{ $pedido->nombreServ }} - ACTUAL
                        </option>
                        @foreach($servicios as $servicio)
                        <option value="{{ $servicio->idServicio }}" >
                            S-{{$servicio->idServicio}} 
                            - {{ $servicio->nombreServ }}
                        </option> 
                        @endforeach 
                    </select>
                    @error('idServicio')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p class="span-Dispo secc-b" > 
                    <span class="span-barra ">RES</span>
                    <span class="span-barra">ARS</span>
                    <span class="span-barra">YUW</span>
                    <span class="span-barra">T/680L</span>
                    <span class="span-barra">T/415L</span>
                    <span >OXI</span>
                    <span class="span-barra" id="con-res" >   
                        @if ($pedido->dispoER != 0)
                            <select class="completo" name="NumeroDispoER" id='NumeroDispoER'>
                                <option value="0" class="option-NoUsa">No Usa</option>
                                <option selected value="{{$pedido->dispoER}}">R{{$pedido->dispoER}} /  - ACTUAL</option>
                                @foreach($elegirER as $eleER)
                                    @if ($pedido->dispoER != $eleER->idEquipo)
                                        @if ($eleER->estado=='Reservado' || $eleER->estado=='Revisar' || $eleER->estado=='Reparacion' || $eleER->estado=='Por Entregar' || $eleER->estado=='Por Retirar')
                                            <option disabled="" class="option-Reservado" value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                        @else
                                            @if ($eleER->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @else
                            @if ($serviPedido->dispoER==0)
                                -
                            @else     
                                <select class="completo" name="NumeroDispoER" id='NumeroDispoER'>  
                                    <option value="0" class="option-NoUsa">No Usa</option>
                                    @foreach($elegirER as $eleER)
                                        @if ($eleER->estado=='Reservado' || $eleER->estado=='Revisar' || $eleER->estado=='Reparacion' || $eleER->estado=='Por Entregar' || $eleER->estado=='Por Retirar')
                                            <option disabled="" class="option-Reservado" value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                        @else
                                            @if ($eleER->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleER->idEquipo }}">R{{ $eleER->idEquipo }} / {{ $eleER->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endforeach 
                                </select>
                            @endif     
                        @endif
                    </span>
                    <span class="span-barra" id="con-ars" > 
                        @if ($pedido->dispoEA != 0)
                            <select class="completo" name="NumeroDispoEA" id='NumeroDispoEA'>
                                <option value="0" class="option-NoUsa">No Usa</option>
                                <option selected value="{{$pedido->dispoEA}}">A{{$pedido->dispoEA}} /  - ACTUAL</option>
                                @foreach($elegirEA as $eleEA)
                                    @if ($pedido->dispoEA != $eleEA->idEquipo)
                                        @if ($eleEA->estado=='Reservado' || $eleEA->estado=='Revisar' || $eleEA->estado=='Reparacion')
                                            <option disabled="" class="option-Reservado" value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                        @else
                                            @if ($eleEA->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @else
                            @if ($serviPedido->dispoEA==0)
                                -
                            @else  
                                <select class="completo" name="NumeroDispoEA" id='NumeroDispoEA'>  
                                    <option value="0" class="option-NoUsa">No Usa</option>
                                    @foreach($elegirEA as $eleEA)
                                        @if ($eleEA->estado=='Reservado' || $eleEA->estado=='Revisar' || $eleEA->estado=='Reparacion' || $eleEA->estado=='Por Entregar' || $eleEA->estado=='Por Retirar')
                                            <option disabled="" class="option-Reservado" value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                        @else
                                            @if ($eleEA->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleEA->idEquipo }}">A{{ $eleEA->idEquipo }} / {{ $eleEA->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endforeach 
                                </select>
                            @endif
                        @endif
                    </span>
                    <span class="span-barra" id="con-yuw" > 
                        @if ($pedido->dispoEY != 0)
                            <select class="completo" name="NumeroDispoEY" id='NumeroDispoEY'>
                                <option value="0" class="option-NoUsa">No Usa</option>
                                <option selected value="{{$pedido->dispoEY}}">Y{{$pedido->dispoEY}} /  - ACTUAL</option>
                                @foreach($elegirEY as $eleEY)
                                    @if ($pedido->dispoEY != $eleEY->idEquipo)
                                        @if ($eleEY->estado=='Reservado' || $eleEY->estado=='Revisar' || $eleEY->estado=='Reparacion')
                                            <option disabled="" class="option-Reservado" value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                        @else
                                            @if ($eleEY->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @else
                            @if ($serviPedido->dispoEY==0)
                                -
                            @else 
                                <select class="completo" name="NumeroDispoEY" id='NumeroDispoEY'>  
                                    <option value="0" class="option-NoUsa">No Usa</option>
                                    @foreach($elegirEY as $eleEY)
                                        @if ($eleEY->estado=='Reservado' || $eleEY->estado=='Revisar' || $eleEY->estado=='Reparacion' || $eleEY->estado=='Por Entregar' || $eleEY->estado=='Por Retirar')
                                            <option disabled="" class="option-Reservado" value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                        @else
                                            @if ($eleEY->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                            @else
                                                <option class="option-Disponible"  value="{{ $eleEY->idEquipo }}">Y{{ $eleEY->idEquipo }} / {{ $eleEY->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endforeach 
                                </select>
                            @endif
                        @endif
                    </span>
                    <span class="span-barra"  id="tubo1m" >-
                        @if ($pedido->dispoT1 != 0)
                            <select class="completo" name="NumeroDispoT1">
                                <option selected value="{{$pedido->dispoT1}}">T{{$pedido->dispoT1}} /  - ACTUAL</option>
                                @foreach($elegirT680L as $eleT1)
                                    @if ($pedido->dispoT1!= $eleT1->idTubo)
                                        @if ($eleT1->estado=='Reservado' || $eleT1->estado=='Revisar' || $eleT1->estado=='Reparacion')
                                            <option disabled="" class="option-Reservado" value="{{ $eleT1->idTubo }}">T{{ $eleT1->idTubo }} / {{ $eleT1->estado }}</option>
                                        @else
                                            @if ($eleT1->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleT1->idTubo }}">T{{ $eleT1->idTubo }} / {{ $eleT1->estado }}</option>
                                            @else
                                                <option class="option-Disponible" value="{{ $eleT1->idTubo }}">T{{ $eleT1->idTubo }} / {{ $eleT1->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </span>
                    <span class="span-barra" id="tubo415">-
                        @if ($pedido->dispoT415 != 0)
                            <select class="completo" name="NumeroDispoT415">
                                <option selected value="{{$pedido->dispoT415}}">T{{$pedido->dispoT415}} /  - ACTUAL</option>
                                @foreach($elegirT415L as $eleT415)
                                    @if ($pedido->dispoT415!= $eleT415->idTubo)
                                        @if ($eleT415->estado=='Reservado' || $eleT415->estado=='Revisar' || $eleT415->estado=='Reparacion')
                                            <option disabled="" class="option-Reservado" value="{{ $eleT415->idTubo }}">T{{ $eleT415->idTubo }} / {{ $eleT415->estado }}</option>
                                        @else
                                            @if ($eleT415->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleT415->idTubo }}">T{{ $eleT415->idTubo }} / {{ $eleT415->estado }}</option>
                                            @else
                                                <option class="option-Disponible" value="{{ $eleT415->idTubo }}">T{{ $eleT415->idTubo }} / {{ $eleT415->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @endif 
                    </span>
                    <span id="oximetro" >- 
                        @if ($pedido->dispoO != 0) 
                            <select class="completo" name="NumeroDispoO">
                                <option selected value="{{$pedido->dispoO}}">X{{$pedido->dispoO}} /  - ACTUAL</option>
                                @foreach($elegirO as $eleO)
                                    @if ($pedido->dispoO != $eleO->idOximetro)
                                        @if ($eleO->estado=='Reservado' || $eleO->estado=='Revisar' || $eleO->estado=='Reparacion')
                                            <option disabled="" class="option-Reservado" value="{{ $eleO->idOximetro }}">X{{ $eleO->idOximetro }} / {{ $eleO->estado }}</option>
                                        @else
                                            @if ($eleO->estado=='En Uso')
                                                <option class="option-En" disabled value="{{ $eleO->idOximetro }}">X{{ $eleO->idOximetro }} / {{ $eleO->estado }}</option>
                                            @else
                                                <option class="option-Disponible" value="{{ $eleO->idOximetro }}">X{{ $eleO->idOximetro }} / {{ $eleO->estado }}</option>
                                            @endif 
                                        @endif 
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </span> 
                </p>


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
                    <input  type="number" name="costoEnvio" id="medioPago" autocomplete="off" value="{{ $pedido->costoEnvio }}" placeholder="{{ $pedido->costoEnvio }}">
                    <select  name="medioPagoEnvio" id="medioPago" >
                        <optgroup label="Envio">
                        <option value="{{ $pedido->medioPagoEnvio }}">{{ $pedido->medioPagoEnvio }} - ACTUAL</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                        <option value="Uala" >Uala</option>
                        <option value="A Confirmar" >A Confirmar</option>
                    </select> 
                    @error('costoEnvio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="medioPago" id="medioPagoLabel">Medios de Pago</label>
                    <select  class="completo"  name="medioPagoAlquiler" id="medioPago" >
                        <optgroup label="Alquiler">
                        <option value="{{ $pedido->medioPagoAlquiler }}" >{{ $pedido->medioPagoAlquiler }} - ACTUAL</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                        <option value="Uala" >Uala</option>
                        <option value="A Confirmar" >A Confirmar</option>
                    </select> 
                    <select  name="medioPagoGarantia" id="medioPago" >
                    <optgroup label="Garantia">
                        @if ($pedido->medioPagoGarantia=='No Se Cobra')    
                            <option value="{{ $pedido->medioPagoGarantia }}" >{{ $pedido->medioPagoGarantia }}</option>
                        @else     
                            <option value="{{ $pedido->medioPagoGarantia }}" >{{ $pedido->medioPagoGarantia }} - ACTUAL</option>
                            <option value="Efectivo" >Efectivo</option>
                            <option value="Bank" >Bank</option>
                            <option value="Mercado Pago" >Mercado Pago</option>
                            <option value="Uala" >Uala</option>
                            <option value="A Confirmar" >A Confirmar</option>
                        @endif     

                    </select>  
                    @error('medioPagoAlquiler')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="nombreCliente">Nombre del Cliente</label>
                    <input maxlength="35"  class="completo"  type="text" name="nombreCliente" id="nombreCliente" autocomplete="off" value="{{ $pedido->nombreCliente }}" placeholder="{{ $pedido->nombreCliente }}">
                    @error('nombreCliente')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                
                <p>
                    <label for="dni">Dni</label>
                    <input  maxlength="30"  class="completo"  type="number" name="dni" id="dni" autocomplete="off" value="{{ $pedido->dni }}" placeholder="{{ $pedido->dni }}" >
                    @error('dni')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>

                <p>
                    <label for="direccion">Direccion</label>
                    <input  maxlength="30"  class="completo"  type="text" name="direccion" id="direccion" autocomplete="off" value="{{ $pedido->direccion }}" placeholder="{{ $pedido->direccion }}" >
                    @error('direccion')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="localidad">Localidad</label>
                    <input  maxlength="30" class="completo"  type="text" name="localidad" id="localidad" autocomplete="off" value="{{ $pedido->localidad }}" placeholder="{{ $pedido->localidad }}" >
                    @error('localidad')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="telefono">Telefono</label>
                    <input  maxlength="18"  class="completo"  type="number" name="telefono" id="telefono" autocomplete="off" value="{{ $pedido->telefono }}" placeholder="{{ $pedido->telefono }}">
                    @error('telefono')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="email">Email</label>
                    <input  maxlength="60"  type="email" name="email" id="email" autocomplete="off" value="{{ $pedido->email }}" placeholder="{{ $pedido->email }}">
                </p>
                <p>
                            <!--CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
                        @php
                            $originalDate = $pedido->fechaInicio;
                            $fechaInicioF = date("Y-m-d", strtotime($originalDate));  
                            $fechaInicioH = date("H:i", strtotime($originalDate));  
                        @endphp
                
                    <label for="fechaInicio">Fecha Entrega</label>
                    @if ($pedido->estadoPedido=='Retirar' )
                        <input readonly class="completo" type="datetime-local"  name="fechaInicio"  id="fechaInicio" autocomplete="off" value="@php echo $fechaInicioF.'T'.$fechaInicioH;@endphp">
 
                    @else
                        <input class="completo" type="datetime-local"  name="fechaInicio"  id="fechaInicio" autocomplete="off" value="@php echo $fechaInicioF.'T'.$fechaInicioH;@endphp">
                    
                    @endif
                    
                    @error('fechaInicio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="dias">Mes/Meses</label>
                    @if ($pedido->estadoPedido=='Retirar' )

                        @if ($pedido->dias==15)
                            <input type="text" disabled id="dias" value="15 Dias - Actual">
                        @else
                            <input type="text" disabled id="dias" value="{{ $pedido->dias/30  }} Meses - Actual">
                        @endif

                        <input type="hidden" name="dias" id="dias" value="{{ $pedido->dias/30 }}">
                    @else
                        <select class="completo"  name="dias" id="dias" >
                            @if ($pedido->dias==15)
                                <option value="15">15 Dias - Actual</option>
                            @else
                                <option value="{{ $pedido->dias/30 }}">{{ $pedido->dias/30  }} Meses - Actual</option>
                            @endif
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
                    @endif

                </p>
                <p id="fechaFin"> 
                    <label for="fechaFin">Fecha Finalizacion</label>
                    <input readonly type="text" name="fechaFin" id="fechaFin" autocomplete="off" value="{{ $pedido->fechaFin }}" placeholder="{{ $pedido->fechaFin }}" >
                </p>
                <p>
                    <label for="recibe">Recibe</label>
                    <input  maxlength="30" class="completo"  type="text" name="recibe" id="recibe" autocomplete="off" value="{{ $pedido->recibe }}" placeholder="{{ $pedido->recibe }}" >
                </p>
                <p>
                    <label for="imgDniF">Cargar Imagen Dni Frente</label>
                    <input type="file" accept="image/*" name="imgDniF" id="imgDniF">
                </p><p>
                    <label for="imgDniD">Cargar Imagen Dni Dorso</label>
                    <input type="file" accept="image/*" name="imgDniD" id="imgDniD">
                </p><p>
                    <label for="imgOrden">Cargar Imagen Orden Medica</label>
                    <input type="file" accept="image/*" name="imgOrden" id="imgOrden">
                </p>
                <p> 
                    <label for="comentarios">Comentarios</label>
                    <textarea maxlength="252" rows="3" cols="50" type="text" name="comentarios" id="comentarios">{{$pedido->comentarios }}</textarea>
                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminPedidos'" type="button">Volver</button>
                </p>  
                <p>
                    <button class="btn-verModificar button-completo"  disabled   type="sumbit">Modificar Alquiler</button>
                </p>                               
            </form>
        </div>
    </div>
</div>
 <br>  
 <br>  
 <br>  
 
<script src="{{ asset('js/formu-ajax.js') }}"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<!--<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
-->
@endsection