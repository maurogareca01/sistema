@extends('layouts.plantilla')

@section('titulo','Calendario')
 
@section('subTitulo', 'CALENDARIO - ORDEN DE ENTREGA / RETIRO') 

@section('contenido')

<div id="calendar"></div>
<br>
  <br>
  <br>
<div class="overlay" id="overlay">
    <div class="popup" id="popup">

        <div class="content-formulario content-alta">

            <div class="contact-wrapper">
                
                <div class="modifica-form alta">
                <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>
                    <form action="">
                    
                        <p>
                            <label for="idPedido">N° de Alquiler</label>
                            <input  readonly type="text" name="idPedido" id="idPedido">
                        </p>
                        <p>
                            <label for="descripcion">Descripcion</label>
                            <input  readonly type="text" name="descripcion" id="descripcion">
                        </p>
                        <p>
                            <label for="nombreServ">Servicio</label>
                            <input required  readonly  type="text" name="nombreServ" id="nombreServ" >
                        </p>
                        <p>
                            <label for="nombreCliente">Nombre del Cliente</label>
                            <input required  readonly  type="text" name="nombreCliente" id="nombreCliente" >
                        </p>
                        
                        <p>
                            <label for="dni">Dni</label>
                            <input required  readonly type="number" name="dni" id="dni"  >
                        </p>

                        <p>
                            <label for="direccion">Direccion</label>
                            <input required  readonly  type="text" name="direccion" id="direccion">
                        </p>
                        <p>
                            <label for="localidad">Localidad</label>
                            <input required  readonly  type="text" name="localidad" id="localidad">
                        </p>
                        <p>
                            <label for="telefono">Telefono</label>
                            <input required  readonly  type="number" name="telefono" id="telefono">
                        </p>
                        
                        <p>
                            <label for="fechaInicio">Fecha de Entrega</label>
                            <input required  readonly type="text" name="fechaInicio" id="fechaInicio">
                        </p>
                        <p>
                            <label for="fechaFin">Fecha de Finalizacion del Alquiler</label>
                            <input required  readonly   type="text" name="fechaFin" id="fechaFin">
                        </p>
                        <p>
                            <label for="fechaRetiro">Fecha de Retiro</label>
                            <input required  readonly   type="text" name="fechaRetiro" id="fechaRetiro">
                        </p>
                        <p id="logistica">
                            <label for="logistica"></label>
                            <input  readonly type="text" name="logistica">
                        </p> 
                        <input type="hidden" class="btn-add" id="btn-abrir-popup"> 
                        
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="overlay" id="overlay2">
    <div class="popup" id="popup2">

        <div class="content-formulario content-alta  ">

            <div class="contact-wrapper">
                
                <div class="modifica-form cambio">
                <p href="#" id="btn-cerrar-popup2" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>
                    <form action="">

                        
                        
                        <p>
                            <label for="nombreCliente">Nombre del Cliente</label>
                            <input required  readonly class="controls"   type="text" name="nombreCliente" id="nombreCliente2" >
                        </p> 
                        
                        <p>
                            <label for="dni">Dni</label>
                            <input required  readonly class="controls"   type="number" name="dni" id="dni2"  >
                        </p>
                        <p>
                            <label for="direccion">Direccion</label>
                            <input required  readonly class="controls"   type="text" name="direccion" id="direccion2">
                        </p>
                        <p>
                            <label for="localidad">Localidad</label>
                            <input required  readonly class="controls"   type="text" name="localidad" id="localidad2">
                        </p>
                        <p>
                            <label for="telefono">Telefono</label>
                            <input required  readonly class="controls"  min=0 type="number" name="telefono" id="telefono2">
                        </p> 
                        <p>
                            <label for="fechaInicio">Fecha Del Cambio</label>
                            <input required  readonly class="controls"  type="text" name="fechaInicio" id="fechaInicio2">
                        </p> 
                        <p>
                            <label for="descripcion">Descripcion</label>
                            <textarea readonly style="height: 150px;" maxlength="252" name="descripcion2" class="descripcion2" id="descripcion2" cols="30" rows="10"> </textarea>
                        </p>
                        
                        
                        <p>
                            <label for="cambio">Comentarios Del Cambio</label>
                            <textarea readonly style="height: 150px;" maxlength="252" name="cambio" class="cambio2" id="cambio2" cols="30" rows="10"></textarea>
                        </p>
                        <input type="hidden" class="btn-add" id="btn-abrir-popup2"> 
                        
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="overlay" id="overlay3">
    <div class="popup" id="popup3">

        <div class="content-formulario content-alta  ">

            <div class="contact-wrapper">
                
                <div class="modifica-form cambio">
                <p href="#" id="btn-cerrar-popup3" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>
                    <form action="">
                        <p>
                            <label for="idTarea3">N° de Tarea</label>
                            <input required  readonly class="controls"  min=0 type="number" name="idTarea3" id="idTarea3">
                        </p>
                        <p>
                            <label for="name3">Escrita Por:</label>
                            <input required  readonly class="controls"  type="text" name="name3" id="name3">
                        </p> 
                        <p>
                            <label for="asignada3">Asignada a:</label>
                            <input required  readonly class="controls"  type="text" name="asignada3" id="asignada3">
                        </p> 
                        <p>
                            <label for="fecha3">Fecha a Realizar</label>
                            <input required  readonly class="controls"  type="text" name="fecha3" id="fecha3">
                        </p> 
                        <p>
                            <label for="descripcion3">Descripcion</label>
                            <textarea readonly style="height: 150px;" maxlength="252" name="descripcion3" class="descripcion3" id="descripcion3" cols="30" rows="10"> </textarea>
                        </p>
                        <p>
                            <label for="estado3">Estado</label>
                            <input required  readonly class="controls"  type="text" name="estado3" id="estado3">
                        </p> 
                        <input type="hidden" class="btn-add" id="btn-abrir-popup3"> 
                        
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

 

