<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga-Alquiler-{{$pedido->idPedido}}</title>

    <link rel="stylesheet" href="css/estilo-pdf.css">
      
</head> 
<body>
    <div class="remito"> 
        <div class="frenteR1">
            <img src="img/banner.jpg" alt="">
            <div class="frenteDatos">
                <div class="frenteDatos-izq">
                    <p>info@hhoxigeno.com</p>
                </div>
                <div class="frenteDatos-der">
                    <p>www.hhoxigeno.com</p>
                </div>
            </div> 
        </div>
        <div class="frenteDatos-2">
            CUIT: 23-35192742-9 &nbsp; &nbsp; | &nbsp; &nbsp; 1173673530 &nbsp; &nbsp; | &nbsp; &nbsp; Heredia 825,Villa Lynch
        </div>
        <br>
        <br>
        <br>
        <div class="frenteDatos-3">
            <div class="frenteDatos-3-izq">
                <p>N° Remito: {{ $pedido->idPedido }}</p>
            </div>
            <div class="frenteDatos-3-der">
                @php
                    $originalDate = $pedido->fechaInicio;
                    $fechaInicio = date("d/m/Y", strtotime($originalDate)); 
                    $originalDate2 =  $pedido->fechaFin ;
                    $fechaFin = date("d/m/Y", strtotime($originalDate2));
                @endphp
                <p>Fecha: {{ $fechaInicio }}</p>
            </div>
        </div> 
        <br>
        <br>
        <br>
        <div class="frenteDatos-4">
            <div class="frenteDatos-4-izq"> 
                <p>NOMBRE: <b>{{ $pedido->nombreCliente }}</b></p>
                <p>DIRECCION: <b> {{ $pedido->direccion }}</b></p>
                <p>TELEFONO:<b> {{ $pedido->telefono }}</b></p>
            </div>
            <div class="frenteDatos-4-der">
                <p>DNI: <b> {{ $pedido->dni }}</b></p>
                <p>LOCALIDAD: <b> {{ $pedido->localidad }}</b></p>
            </div>
        </div>
        <div class="frente-tabla ">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>

                    @if($pedido->dispoER !=0)
                    <tr>
                        <td></td>
                        <td >
                            Concentrador Respironics N°: R{{ $pedido->dispoER }} <br> 
                            Numero de Serie: {{ $equipoER->numSerie }}
                        </td>
                        <td>1 </td>
                    </tr> 
                    @endif
                    @if($pedido->dispoEA !=0)
                    <tr>
                        <td></td>
                        <td>
                            Concentrador Arisep N°: A{{ $pedido->dispoEA }} <br> 
                            Numero de Serie:  {{ $equipoEA->numSerie }}
                        </td>
                        <td>1 </td>
                    </tr> 
                    @endif
                    @if($pedido->dispoEY !=0)
                    <tr>
                        <td></td>
                        <td>
                            Concentrador Yuwell N°: Y{{ $pedido->dispoEY }} <br> 
                            Numero de Serie:  {{ $equipoEY->numSerie }}
                        </td>
                        <td>1 </td>
                    </tr> 
                    @endif
                    @if($pedido->dispoT1 !=0)
                    <tr>
                        <td></td>
                        <td>
                            Tubo N°: T{{ $pedido->dispoT1 }} <br> 
                            Numero de Serie:   {{ $tuboT1->numSerie }}
                        </td>
                        <td> 1</td>
                    </tr>
                    @endif
                    @if($pedido->dispoT415 !=0)
                    <tr>
                        <td></td>
                        <td>
                            Tubo N°:  T{{ $pedido->dispoT415 }} <br> 
                            Numero de Serie: {{ $tuboT415->numSerie }}
                        </td>
                        <td> 1</td>
                    </tr>
                    @endif
                    @if($pedido->dispoO !=0)
                    <tr>
                        <td></td>
                        <td>
                            Oximetro N°: X{{ $pedido->dispoO }} <br> 
                        </td>
                        <td>1</td>
                    </tr>
                    @endif
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                    </tr><tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                    </tr>
                      
                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <b>{{ $pedido->descripcion }} </b>
                        </td>
                    </tr>
                    <tr> 
                        <td style="text-align: center;" colspan="3"><b> SERVICIO   
                                S-{{ $pedido->idServicio }} 
                                @if ($pedido->dispoER!=0)
                                    R
                                @elseif ($pedido->dispoEA!=0)
                                    A
                                @elseif ($pedido->dispoEY!=0)
                                    Y
                                @endif  
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <br> 
        <div class="frenteDatos-5">
            <div class="frenteDatos-5-izq"> 
                <p>RECIBE CONFORME</p>
            </div>
            <div class="frenteDatos-5-der">
                <p>FIRMA Y ACLARACION</p>
            </div>
            <img src="img/hh_oxigeno.png" id="logo2" alt="">

        </div> 
        <br>
        <br>
        <br>
    </div>
     
    <div class="presupuesto">
        <div class="frenteP">
            <img src="img/banner2.jpg" alt=""> 
            <div class="caja-presu">
                PRESUPUESTO
            </div>
        </div>
        <div class="frenteP2">
            <div class="frenteP2-izq">
                <p>NOMBRE:  {{$pedido->NombreCliente}} </p>
                <p>DIRECCION:  {{$pedido->direccion}} </p>
                <p>TELEFONO: {{$pedido->telefono}}</p>
            </div>
            <div class="frenteP2-der">
                <p>LOCALIDAD:   {{$pedido->localidad}} </p>
                <p>DNI: {{$pedido->telefono}}</p>
            </div>
        </div>
        <div class="frente-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>DETALLE</th>
                        <th>DIAS</th>
                        <th>PRECIO</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>
                            S-{{ $pedido->idServicio }} 
                            @if ($pedido->dispoER!=0)
                                R
                            @elseif ($pedido->dispoEA!=0)
                                A
                            @elseif ($pedido->dispoEY!=0)
                                Y
                            @endif  
                        </td>
                        <td>{{ $pedido->descripcion }}</td>
                        <td>{{ $pedido->dias }} </td>
                        <td>{{ $pedido->costoServ }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Envio y Retiro</td>
                        <td> </td>
                        <td>{{ $pedido->costoEnvio }}</td>
                    </tr>
                    @if($pedido->garantia != 0)
                        <tr>
                            <td></td>
                            <td>Deposito</td>
                            <td> </td>
                            <td>{{ $pedido->garantia }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td> </td>
                        <td></td>
                    </tr>
                    <tr> 
                        <td class="td-borde-total" colspan="3"  ><b> TOTAL DE DETALLE </b> </td>
                        <td><b> @php echo $total=$pedido->garantia+$pedido->costoEnvio+$pedido->costoServ @endphp</b></td>
                    </tr>

                    <tr>
                        <td class="td-bordes-f">&nbsp;</td>
                        <td class="td-bordes-f"></td>
                        <td class="td-bordes-f"></td>
                        <td class="td-bordes-f"></td>
                    </tr>
                    <tr >
                        <td class="td-bordes">&nbsp;</td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                    </tr>
                    <tr >
                        <td class="td-bordes" >&nbsp;</td> 
                        <td class="td-bordes" ></td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td colspan="2"></td> 
                        <td></td>
                    </tr><tr>
                        <td class="td-bordes-f">&nbsp;</td>
                        <td class="td-bordes-f"></td>
                        <td class="td-bordes-f"></td>
                        <td class="td-bordes-f"></td>
                    </tr>
                    <tr >
                        <td class="td-bordes">&nbsp;</td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                    </tr>
                    <tr >
                        <td class="td-bordes" >&nbsp;</td> 
                        <td class="td-bordes" ></td>
                        <td class="td-bordes"></td>
                        <td class="td-bordes"></td>
                    </tr>
                    <tr> 
                        <td colspan="3">TOTAL PRESUPUESTO</td> 
                        <td></td>
                    </tr>
                </tbody>
            </table>  
        </div>    
        <br> 
        <div class="text">
            <p>
            Este es un presupuesto de los artículos indicados. Los requisistos para el alquiler del servicio son enviar foto del DNI o similar y la firma de un pagaré por el total del valor de los equipos, el mismo será devuelto al finalizar el alquiler y retirar los equipos del domicilio.
            </p>
        </div>
        <div class="frenteP-final"> 
            <img src="img/banner3.jpg" alt="">
            <div class="final-banner">
                WWW.HHOXIGENO.COM &nbsp; &nbsp; | &nbsp; &nbsp; 1173673530 &nbsp; &nbsp; | &nbsp; &nbsp; Heredia 825,Villa Lynch
            </div>
        </div>
        
    </div>
      

    <br>
    <div class="contrato">
        <div class="frenteR1">
            <img src="img/banner.jpg" alt="">
            <div class="frenteDatos">
                <div class="frenteDatos-izq">
                    <p>info@hhoxigeno.com</p>
                </div>
                <div class="frenteDatos-der">
                    <p>www.hhoxigeno.com</p>
                </div>
            </div> 
        </div>
        <div class="frenteDatos-2">
            CUIT: 23-35192742-9 &nbsp; &nbsp; | &nbsp; &nbsp; 1173673530 &nbsp; &nbsp; | &nbsp; &nbsp; Heredia 825,Villa Lynch
        </div>
        <div class="frente-contrato-1">
            <br>    
            <br>    
            <br>    
            <p class="parra"> Sr <b>{{ $pedido->nombreCliente}}</b></p>
            <p class="parra">Dirección:<b> {{ $pedido->direccion }}</b></p>
            <p class="parra">Localidad: <b>{{ $pedido->localidad }}</b></p>
            <p class="parra">Dni:<b> {{ $pedido->dni }}</b></p>


            <p class="parra">De mi consideración:</p>

            <p >Miguel Gareca, con domicilio en Republica del Líbano 4653, Villa Lynch, tengo el agrado de dirigirme a usted a fin de acercarle la presente propuesta de Contrato de Alquiler de Bien Mueble, bajo los términos y condiciones que se adjuntan como Anexo 1.</p>

            <p >La propuesta se considerará aceptada, con todos sus términos y condiciones, con la recepción por parte del destinatario de los bienes arrendados.</p>

            <p class="parra-der">Sin otro particular saludo a Ud. atentamente</p>

        </div>
    </div>
     
    <div class="contrato-1">
        
        <p class="parra-titulo"><b class="sub"> CONTRATO DE ALQUILER DE BIEN MUEBLE</b></p>
        <br>
        <p class="fecha-izq">{{ $fechaInicio }}</p>

        <br>
        </p><b class="sub">De una parte</b>, Sr Gareca Miguel, de aquí en adelante el arrendador, mayor de edad y portador del D.N.I. Nº 35.192.742</p>
        <p><b> Y de otra</b>, Sr/Sra <b>{{ $pedido->nombreCliente }}</b> de aquí en adelante el arrendatario, mayor de edad y portador del D.N.I. <b>{{ $pedido->dni }}</b></p>
        <br>
        <p> <b> I.</b> 	Que el Sr. arrendador es propietario del bien mueble, descrito como:</p>
        <br>
        <div class="contenedor-dis">
        @if($pedido->dispoER!=0)
            <div class="contiene">
                <p>Concentrador Respironics</p>
                <p>Nº de Equipo: R{{ $pedido->dispoER }}</p> 
                <p>Nº de serie:{{$equipoER->numSerie}}</p>
            </div>    
        @endif
        @if($pedido->dispoEA!=0)
            <div class="contiene">
                <p>Concentrador Airsep</p>
                <p>Nº de Equipo: A{{ $pedido->dispoEA }}</p> 
                <p>Nº de serie:{{$equipoEA->numSerie}}</p>
            </div>    
        @endif 
        @if($pedido->dispoEY!=0)
            <div class="contiene">
                <p>Concentrador Yuwell</p>
                <p>Nº de Equipo: Y{{ $pedido->dispoEY }}</p> 
                <p>Nº de serie:{{$equipoEY->numSerie}}</p>
            </div>    
        @endif
        @if($pedido->dispoT1!=0)
            <div class="contiene">
                <p>Tubo de 680L</p>
                <p>Nº de Tubo: T{{ $pedido->dispoT1 }}</p> 
                <p>Nº de serie:{{$tuboT1->numSerie}}</p>
            </div>    
        @endif
        @if($pedido->dispoT415!=0)
            <div class="contiene">
                <p>Tubo de 415L</p>
                <p>Nº de Tubo: T{{ $pedido->dispoT415 }}</p> 
                <p>Nº de serie:{{$tuboT415->numSerie}}</p>
            </div>    
        @endif
        @if($pedido->dispoO!=0)
            <div class="contiene">
                <p>Oximetro</p>
                <p>Nº de Oximetro: X{{ $pedido->dispoO }}</p>
            </div>    
        @endif    
        
        </div>
        <p><b> II.</b>      Que Sr/Sra arrendatario está interesado en el alquiler del citado bien mueble.
        Que ambas partes llevan a cabo el presente <b> CONTRATO DE ALQUILER DE BIEN MUEBLE</b>, en base a las siguientes,</p>
        <br>
        <p><b class="sub">CLÁUSULAS Y CONDICIONES:</b></p>
        <br>
        <p><b>PRIMERA:</b> El arrendador alquila al arrendatario el bien descrito, con cuanto le sea inherente y accesorio. Dicho bien es conocido por el arrendatario,<b class="sub">que encuentra conforme su estado</b>, y lo recibe a la firma del presente documento.</p> 
        <br>
        <p><b>SEGUNDA:</b> Que el presente contrato de arriendo se pacta en la suma total de <b> ${{ $pedido->costoServ }}</b>
        La cual quedará fija por 30 días, a partir del día 31, el arrendador podrá incrementar esta suma según su criterio.</p>

        <br>
        <p><b>TERCERA:</b> El alquiler del bien mueble se pacta por un plazo de 1 mes a contar desde esta fecha, el pago es por mes adelantado,<span class="sub"> no habrá devoluciones de dinero por entregar el equipo antes</span>. Si bien transcurrido dicho período sin que ninguna de las partes manifieste su voluntad de poner fin al arrendamiento, el mismo quedará prorrogado por iguales periodos sucesivos. </p>
        <br>
        <p><b>CUARTA:</b> El plazo para el pago es de hasta 120 horas posteriores al vencimiento. De no realizarse el mismo, se comenzará a devengar un interés diario del 5% sobre el valor del arrendamiento. A los 31 días de no haber abonado el monto pactado del arrendamiento, se considerará apropiación indebida del bien mueble y se procederá legalmente.</p>
        <br>
        <p><b> QUINTA:</b> Queda expresamente establecido que la devolución de los muebles arrendados deberá efectuarse en el mismo estado de conservación en el que fuera recibido por el 
        arrendatario, y se realizará exclusivamente en el domicilio fijado por el arrendatario para su entrega.</p>
        <br>
        <p><b>SEXTA:</b> El arrendatario queda obligado a poner toda diligencia en la conservación de las cosas y muebles alquilados, asumiendo la entera y absoluta responsabilidad de todo deterioro que éstas sufran, ya sea por su culpa o la de terceros, así como ante la ocurrencia de cualquier tipo de accidente, caso fortuito o fuerza mayor.</p>

    </div>
    <div class="contrato-2">
        <p><b>SEPTIMA:</b> En caso de que los muebles arrendados hayan sufrido desperfecto alguno debido al mal uso durante el transcurso del arriendo, el arrendatario deberá abonar el importe necesario para su reparación.</p>
        <br>
        <p><b>OCTAVA:</b> Para el supuesto que las averías o roturas que sufran los muebles impidan su reparación total, así como también en casos de hurto, robo o extravío de los muebles alquilados, el arrendatario asume la responsabilidad por el acaecimiento de dichas contingencias, debiendo abonar el valor integral de los mismos.</p>
        <br>
        <p><b>NOVENA:</b> Queda absolutamente prohibida toda cesión, transmisión o subarriendo del presente contrato en favor de terceras personas, ya sea en forma total o parcial, gratuita u onerosa, y en general bajo cualquier otro título. Este contrato es personal e intransferible.</p>
        <br>
        <p><b>DECIMA:</b> Serán causas de rescisión automática del presente contrato las siguientes:</p>
        <p>- Por la decisión unilateral por parte del arrendador.</p>
        <p>- Por renuncia expresa del arrendatario.</p>
        <p>- Por incumplimiento del arrendatario de cualquiera de las obligaciones que le son impuestas.</p>
        <p>- Por actividad ilícita del arrendatario.</p>
        <p>- Cualquier otra causa que haga imposible la relación contractual entre las partes.</p>
        <br>
        <p><b>DECIMAPRIMERA:</b> Respecto al soporte técnico de concentradores de oxígeno:</p>
        <p>-La guardia telefónica será las 24 horas todos los días.</p>
        <p>-El horario para la visita de un técnico especializado será de 10am a 18pm de lunes a viernes, exceptuando feriados.</p>
        <p>-El horario para el recambio de un equipo por algún desperfecto técnico será de 10am a 18pm de lunes a viernes, exceptuando feriados.</p>
        <p>-En caso de solicitar la asistencia presencial de un técnico en el domicilio y el equipo se encontrara funcionando correctamente, el arrendatario debe abonar esa visita. El valor será de $1.000 (mil pesos). </p>
        <span class="sub">-Teléfono de guardia 24hrs:</span>  1173673530 -Teléfonos Alternativos: 1123971434 / 1164038866</p>
        <br> 
        <br> 
        <p><b>DECIMASEGUNDA:</b> Respecto a recargas de cilindros de oxígeno:</p>
        <p> -El arrendatario deberá recargar el cilindro con oxígeno medicinal en cualquier establecimiento habilitado para dicho fin.</p>
        <p>-HH Oxigeno no realiza cargas de oxígeno medicinal ni de ningún otro tipo de gas.</p>
 
        
      
        <br>
        <p><b>DEPÓSITO DE GARANTÍA:</b> 
        <p>1- Como depósito de garantía y para responder por el incumplimiento a cualesquiera de las obligaciones, logrando un resarcimiento inmediato de montos dinerarios a su cargo, el ARRENDATARIO entrega al ARRENDADOR la suma de<b> {{$pesos}} PESOS (${{$pedido->garantia}})</b> , que no devengará intereses ni se reajustará y de cual servirá el presente de recibo suficiente. </p>
        <p>2- El ARRENDATARIO no podrá imputar este depósito de garantía a pagar alquileres u otras obligaciones devengadas mientras esté vigente el plazo contractual. </p>
        <p>3- El ARRENDADOR sólo estará obligado a devolverla al restituirse el bien mueble arrendado al ARRENDATARIO y contra el total cumplimiento por el ARRENDATARIO de sus obligaciones. </p>
        <p>4- La devolución de la misma será por el mismo medio que fue recibida.</p>
    </div>



</body>
</html>