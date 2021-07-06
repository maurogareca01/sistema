 
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto-Alquiler-{{$pedido->idPedido}}</title>

    <link rel="stylesheet" href="css/estilo-pdf.css">
      
</head> 
<body>
    
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
                            S-{{$pedido->idServicio}} 
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
      

    
</body>
</html>