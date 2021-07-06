@php 
    require '../vendor/autoload.php';
    
    use Luecano\NumeroALetras\NumeroALetras;
@endphp
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Caja</title>

    <link rel="stylesheet" href="css/estilo-pdf.css">
      
</head> 
<body>
    @php    
        $originalDate = $fechaInicio;
        $fechaInicio = date("d/m/Y", strtotime($originalDate)); 
        
        $originalDate = $fechaFinal;
        $fechaFinal = date("d/m/Y", strtotime($originalDate)); 
    @endphp
      
    <div class="conetenido-tabla">
        <h2>{{ $fechaInicio }} &nbsp; -- &nbsp; {{ $fechaFinal }}</h2>
        
        <h1>INFORME DE ENTRADAS</h1>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Concepto</th>
                    <th>Persona</th>
                    <th>Medio De Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($caja as $caj)
                    <tr>
                        @php 
                            $originalDate = $caj->fecha;
                            $fecha = date("d/m/Y", strtotime($originalDate)); 
                        @endphp
                        <td>{{ $fecha }}</td> 
                        <td>{{ $caj->dinero }}</td> 
                        <td>{{ $caj->descripcion }}</td> 
                        <td>{{ $caj->Usuario }}</td> 
                        <td class="{{  
                                $caj->medioDePago=='Bank' ? 'bank': 
                                ($caj->medioDePago =='Mercado Pago' ? 'mp' : 
                                ($caj->medioDePago =='Uala' ? 'mp' : 'efectivo'))
                                }} ">
                                {{ $caj->medioDePago }}
                        </td> 
                    </tr>
                @endforeach    
            </tbody> 
        </table>
        <br>
        <br>
        <br>
        <h1>INFORME DE SALIDAS</h1>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Salida</th>
                    <th>Concepto</th>
                    <th>Persona</th>
                    <th>Medio De Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cajas as $caj)
                    <tr>
                        @php 
                            $originalDate = $caj->fecha;
                            $fecha = date("d/m/Y", strtotime($originalDate)); 
                        @endphp
                        <td>{{ $fecha }}</td> 
                        <td>{{ $caj->costo }}</td> 
                        <td>{{ $caj->descripcion }}</td> 
                        <td>{{ $caj->cuenta }}</td> 
                        <td class="{{  
                                $caj->medioPago=='Bank' ? 'bank': 
                                ($caj->medioPago =='Mercado Pago' ? 'mp' : 
                                ($caj->medioPago =='Uala' ? 'mp' : 'efectivo'))
                                }} ">
                                {{ $caj->medioPago }}
                        </td> 
                    </tr>
                @endforeach    
            </tbody> 
        </table>
    </div>
    
</body>
</html>