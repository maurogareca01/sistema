<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja; 
use App\Models\Cajas;
use App\Models\CajaEntradaVarios;
use App\Models\User;
use App\Models\Garantia;
use App\Models\CajaQuincenal;
use App\Models\CajaFinal;
use App\Models\CostoFijo;
use App\Models\DesgloseActivos;
use App\Models\Pedido;
use App\Models\Finanza;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;
use Barryvdh\DomPDF\Facade as PDF;

class CajaController extends Controller
{ 
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);
    }
    
    public function verCajaEntrada(Request $request){
        $buscar=trim($request->get('buscar')); 

        $cajaEntradas=Caja::orderBy('idPedido', 'DESC')->paginate(20);
        $usuario=User::where('rol','=','admin')->get();

 
        if ($buscar){
            $cajaEntradas=Caja::where('idPedido','LIKE','%'.$buscar.'%')->paginate(10);
            return view('adminCajaEntrada',['cajaEntradas'=>$cajaEntradas,'buscar'=>$buscar,'usuario'=>$usuario]);
        }
        else{
            return view('adminCajaEntrada',['cajaEntradas'=>$cajaEntradas,'usuario'=>$usuario]); 

        } 




    }
    
    public function verCajaSalida(Request $request){
        $buscar=trim($request->get('buscar')); 

        $cajaSalidas=Cajas::orderBy('idSalida', 'DESC')->paginate(20);   
        $usuario=User::where('rol','=','admin')->get();
         
        
        if ($buscar){
            $cajaSalidas=Cajas::where('idSalida','LIKE','%'.$buscar.'%')->paginate(10);
            return view('adminCajaSalida',['cajaSalidas'=>$cajaSalidas,'buscar'=>$buscar,'usuario'=>$usuario]);
        }
        else{
            return view('adminCajaSalida',['cajaSalidas'=>$cajaSalidas,'usuario'=>$usuario]); 

        } 
    }

    public function agregarGastoSalida(Request $request){

        $request->validate([
            //reglas de validacion
            'cuenta'=>'required',
            'tipo'=>'required',
            'costo'=>'required|regex:/^[1-9]{1}\d{0,}$/',
            'descripcion'=>'required',
            'medioPago'=>'required' ,
            'tipoSalida'=>'required' ,
       ],[
            'cuenta.required'=>'El Origen del Dinero es Obligatorio',
            'tipo.required'=>'El Concepto es Obligatorio',
            'costo.required'=>'El Costo es Obligatorio',
            'costo.regex'=>'El Costo Tiene que se Mayor a 0',
            'descripcion.required'=>'El Concepto es Obligatorio',
            'medioPago.required'=>'El Medio de Pago es Obligatorio',
            'tipoSalida.required'=>'El Tipo de Salida es Obligatorio',
       ]);


        $usuario=User::find($request->cuenta);

        $cajaSalida= new Cajas;
        $cajaSalida->idUsuario=$request->cuenta;
        $cajaSalida->usuario=$request->usuario;
        $cajaSalida->cuenta=$usuario->name.' '.$usuario->apellido;
 
        $cajaSalida->tipo=$request->tipo;
        $cajaSalida->fecha=$request->fecha;
        $cajaSalida->costo=$request->costo;
        $cajaSalida->descripcion=$request->descripcion;
        $cajaSalida->medioPago=$request->medioPago;
        $cajaSalida->tipoSalida=$request->tipoSalida;

        $cajaSalida->save();

        if($request->tipo=='garantiaActivas'){

            $usuario->activos=$usuario->activos + $request->costo;
            $usuario->liquidasHoy=$usuario->liquidasHoy-$request->costo;

            $usuario->save();
        

            $usuario=User::find($request->cuenta); 
            if($usuario->liquidasHoy<=0 && is_null($usuario->fci)==false){//ACA LE DOY EL LIMITE DE LA ALERTA DE LIQUIDAS HOY
                $usuario->estado='peligro';
                $usuario->save();

            }
        } 

        return redirect('/adminCajaSalida')
        ->with('mensaje','Gasto Agregado Correctamente'); 

    }

    public function verModificarCajaSalida($id,Request $request){

        $cajaSalida=Cajas::find($id); 

        $usuario=User::where('rol','=','admin')->get();

        if($cajaSalida->tipo=='garantiaActivas'){
            return redirect('adminCajaSalida');
        }else{
            return view('formModificarCajaSalida',['cajaSalida'=>$cajaSalida,'usuario'=>$usuario]);
        }
    }

    public function modificarCajaSalida(Request $request){

        $request->validate([
            'costo'=>'required|regex:/^[1-9]{1}\d{0,}$/',
            'descripcion'=>'required',
       ],[
            'costo.required'=>'El Costo es Obligatorio',
            'costo.regex'=>'El Costo Tiene que se Mayor a 0',
            'descripcion.required'=>'El Concepto es Obligatorio',
       ]); 

        $cajaSalida=Cajas::find($request->idSalida);  
        $cajaSalida->costo=$request->costo;
        $cajaSalida->descripcion=$request->descripcion; 
        $cajaSalida->save();

         
        return redirect('/adminCajaSalida')
        ->with('mensaje2','La Salida '.$request->idSalida.' fue Modificado Correctamente');  
    }

    public function eliminarCajaSalida($id){

        $cajaSalida=Cajas::find($id);    

        /*if($cajaSalida->tipo=='garantiaActivas'){
            $usuario=User::find($cajaSalida->idUsuario);  
            $usuario->activos= $usuario->activos - $cajaSalida->costo;  
            $usuario->liquidasHoy= $usuario->liquidasHoy + $cajaSalida->costo;  
            $usuario->save();

            $usuario=User::find($cajaSalida->idUsuario);  

            if($usuario->liquidasHoy>0){
                $usuario->estado='ok';
                $usuario->save();
            }

        }*/
        if($cajaSalida->tipo=='garantiaActivas'){
            return redirect('adminCajaSalida');
        }else{ 
            $cajaSalida->delete();

            return redirect('/adminCajaSalida')
            ->with('mensaje3','El Gasto  '.$id. ' fue Eliminado Correctamente');  
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function verCajaEntradaV(Request $request){
        $buscar=trim($request->get('buscar')); 

        $cajaEntradaV=CajaEntradaVarios::orderBy('idEntradaVarios', 'DESC')->paginate(20);
        $usuario=User::where('rol','=','admin')->get();
        


        if ($buscar){
            $cajaEntradaV=CajaEntradaVarios::where('idEntradaVarios','LIKE','%'.$buscar.'%')->paginate(10);
            return view('adminCajaEntradaV',['cajaEntradaV'=>$cajaEntradaV,'buscar'=>$buscar,'usuario'=>$usuario]);
        }
        else{
            return view('adminCajaEntradaV',['cajaEntradaV'=>$cajaEntradaV,'usuario'=>$usuario]);  

        }  
    }

    public function agregarGastoEntrada(Request  $request){ 
        $request->validate([ 
            'fecha'=>'required',
            'usuario'=>'required',
            'cuenta'=>'required',
            'dineroEntrada'=>'required|regex:/^[0-9]+([\,\.][0-9]+)?$/',
            'medioCobro'=>'required',
            'descripcion'=>'required',    
            'costoEnvio'=>'regex:/^[0-9]+([\,\.][0-9]+)?$/|nullable',

       ],[
            'usuario.required'=>'El Usuario es Obligatorio',
            'cuenta.required'=>'La Cuenta es Obligatoria',
            'dineroEntrada.required'=>'El Dinero de Entrada es Obligatorio',
            'dineroEntrada.regex'=>'El Dinero de Entrada es Incorrecto',
            'medioCobro.required'=>'El Medio de Cobro es Obligatorio',
            'descripcion.required'=>'La Descripcion es Obligatoria',  
            'costoEnvio.regex'=>'El Costo Envio es Incorrecto',
       ]);
  


       $cajaEntrada= new CajaEntradaVarios();

       $cajaEntrada->fecha=$request->fecha;

       $usuario=User::find($request->usuario); 
       $cajaEntrada->usuario=$usuario->name.' '.$usuario->apellido;
       $usuario=User::find($request->cuenta); 
       $cajaEntrada->cuenta=$usuario->name.' '.$usuario->apellido;

       $cajaEntrada->dineroEntrada=$request->dineroEntrada;
       $cajaEntrada->medioCobro=$request->medioCobro;
       $cajaEntrada->descripcion=$request->descripcion; 
    
       if(is_null($request->costoEnvio)){
            $cajaEntrada->costoEnvio=0;
       }else{
            $cajaEntrada->costoEnvio=$request->costoEnvio;
       }

       $cajaEntrada->total=$request->costoEnvio + $request->dineroEntrada;

       $cajaEntrada->save();

        ////////////CARGA DE CAJA QUINCENAL-entrada de dinero de ENTRADA VARIOS//////

       $cajaQuincenal=new CajaQuincenal(); 
       $usuario=User::find($request->cuenta);  

       $cajaQuincenal->idUsuario=$request->cuenta;
       $cajaQuincenal->Usuario=$usuario->name.' '.$usuario->apellido; 
       $cajaQuincenal->fecha=$request->fecha; 
       $cajaQuincenal->dinero=$request->costoEnvio + $request->dineroEntrada;
       $cajaQuincenal->descripcion='Entrada - Varios: '.$request->descripcion;
       $cajaQuincenal->medioDePago=$request->medioCobro;
       $cajaQuincenal->tipo='entradaVarios';
       $cajaQuincenal->save();


       return redirect('/adminCajaEntradaV')
       ->with('mensaje','Agregado Correctamente'); 

    }

    public function formModificarCajaEntradaV($id){
        $cajaEntradaV=CajaEntradaVarios::find($id);
        $usuario=User::where('rol','=','admin')->get();

        return view('formModificarCajaEntradaV',['cajaEntradaV'=>$cajaEntradaV,'usuario'=>$usuario]);
    }
    public function modificarCajaEntradaV(Request $request){

        $request->validate([  
            'usuario'=>'required',
            'cuenta'=>'required',
            'dineroEntrada'=>'required|regex:/^[0-9]+([\,\.][0-9]+)?$/',
            'medioCobro'=>'required',
            'descripcion'=>'required',  
            'costoEnvio'=>'regex:/^[0-9]+([\,\.][0-9]+)?$/|nullable',

       ],[
            'usuario.required'=>'El Usuario es Obligatorio',
            'cuenta.required'=>'La Cuenta es Obligatoria',
            'dineroEntrada.required'=>'El Dinero de Entrada es Obligatorio',
            'dineroEntrada.regex'=>'El Dinero de Entrada es Incorrecto',
            'medioCobro.required'=>'El Medio de Cobro es Obligatorio',
            'descripcion.required'=>'La Descripcion es Obligatoria', 
            'costoEnvio.regex'=>'El Costo Envio es Incorrecto',
       ]);

        $cajaEntradaV=CajaEntradaVarios::find($request->idEntradaV);
        
        $cajaEntradaV->usuario=$request->usuario;
        $cajaEntradaV->cuenta=$request->cuenta;
        $cajaEntradaV->dineroEntrada=$request->dineroEntrada;
        $cajaEntradaV->medioCobro=$request->medioCobro;
        $cajaEntradaV->descripcion=$request->descripcion;
        $cajaEntradaV->costoEnvio=$request->costoEnvio;
        $cajaEntradaV->total=$request->costoEnvio+$request->dineroEntrada;
        
        $cajaEntradaV->save();


        return redirect('/adminCajaEntradaV')
        ->with('mensaje2','La Entrada '.$request->idEntradaV.' fue Modificada Correctamente');  
    }
    public function eliminarCajaEntradaV($id){

        $cajaEntradaV=CajaEntradaVarios::find($id);   
        $cajaEntradaV->delete();

        return redirect('/adminCajaEntradaV')
        ->with('mensaje3','La Entrada '.$id. ' fue Eliminada Correctamente');  

    }

    public function CajaSalidaVerUsuarioConGarantia(Request $request){
    
        $usuario=User::find($request->cuentaId);

        if($usuario->liquidasHoy){
            $res=true; 
        }else{
            $res=false;
        }
        $tipo=$usuario->tipo;
        $liquidasHoy=$usuario->liquidasHoy;



        $array=[
            'res'=>$res, 
            'tipo'=>$tipo,
            'liquidasHoy'=>$liquidasHoy
        ];

       return response(json_encode($array),200)->header('Content-type','text/plain');
        
    }
    
    ///////////////////////////////////////////////////////

    public function verCaja(Request $request){
            $caja=CajaFinal::get();

            foreach($caja as $caj){
                 

                $ingresoExtraLogistica=CajaQuincenal::where('tipo','LIKE','envio')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero');
                
                $ingresoFinanzas=CajaQuincenal::where('tipo','LIKE','finanzas')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero');

                $ingresoOxigeno=CajaQuincenal::Where('tipo','LIKE','alquiler')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero'); 
                $ingresoRenovacion=CajaQuincenal::Where('tipo','LIKE','renovacion')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero'); 

                $ingresoAlquiler=$ingresoOxigeno + $ingresoRenovacion;

                $ingresoGarantia=CajaQuincenal::Where('tipo','LIKE','garantia')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero'); 

                $ingresoEntrada=CajaQuincenal::Where('tipo','LIKE','entradaVarios')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero');  
                
                $ingresoNeto=$ingresoExtraLogistica + $ingresoFinanzas + $ingresoAlquiler +  $ingresoEntrada + $ingresoGarantia;

                $comprasEquipos=Cajas::where('tipoSalida','LIKE','compraEquipo')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('costo');  
                
                $gastosNetos=Cajas::where('tipoSalida','LIKE','otros')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('costo'); 

                $desgloseActivos=DesgloseActivos::
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero'); 

                $sueldos=User::sum('sueldo');
                $costoFijo=CostoFijo::sum('valor');

                $gastosNetos=$gastosNetos + $sueldos + $costoFijo;

                $gastosNetos=$gastosNetos + $desgloseActivos;
                $gastosTotales=$comprasEquipos + $gastosNetos;
                $totalNeto=$ingresoNeto - $gastosTotales;

                $cajaBanco=CajaQuincenal::Where('idUsuario','<>',1)->
                Where('medioDePago','<>','Efectivo')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero'); 

                $cajaHH=CajaQuincenal::Where('idUsuario','LIKE',1)->
                Where('medioDePago','LIKE','Efectivo')->
                whereDate('fecha','>=',$caj->inicioCierre)->
                whereDate('fecha','<=',$caj->finalCierre)->
                sum('dinero');  




                $caj->ingresoNeto=$ingresoNeto;
                $caj->ingresoExtraLogistica=$ingresoExtraLogistica;
                $caj->ingresoFinanzas=$ingresoFinanzas;
                $caj->ingresoOxigeno=$ingresoAlquiler;
                $caj->comprasEquipos=$comprasEquipos;
                $caj->gastosNetos=$gastosNetos;
                $caj->gastosTotales=$gastosTotales;
                $caj->totalNeto=$totalNeto;
                $caj->cajaBanco=$cajaBanco;
                $caj->cajaHH=$cajaHH;
                $caj->celda=$cajaBanco + $cajaHH - $totalNeto; 

                $caj->save();
                 

            }
            $caja=CajaFinal::orderBy('idCaja', 'DESC')->paginate();
            return view('adminCaja',['caja'=>$caja]);  

    } 

    public function agregarCierre(Request $request){
         $request->validate([
            //reglas de validacion
            'inicioCierre'=>'required',
            'finalCierre'=>'required',  
       ],[
            'inicioCierre.required'=>'La Fecha es Obligatoria',
            'finalCierre.required'=>'La Fecha es Obligatoria',  
       ]);
        
        $caja=new CajaFinal(); 
        $caja->inicioCierre=$request->inicioCierre;
        $caja->finalCierre=$request->finalCierre;
        $caja->save();

          
        return redirect('/adminCaja')
        ->with('mensaje','Cierre Agregado Correctamente');   
        
    }


    //////////////////////////////////////////////////////////////
    public function cambiarEstadoFactura($id,Request $request){
        if($request->tipoCaja=='cajaEntrada'){
            $cajaEntrada=Caja::find($id);
            
            if($request->faturado=='Si'){
                $cajaEntrada->facturado='No';
                $cajaEntrada->save();

                return redirect('adminCajaEntrada')
                ->with('mensaje4','La Entrada N° ' .$id. '  No ha sido Facturada');
            }else{
                $cajaEntrada->facturado='Si'; 

                $cajaEntrada->save();

                return redirect('adminCajaEntrada')
                ->with('mensaje4','La Entrada N° ' .$id. '  ha sido Facturada');
            }
        }elseif($request->tipoCaja=='cajaEntradaVarios'){
        
            $CajaEntradaVarios=CajaEntradaVarios::find($id);
            
            if($request->faturado=='Si'){
                $CajaEntradaVarios->facturado='No';
                $CajaEntradaVarios->save();

                return redirect('adminCajaEntradaV')
                ->with('mensaje4','La Entrada N° ' .$id. '  No ha sido Facturada');
            }else{
                $CajaEntradaVarios->facturado='Si'; 

                $CajaEntradaVarios->save();

                return redirect('adminCajaEntradaV')
                ->with('mensaje4','La Entrada N° ' .$id. '  ha sido Facturada');
            }
        }


        
        
    }


    //////////////////////////////////////////////////////////////

    public function verInformeCaja($fechaInicio,$fechaFinal){ 

        $caja=CajaQuincenal::
                whereDate('fecha','>=',$fechaInicio)->
                whereDate('fecha','<=',$fechaFinal)->get();

        $cajas=Cajas::
        whereDate('fecha','>=',$fechaInicio)->
        whereDate('fecha','<=',$fechaFinal)->get();

        $pdf=PDF::loadView('verInformeCaja',compact('caja','cajas','fechaInicio','fechaFinal',));
        
        return $pdf->stream();
         
    }
    
    public function cambiarFechaCajaFinal($id,Request $request){
        
        $request->validate([
            //reglas de validacion
            'inicio'=>'required',
            'final'=>'required',  
       ],[
            'inicio.required'=>'La Fecha es Obligatoria',
            'final.required'=>'La Fecha es Obligatoria',  
       ]);
        
        $caja=CajaFinal::find($id); 
        $caja->inicioCierre=$request->inicio;
        $caja->finalCierre=$request->final;
        $caja->save();

        return redirect('/adminCaja')
        ->with('mensaje4','Cierre Modificado Correctamente');   
        
 
    }
    public function eliminarCajaFinal($id){
        $caja=CajaFinal::find($id);   
        $caja->delete();

        return redirect('/adminCaja')
        ->with('mensaje5','El Cierre fue Eliminada Correctamente');  

    }

    
}