@php
    $fecha=date("Y-m-d"); 
@endphp
<div class="fecha-input">
    <form >     
        <input type="date" name="fechaCalendario" id="fechaCalendario" value="{{$fecha}}">
            
        <button type="submit">
            Buscar Entregas/Retiros  <i class="fas fa-search"></i> 
        </button>
                         
    </form>
</div>

<div class="inven-tablas">
    @if($array) 
       
        @foreach($array as $orden) 
            @if (auth()->user()->id==$orden[0]->id || auth()->user()->hasRoles(['admin','administrador'])) 
                <div class="tablas"  > 
                    <h1 class="titulo-dispo">
                        --{{$orden[0]->name}} {{ $orden[0]->apellido }}--
                    </h1>
                    <div class="content">
                        <table class="content-table">
                            <thead class="thead">
                                <tr>
                                    <th>Logistica</th> 
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Orden</th>
                                    <th>N° Alquiler</th>
                                    <th>Cliente</th> 
                                    <th>Comentarios</th> 

                                    <th colspan="2" class="text-center"> 
                                        <p id="btn-abrir-popup-orden-{{$orden[0]->id}}">
                                            <button type="submit"  onclick="orden('{{$orden[0]->id}}')" class="btn-add"  style="font-size: 30px;">
                                                <i class="fas fas fa-pen"></i>  
                                            </button>
                                        </p> 
                                        <div class="overlay" id="overlay-orden-{{$orden[0]->id}}">
                                            <div class="popup" id="popup-orden-{{$orden[0]->id}}">
                                                <div class="content-formulario {{ count($orden)>='4' ? 'content-alta4 ':'content-alta' }}">
                                                    <div class="contact-wrapper">
                                                        <div class="modifica-form {{ count($orden)>='4' ? 'alta4 ':'alta' }}">
                                                        <p href="#" id="btn-cerrar-popup-orden-{{$orden[0]->id}}" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                                                            <h1>Orden de Entregas/Retiros de  : {{$orden[0]->name}} {{$orden[0]->apellido}}</h1>
                                                            <h3>Fecha:{{ $fecha}} </h3>

                                                            <form action="/modificarOrden/{{$orden[0]->id}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @for($x = 0; $x < count($orden); $x++)
                                                                    <p> 
                                                                        @php
                                                                            $originalDate = $orden[$x]->fechaCalendario;
                                                                            $fecha= date("d-m-Y", strtotime($originalDate));  

                                                                            $formatter = new NumberFormatter('es_ES', NumberFormatter::SPELLOUT);
                                                                            $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-ordinal-masculine"); 
                                                                        
                                                                            
                                                                        @endphp
                                                                        
                                                                        Alquiler N°:   {{ $orden[$x]->idPedido }} / {{ $orden[$x]->estadoPedido }}  <br>
                                                                        Servicio:   {{ $orden[$x]->descripcion }}  <br>
                                                                        Cliente:   {{ $orden[$x]->nombreCliente }}  <br>
                                                                        Direccion:   {{ $orden[$x]->direccion }}  <br>
                                                                        <select required name="orden[]">
                                                                            @if ($orden[$x]->orden=='')
                                                                                <option value="">Seleccione Orden de Entrega/Retiro</option>
                                                                            @else
                                                                                <option value="{{ $orden[$x]->orden}}">{{ ucwords($formatter->format($orden[$x]->orden)) }} - ACTUAL</option>
                                                                            @endif
                                                                            @for($i = 1; $i <= count($orden); $i++)  
                                                                                <option value="{{ $i }}" >{{ ucwords($formatter->format($i)) }}</option>
                                                                                
                                                                            @endfor
                                                                            
                                                                        </select>  
                                                                        <input type="hidden" name="ordenCalendario[]" value="{{ $orden[$x]->idCalendario }}">
                                                                    </p>
                                                                @endfor
                                                                <p>
                                                                    <button class="btn-verModificar button-completo"   id="btn-gasto-agregar" type="sumbit">Guardar</button>
                                                                </p>                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                @for($i = 0; $i < count($orden); $i++)
                                    <tr>
                                        @php
                                            $originalDate = $orden[$i]->start;
                                            $fecha= date("d-m-Y ", strtotime($originalDate));  

                                            $formatter2 = new NumberFormatter('es_ES', NumberFormatter::SPELLOUT);
                                            $formatter2->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-ordinal-masculine"); 
                                                                        
                                        @endphp

                                        @if ($orden[$i]->estadoPedido=='Entrega')
                                            <td> {{ $orden[$i]->estadoPedido }} </td>
                                            <td class="ajustes"> {{ $fecha }} </td>
                                            <td> {{ $orden[$i]->logisticaE }} </td>
                                        @elseif ($orden[$i]->estadoPedido=='Retirar')
                                            <td> {{ $orden[$i]->estadoPedido }} </td>
                                            <td class="ajustes"> {{ $fecha }} </td>
                                            <td> {{ $orden[$i]->logisticaR }} </td>
                                        @elseif ($orden[$i]->estadoPedido=='Entrega/Retiro')
                                            <td> Cambio</td>
                                            <td class="ajustes"> {{ $fecha }} </td>
                                            <td> {{ $orden[$i]->logisticaE }} </td>
                                        @endif 

                                        <td> {{ $orden[$i]->descripcion }} </td>
                                        <td  class="{{  
                                            $orden[$i]->orden=='' ? 'entrega':'entregado' }}"> 
                                            @if ($orden[$i]->orden=='')
                                                ?
                                            @else
                                                {{ ucwords($formatter->format($orden[$i]->orden)) }}
                                            @endif

                                        </td>
                                        <td> 
                                            {{$orden[$i]->idPedido}} 

                                        </td>
                                        <td>
                                            <button type="button" 
                                                onclick="verClienLogistica('{{$orden[$i]->nombreCliente}}',
                                                '{{$orden[$i]->dni}}',
                                                '{{$orden[$i]->direccion}}',
                                                '{{$orden[$i]->localidad}}',
                                                '{{$orden[$i]->telefono}}',
                                                '{{$orden[$i]->recibe}}',
                                                '{{$orden[$i]->comentarios}}')">
                                                @php
                                                    $nombre = explode(" ", $orden[$i]->nombreCliente);
                                                @endphp
                                                {{$nombre[0]}}
                                            </button>
                                        </td>
                                        <td>
                                            <input type="hidden" id="{{$orden[$i]->idCalendario}}" value="{{$orden[$i]->comentarios}}">
                                            <button type="button" onclick="com('{{$orden[$i]->idCalendario}}')">Comentarios</button>
                                        </td>
                                        <td></td>
                                        
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>  
                </div>
            @endif

        @endforeach
    @else
        <h1 class="text-entrega-retiro">No Hay Entregas o Retiros</h1>    
        <br>
        <br>
        <br>
        <br>         
    @endif
</div>

<br>
<br>
<br>
<br>

<!--SCRIPT DEL CALENDARIO-->
<script>
    
    document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'local',
            eventDisplay:'block',   
            headerToolbar:{
                left:'prev,next today',
                center:'title',
                right:'dayGridMonth,timeGridWeek,timeGridDay'
            },
            /*customButtons: {
                myCustomButton: {
                    text: 'custom!',
                    click: function() {
                        alert('clicked the custom button!');
                    overlay = document.getElementById('overlay'),
                    popup = document.getElementById('popup'),
                    overlay.classList.add('active');
                    popup.classList.add('active');

                    }
                }
            },
            dateClick:function(info){
                    
                        overlay = document.getElementById('overlay'),
                    popup = document.getElementById('popup'),
                    overlay.classList.add('active');
                    popup.classList.add('active');
                    

            },*/
                
            eventClick:function(info){ 
                if(info.event.extendedProps.bandera=="tarea"){

                    var fecha = moment(info.event.extendedProps.fechaInicio)
                    var fecha = fecha.format('DD/MM/YYYY'); 
                    $('#fecha3').val(fecha)

                    $('#descripcion3').val(info.event.extendedProps.descripcion) 
                    $('#estado3').val(info.event.extendedProps.estadoPedido) 
                    $('#idTarea3').val(info.event.extendedProps.idTarea) 
                    $('#name3').val(info.event.extendedProps.nombreServ) 
                    $('#asignada3').val(info.event.extendedProps.nombreCliente) 

                    


                    overlay3 = document.getElementById('overlay3'),
                    popup3 = document.getElementById('popup3'),
                    overlay3.classList.add('active');
                    popup3.classList.add('active');
                }else
                if(info.event.extendedProps.bandera=="Cambio"){
                    $('#descripcion2').val(info.event.extendedProps.descripcion)
                    $('#nombreCliente2').val(info.event.extendedProps.nombreCliente)
                    $('#dni2').val(info.event.extendedProps.dni)
                    $('#direccion2').val(info.event.extendedProps.direccion)
                    $('#localidad2').val(info.event.extendedProps.localidad)
                    $('#telefono2').val(info.event.extendedProps.telefono)
                    $('#fechaInicio2').val(info.event.extendedProps.fechaInicio)
                    $('#cambio2').val(info.event.extendedProps.cambio)

                    


                    overlay2 = document.getElementById('overlay2'),
                    popup2 = document.getElementById('popup2'),
                    overlay2.classList.add('active');
                    popup2.classList.add('active');
                }else{
                    if(info.event.extendedProps.bandera=='inicio'){
                        $('#idPedido').val(info.event.extendedProps.idPedido)
                        $('#descripcion').val(info.event.extendedProps.descripcion)
                        $('#nombreServ').val(info.event.extendedProps.nombreServ)
                        $('#nombreCliente').val(info.event.extendedProps.nombreCliente)
                        $('#dni').val(info.event.extendedProps.dni)
                        $('#direccion').val(info.event.extendedProps.direccion)
                        $('#localidad').val(info.event.extendedProps.localidad)
                        $('#telefono').val(info.event.extendedProps.telefono)
                        $('#fechaInicio').val(info.event.extendedProps.fechaInicio)
                        $('#fechaFin').val(info.event.extendedProps.fechaFin)
                        $('#fechaRetiro').val(info.event.extendedProps.fechaRetiro)

                        $('#logistica').empty();
                        $('#logistica').append(
                            "<label for='logistica'> Logistica Entrega</label>"+
                            "<input  readonly type='text' name='logistica'  value='"+info.event.extendedProps.logisticaE+"'>"
                            );

                            
                        overlay = document.getElementById('overlay'),
                        popup = document.getElementById('popup'),
                        overlay.classList.add('active');
                        popup.classList.add('active');
                    }else{
                        if(info.event.extendedProps.bandera=='fin'){
                            $('#idPedido').val(info.event.extendedProps.idPedido)
                            $('#descripcion').val(info.event.extendedProps.descripcion)
                            $('#nombreServ').val(info.event.extendedProps.nombreServ)
                            $('#nombreCliente').val(info.event.extendedProps.nombreCliente)
                            $('#dni').val(info.event.extendedProps.dni)
                            $('#direccion').val(info.event.extendedProps.direccion)
                            $('#localidad').val(info.event.extendedProps.localidad)
                            $('#telefono').val(info.event.extendedProps.telefono)
                            $('#fechaInicio').val(info.event.extendedProps.fechaInicio)
                            $('#fechaFin').val(info.event.extendedProps.fechaFin)
                            $('#fechaRetiro').val(info.event.extendedProps.fechaRetiro)

                            $('#logistica').empty();
                            $('#logistica').append(
                                "<label for='logistica'>Logistica Retiro</label>"+
                                "<input  readonly type='text' name='logistica' value='"+info.event.extendedProps.logisticaR+"'>"
                                );

                            
                            overlay = document.getElementById('overlay'),
                            popup = document.getElementById('popup'),
                            overlay.classList.add('active');
                            popup.classList.add('active');
                        }
                    }
                }
            }, 
            events:"{{url('calendario')}}" ,
            /*events: [
                { 
                title: 'my event',
                start: '2021-01-22T09:10:00',
                textColor:'black',
                backgroundColor:'#f8ef6e', 
                borderColor:'black', 
                } , { 
                title: 'CAM/entrega 45234',
                start: '2021-01-22T08:10:00',
                textColor:'black',
                backgroundColor:'#f8ef6e',
                borderColor:'black', 
                } , { 
                start: '2021-01-22T10:00:00',
                textColor:'black',
                backgroundColor:'#f8ef6e',
                borderColor:'black', 
                } , { 
                start: '2021-01-22T10:00:00',
                textColor:'black',
                backgroundColor:'#f8ef6e',
                borderColor:'black', 
                } , { 
                start: '2021-01-22T10:00:00',
                textColor:'black',
                backgroundColor:'#f8ef6e',
                borderColor:'black', 
                } ,{ 
                start: '2021-01-25T22:00:00',
                textColor:'black',
                backgroundColor:'#f8ef6e',
                borderColor:'black', 
                } 
            ],*/
            
            dayMaxEventRows: true,
            views: {
                timeGrid: {
                    dayMaxEventRows: 4, 
                } ,
                dayGrid: {
                    displayEventTime:false,  
                },
            },
            dayHeaderContent: (args) => {
                if(screen.width >= 480){ 

                    if (args.text=="dom."){
                        
                        args.text="Domingo"
                    }
                    if (args.text=="lun."){
                        
                        args.text="Lunes"
                    }
                    if (args.text=="mar."){
                        
                        args.text="Martes"
                    }
                    if (args.text=="mié."){
                        
                        args.text="Miércoles"
                    }
                    if (args.text=="jue."){
                        
                        args.text="Jueves"
                    }
                    if (args.text=="vie."){
                        
                        args.text="Viernes"
                    }
                    if (args.text=="sáb."){
                        
                        args.text="Sábado"
                    } 
                }
                //console.log(args )
                //return moment(args.text).format('dddd')
                
            } 
        });
            
        calendar.setOption('locale','es')
        calendar.render();  
        
    });
    
</script>  
 
 
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->
<script src="js/formu-ajax.js"></script>   <!--SCRIPT PARA TRAER LOS DATOS DEL SERVICO PARA LA ALTA DE UN ALQUILER-->
<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->
@endsection