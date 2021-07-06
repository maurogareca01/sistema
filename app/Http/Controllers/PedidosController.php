<?php

namespace App\Http\Controllers;

use App\Jobs\EnvioContratoPresupuestoJobs;
use App\Models\Pedido; 
use App\Models\Servicio;
use App\Models\Dispoequipos;
use App\Models\Dispotubos;
use App\Models\Dispooximetros;
use App\Models\Equipo;
use App\Models\Tubo;
use App\Models\Oximetro;
use App\Models\Registro;
use App\Models\Calendario;
use App\Models\Garantia;
use App\Models\Finanza;
use App\Models\Caja;
use App\Models\CajaQuincenal;
use App\Models\Rentabilidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;
use Hamcrest\Core\IsNull;
use Luecano\NumeroALetras\NumeroALetras; 

use Illuminate\Support\Facades\Mail; 
use App\Mail\EnvioContratoPresupuesto;

class PedidosController extends Controller
{

    public function __construct()
    {

       $this->middleware(['auth','roles:admin,administrador,logistica']); 
        
    }

    
/*
    public function verAlquiler(Request $request){
        $id=$request->id;
        $pedido=Pedido::find($id); 

        $array=[
            'pedido'=>$pedido,  
        ]; 

        return response(json_encode($array),200)->header('Content-type','text/plain');
         
    }*/

    public function listarPedidos(Request $request)
    {    
        $buscar=trim($request->get('buscar'));


        if(Auth::user()->rol=='logistica'){
            $id=Auth::user()->id; 

            $pedidos=Pedido::Where('idLogisticaE', 'LIKE',$id)->
            Where(function($query){ 
                $query->Where('estadoPedido','Entrega'); 
            })->
            orWhere('idLogisticaR', 'LIKE',$id)-> 
            Where(function($query){ 
                $query->Where('estadoPedido','Retirar');
            })->paginate(20);


            if ($buscar){

                $pedidos=Pedido::Where('idPedido', 'LIKE',$buscar)-> 
                Where(function($query){ 
                    $id=Auth::user()->id; 

                    $query->Where('idLogisticaE', 'LIKE',$id)->
                    orWhere('idLogisticaR', 'LIKE',$id);

                })->Where(function($query){  
                    $query->Where('estadoPedido','Retirar')-> 
                    orWhere('estadoPedido','Entrega');  
  
                })->paginate(20);
    
                 
                

                return view('adminPedidos',['pedidos'=>$pedidos,'buscar'=>$buscar]);

            }else{
                return view('adminPedidos',['pedidos'=>$pedidos]);

            }



        }else{


            $Hoy= strtotime(date("d-m-Y"));
            $pedi=Pedido::where('estadoPedido','LIKE','Entregado')->get();
            foreach($pedi as $ped){
                $fecha= strtotime($ped->fechaFin);
                if($Hoy>=$fecha){
                    $ped->estadoPedido='Vencido';
                    $ped->save();
                }
            } 

            $pedidos = Pedido::where('estadoPedido','<>','Archivado')->orderBy('idPedido', 'DESC')->paginate(14);
            $servicios=Servicio::get();
            $rentab=Rentabilidad::get();
            $usuarios=User::get();

            if ($buscar){
                $pedido=Pedido::where('idPedido','LIKE','%'.$buscar.'%')
                ->orwhere('dni','LIKE',$buscar)
                ->orwhere('telefono','LIKE',$buscar)
                ->orwhere('direccion','LIKE','%'.$buscar.'%')
                ->orwhere('nombreCliente','LIKE','%'.$buscar.'%')->count();

                $pedidos=Pedido::where('idPedido','LIKE','%'.$buscar.'%')
                ->orwhere('dni','LIKE',$buscar)
                ->orwhere('telefono','LIKE',$buscar)
                ->orwhere('direccion','LIKE','%'.$buscar.'%')
                ->orwhere('nombreCliente','LIKE','%'.$buscar.'%')->orderBy('idPedido', 'DESC')->paginate(14);

                
                if($pedido>0){
                    return view('adminPedidos',['pedidos'=>$pedidos,'buscar'=>$buscar,'servicios'=>$servicios]); 
                }else{
                    if($request->buscarBandera){
                        $mensaje2='El Alquiler No se Encontro';
                        return view('panel',['pedidos'=>$pedidos,'servicios'=>$servicios,'mensaje2'=>$mensaje2,'rentab'=>$rentab,'usuarios'=>$usuarios]); 
                    }else{
                        return view('adminPedidos',['pedidos'=>$pedidos,'buscar'=>$buscar,'servicios'=>$servicios]);
                    }
                }
            }
            else{
                if($request->buscarBandera){
                    $mensaje2='El Alquiler No se Encontro';
                    return view('panel',['pedidos'=>$pedidos,'servicios'=>$servicios,'mensaje2'=>$mensaje2,'rentab'=>$rentab,'usuarios'=>$usuarios]); 
                }else{
                    return view('adminPedidos',['pedidos'=>$pedidos,'buscar'=>$buscar,'servicios'=>$servicios]);
                }
            }
        }
    }
    public function listarPedidosArchivados(Request $request){

        $buscar=trim($request->get('buscar'));
        if ($buscar){
            $pedidos=Pedido::where('idPedido','LIKE','%'.$buscar.'%')
            ->where('estadoPedido','LIKE','Archivado')
            ->paginate();
            return view('adminPedidosArchivados',['pedidos'=>$pedidos,'buscar'=>$buscar]);

        }else{
            $pedidos=Pedido::where('estadoPedido','=','Archivado')->paginate();
            return view('adminPedidosArchivados',['pedidos'=>$pedidos]);

        }    
        

    }
    public function listaServicio(Request $request){
         $idserv=$request->idserv;

        $dispoER=$request->dispoER;
        $dispoEA=$request->dispoEA;
        $dispoEY=$request->dispoEY;
        $dispoT1=$request->dispoT1;
        $dispoT415=$request->dispoT415;
        $dispoO=$request->dispoO; 
        
          
        $servi=Servicio::find($idserv);
        $servER=Dispoequipos::find(1);
        $servEA=Dispoequipos::find(2);
        $servEY=Dispoequipos::find(3);
        $servT1=Dispotubos::find(1);
        $servT415=Dispotubos::find(2);
        $servO=Dispooximetros::find(1);
         
        $elegirER=Equipo::where('nombre','LIKE','Respironics')->get();
        $elegirEA=Equipo::where('nombre','LIKE','Airsep')->get();
        $elegirEY=Equipo::where('nombre','LIKE','Yuwell')->get();
        $elegirT680L=Tubo::where('descripcion','LIKE','680L')->get();
        $elegirT415L=Tubo::where('descripcion','LIKE','415L')->get();
        $elegirO=Oximetro::get();
 
        $array=[
            'servi'=>$servi,
            'servER'=>$servER,
            'servEA'=>$servEA,
            'servEY'=>$servEY,
            'servT1'=>$servT1,
            'servT415'=>$servT415,
            'servO'=>$servO,

            'elegirER'=>$elegirER,
            'elegirEA'=>$elegirEA,
            'elegirEY'=>$elegirEY,
            'elegirT680L'=>$elegirT680L,
            'elegirT415L'=>$elegirT415L,
            'elegirO'=>$elegirO,
        ];
 

        return response(json_encode($array),200)->header('Content-type','text/plain');
        
    }

    public function agregarPedido(Request $request) {           
         

        $request->validate([
             //reglas de validacion
            'idServicio'=>'required',
            'costoEnvio'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',
            'medioPagoAlquiler'=>'required',
            'nombreCliente'=>'required',
            'dni'=>'required|regex:/^[1-9]{1}\d{0,}$/',
            'direccion'=>'required',
            'localidad'=>'required',
            'telefono'=>'required|regex:/^[1-9]{1}\d{0,}$/',
            'fechaInicio'=>'required',
            'recibe'=>'required',
            'dias'=>'required', 
            'NumeroDispoER'=>'required', 
            'NumeroDispoEA'=>'required',
            'NumeroDispoEY'=>'required',
            'NumeroDispoT1'=>'required',
            'NumeroDispoT415'=>'required',
            'NumeroDispoO'=>'required', 
        ],[
            'idServicio.required'=>'El Servicio es Obligatorio',
            'costoEnvio.regex'=>'El Costo de Envio Incorrecto',
            'medioPagoAlquiler.required'=>'El Medio de Pago es Obligatorio',
            'nombreCliente.required'=>'El Nombre del Cliente es Obligatorio',
            'dni.required'=>'El Dni es Obligatorio',
            'dni.regex'=>'El Dni es Incorrecto',
            'direccion.required'=>'La Direccion es Obligatoria',
            'localidad.required'=>'La Localidad es Obligatoria',
            'telefono.required'=>'El Telefono es Obligatorio',
            'telefono.regex'=>'El Telefono es Incorrecto',
            'fechaInicio.required'=>'La Fecha de Inicio es Obligatoria',
            'recibe.required'=>'Recibe es Obligatorio',
            'dias.required'=>'Los Mes/Meses es/son Obligatorio',
            'NumeroDispoER.required'=>'Seleccione el/los Numero/s de Equipo/s', 
            'NumeroDispoEA.required'=>'Seleccione el/los Numero/s de Equipo/s',
            'NumeroDispoEY.required'=>'Seleccione el/los Numero/s de Equipo/s',
            'NumeroDispoET1.required'=>'Seleccione el/los Numero/s de Equipo/s',
            'NumeroDispoET415.required'=>'Seleccione el/los Numero/s de Equipo/s',
            'NumeroDispoO.required'=>'Seleccione el/los Numero/s de Equipo/s', 
        ]);

        $costoEnvio=0;  
        $pedido=new Pedido();

        $pedido->idServicio=$request->idServicio;  
        $pedido->usuario=$request->usuario; 
        $pedido->nombreServ=$request->nombreServ;
        $pedido->descripcion=$request->descripcion;
        $pedido->costoServ=$request->costoServ;
        $pedido->garantia=$request->garantia;
        $pedido->imgServ=$request->imgServ; 
        if($request->costoEnvio){
            $costoEnvio=$request->costoEnvio;
        }   

         
        $pedido->costoEnvio=$costoEnvio; 
        $pedido->medioPagoAlquiler=$request->medioPagoAlquiler;
        if($request->medioPagoGarantia){
            $pedido->medioPagoGarantia=$request->medioPagoGarantia;
        }else{
            $pedido->medioPagoGarantia="A Confirmar";
        }

        if($request->medioPagoEnvio){
            $pedido->medioPagoEnvio=$request->medioPagoEnvio;
        }else{
            $pedido->medioPagoEnvio="No Se Cobra";
        }
        $nombreCliente=strtolower($request->nombreCliente); //CONVIERTE TODO A MINUSUCLAS
        $nombreCliente= ucwords($nombreCliente);//Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.
        $pedido->nombreCliente=$nombreCliente;

        $pedido->dni=$request->dni;
        $pedido->direccion=$request->direccion;
        $pedido->localidad=$request->localidad;
        $pedido->telefono=$request->telefono;
        
        //CODIGO PHP PARA INVERTIR LA FECHAS Y MOSTRARLAS-->
        $originalDate = $request->fechaInicio;
        $fechaInicio = date("d-m-Y H:i", strtotime($originalDate)); 
        $pedido->fechaInicio=$fechaInicio;
        
        $pedido->fechaFin=$request->fechaFin;
        $pedido->fechaRetiro=$request->fechaFin;
 
        if($request->dias==15){
            $pedido->dias=$request->dias;
            $pedido->meses=0.5;

        }else{
            $pedido->dias=$request->dias * 30;
            $pedido->meses=$request->dias;
        } 
        $pedido->recibe=$request->recibe;
        $pedido->email=$request->email;

        $pedido->pdfContrato="s/n";
        $pedido->pdfRemito="s/n";
        $pedido->pdfPresupuesto="s/n";

        $pedido->imgDniF="noDispo.jpg";
        $pedido->imgDniD="noDispo.jpg";
        $pedido->imgOrden="noDispo.jpg";


        $pedido->comentarios=$request->comentarios;
        $pedido->estadoPedido="Espera";


        if($request->dispoER==1){
            /*
            $equipo=Equipo::where('nombre','LIKE','Respironics')->
                            where('estado','LIKE','Disponible')->first();
            //dd($equipo);
            if($equipo==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            }             
            $idE=$equipo->idEquipo;  

            $E=Equipo::where('idEquipo','LIKE',$idE)->update(['estado'=>'Reservado']);*/ 
 
            $equipoER=Equipo::where('idEquipo','LIKE',$request->NumeroDispoER)->update(['estado'=>'Reservado']);
            $pedido->dispoER=$request->NumeroDispoER; 

        }else{
            $pedido->dispoER=$request->dispoER;
        }

        if($request->dispoEA==1){
            /*
            $equipo=Equipo::where('nombre','LIKE','Airsep')->
                            where('estado','LIKE','Disponible')->first();
            if($equipo==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            }                 
            $idE=$equipo->idEquipo;

            $E=Equipo::where('idEquipo','LIKE',$idE)->update(['estado'=>'Reservado']);
            */
            $equipoEA=Equipo::where('idEquipo','LIKE',$request->NumeroDispoEA)->update(['estado'=>'Reservado']);
            $pedido->dispoEA=$request->NumeroDispoEA; 

        }else{
            $pedido->dispoEA=$request->dispoEA;
        }

        if($request->dispoEY==1){
            /*$equipo=Equipo::where('nombre','LIKE','Yuwell')->
                            where('estado','LIKE','Disponible')->first();
            if($equipo==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            }                 
            $idE=$equipo->idEquipo;

            $E=Equipo::where('idEquipo','LIKE',$idE)->update(['estado'=>'Reservado']);
            */
             
            $equipoEY=Equipo::where('idEquipo','LIKE',$request->NumeroDispoEY)->update(['estado'=>'Reservado']);
            $pedido->dispoEY=$request->NumeroDispoEY; 
        }else{
            $pedido->dispoEY=$request->dispoEY;
        }

        if($request->dispoT1==1){
            /*
            $tuboT1=Tubo::where('descripcion','LIKE','680L')->
                          where('estado','LIKE','Disponible')->first(); 
            if($tuboT1==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            } 
            $idT1=$tuboT1->idTubo;             
             
            $T1R=Tubo::where('idTubo','LIKE',$idT1)->update(['estado'=>'Reservado']);
            */

            $equipoT1=Tubo::where('idTubo','LIKE',$request->NumeroDispoT1)->update(['estado'=>'Reservado']);
            $pedido->dispoT1=$request->NumeroDispoT1; 

        }else{
            $pedido->dispoT1=$request->dispoT1;
        }

        if($request->dispoT415==1){
           /* $tuboT415=Tubo::where('descripcion','LIKE','415L')->
                          where('estado','LIKE','Disponible')->first();  
            if($tuboT415==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            } 
            $idT415=$tuboT415->idTubo;

            $T415R=Tubo::where('idTubo','LIKE',$idT415)->update(['estado'=>'Reservado']);
            */  

            $equipoT415=Tubo::where('idTubo','LIKE',$request->NumeroDispoT415)->update(['estado'=>'Reservado']);
            $pedido->dispoT415=$request->NumeroDispoT415; 
        }else{
            $pedido->dispoT415=$request->dispoT415;
        }

        if($request->dispoO==1){
            /*
            $oximetro=Oximetro::where('estado','LIKE','Disponible')->first();   
            if($oximetro==null){
                return redirect('/adminPedidos')
                ->with('mensaje5','No se pudo Agregar Por Falta de Stock'); 
            } 
            $idO=$oximetro->idOximetro; 

            $OR=Oximetro::where('idOximetro','LIKE',$idO)->update(['estado'=>'Reservado']);
            */    

            $equipoO=Oximetro::where('idOximetro','LIKE',$request->NumeroDispoO)->update(['estado'=>'Reservado']);
            $pedido->dispoO=$request->NumeroDispoO; 

        }else{
            $pedido->dispoO=$request->dispoO;
            
        }
            
        $pedido->save();
        

        if($request->origen){ 
            return redirect('/')
            ->with('mensaje','Alquiler Agregado Correctamente');  
        }

        return redirect('/adminPedidos')
            ->with('mensaje','Alquiler Agregado Correctamente');  
 
    }
    public function verModificarPedido($id){
        
        $servicios=Servicio::get();
        $pedido =Pedido::find($id);

        $idServPedido=$pedido->idServicio;

        $serviPedido=Servicio::find($idServPedido); 
         
        

        $elegirER=Equipo::where('nombre','LIKE','Respironics')->get();
        $elegirEA=Equipo::where('nombre','LIKE','Airsep')->get();
        $elegirEY=Equipo::where('nombre','LIKE','Yuwell')->get();
        $elegirT680L=Tubo::where('descripcion','LIKE','680L')->get();
        $elegirT415L=Tubo::where('descripcion','LIKE','415L')->get();
        $elegirO=Oximetro::get();

        return view('formModificarPedido',['pedido'=>$pedido,'servicios'=>$servicios,'elegirER'=>$elegirER,'elegirEA'=>$elegirEA,'elegirEY'=>$elegirEY,'elegirT680L'=>$elegirT680L,'elegirT415L'=>$elegirT415L,'elegirO'=>$elegirO,'serviPedido'=>$serviPedido]);

    }
     
    public function modificarPedido(Request $request){ 
        
          
        $request->validate([
            //reglas de validacion
           'idServicio'=>'required',
           'costoEnvio'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',
           'medioPagoAlquiler'=>'required',
           'nombreCliente'=>'required',
           'dni'=>'required|regex:/^[1-9]{1}\d{0,}$/',
           'direccion'=>'required',
           'localidad'=>'required',
           'telefono'=>'required|regex:/^[1-9]{1}\d{0,}$/',
           'fechaInicio'=>'required',
           'recibe'=>'required',
           'dias'=>'required',   
        ],[
            'idServicio.required'=>'El Servicio es Obligatorio',
            'costoEnvio.regex'=>'El Costo de Envio Incorrecto',
            'medioPagoAlquiler.required'=>'El Medio de Pago es Obligatorio',
            'nombreCliente.required'=>'El Nombre del Cliente es Obligatorio',
            'dni.required'=>'El Dni es Obligatorio',
            'dni.regex'=>'El Dni es Incorrecto',
            'direccion.required'=>'La Direccion es Obligatoria',
            'localidad.required'=>'La Localidad es Obligatoria',
            'telefono.required'=>'El Telefono es Obligatorio',
            'telefono.regex'=>'El Telefono es Incorrecto',
            'fechaInicio.required'=>'La Fecha de Inicio es Obligatoria',
            'recibe.required'=>'Recibe es Obligatorio',
            'dias.required'=>'Los Mes/Meses es/son Obligatorio', 
        ]);

        $pedido=Pedido::find($request->idPedido); 
        //dd($pedido->dispoER ,$request->NumeroDispoER);

        if($pedido->dispoER != 0){
            $equipo=Equipo::find($pedido->dispoER);
            $equipo->estado='Disponible';
            $equipo->save();
            $pedido->dispoER=0;
        }
        if($pedido->dispoEA != 0){
            $equipo=Equipo::find($pedido->dispoEA);
            $equipo->estado='Disponible';
            $equipo->save();
            $pedido->dispoEA=0;
        }
        if($pedido->dispoEY != 0){
            $equipo=Equipo::find($pedido->dispoEY);
            $equipo->estado='Disponible';
            $equipo->save();
            $pedido->dispoEY=0;
        }
        if($pedido->dispoT1 != 0){
            $tubo=Tubo::find($pedido->dispoT1);
            $tubo->estado='Disponible';
            $tubo->save();
            $pedido->dispoT1=0;
        }
        if($pedido->dispoT415 != 0){
            $tubo=Tubo::find($pedido->dispoT415);
            $tubo->estado='Disponible';
            $tubo->save();
            $pedido->dispoT415=0;
        }
        if($pedido->dispoO != 0){
            $oximetro=Oximetro::find($pedido->dispoO);
            $oximetro->estado='Disponible';
            $oximetro->save();
            $pedido->dispoO=0;
        }
        //***** ****** ****** ****** ****** ****** ****** */
        if($request->NumeroDispoER != 0){
            $equipo=Equipo::find($request->NumeroDispoER);
            if($pedido->estadoPedido=='Espera'){ 
                $equipo->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $equipo->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $equipo->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $equipo->estado='Por Retirar'; 
            }
            $equipo->save(); 
            $pedido->dispoER=$request->NumeroDispoER;
        }
        if($request->NumeroDispoEA != 0){
            $equipo=Equipo::find($request->NumeroDispoEA);
            if($pedido->estadoPedido=='Espera'){ 
                $equipo->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $equipo->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $equipo->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $equipo->estado='Por Retirar'; 
            }
            $equipo->save(); 
            $pedido->dispoEA=$request->NumeroDispoEA;
        }
        if($request->NumeroDispoEY != 0){
            $equipo=Equipo::find($request->NumeroDispoEY);
            if($pedido->estadoPedido=='Espera'){ 
                $equipo->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $equipo->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $equipo->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $equipo->estado='Por Retirar'; 
            }
            $equipo->save(); 
            $pedido->dispoEY=$request->NumeroDispoEY;
        }
        if($request->NumeroDispoT1 != 0){
             
            $equipo=Equipo::find($request->NumeroDispoT1);
            if($pedido->estadoPedido=='Espera'){ 
                $equipo->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $equipo->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $equipo->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $equipo->estado='Por Retirar'; 
            }
            $equipo->save(); 
            $pedido->dispoT1=$request->NumeroDispoT1;
        } 
        if($request->NumeroDispoT415 != 0){
            $equipo=Equipo::find($request->NumeroDispoT415);
            if($pedido->estadoPedido=='Espera'){ 
                $equipo->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $equipo->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $equipo->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $equipo->estado='Por Retirar'; 
            }
            $equipo->save(); 
            $pedido->dispoT415=$request->NumeroDispoT415;
        }
        if($request->NumeroDispoO != 0){

            $oximetro=Oximetro::find($request->NumeroDispoO);
            if($pedido->estadoPedido=='Espera'){ 
                $oximetro->estado='Reservado'; 
            }elseif($pedido->estadoPedido=='Entrega'){ 
                $oximetro->estado='Por Entregar'; 
            }elseif($pedido->estadoPedido=='Entregado'){ 
                $oximetro->estado='En Uso';
            } elseif($pedido->estadoPedido=='Retirar'){
                $oximetro->estado='Por Retirar'; 
            }
            $oximetro->save(); 
            $pedido->dispoO=$request->NumeroDispoO;
           
        }
 
        $pedido->idServicio=$request->idServicio; 
        $pedido->descripcion=$request->descripcion;
        $pedido->nombreServ=$request->nombreServ;
        $pedido->costoServ=$request->costoServ;
        $pedido->garantia=$request->garantia;
        $pedido->imgServ=$request->imgServ;  
        $pedido->costoEnvio=$request->costoEnvio;
        $pedido->medioPagoAlquiler=$request->medioPagoAlquiler;
        $pedido->medioPagoGarantia=$request->medioPagoGarantia;
        $pedido->medioPagoEnvio=$request->medioPagoEnvio;
        $pedido->nombreCliente=$request->nombreCliente;
        $pedido->dni=$request->dni;
        $pedido->direccion=$request->direccion;
        $pedido->localidad=$request->localidad;
        $pedido->telefono=$request->telefono;
        $pedido->email=$request->email;
        $originalDate = $request->fechaInicio;
        
        if($pedido->estadoPedido!='Retirar'){
            $fechaInicio = date("d-m-Y H:i", strtotime($originalDate));  
            $pedido->fechaInicio=$fechaInicio; 
            $pedido->fechaFin=$request->fechaFin;
            $pedido->fechaRetiro=$request->fechaFin;
        }

        $pedido->comentarios=$request->comentarios;

        if($request->dias==15){
            $pedido->dias=$request->dias;
            $pedido->meses=0.5;

        }else{
            $pedido->dias=$request->dias * 30;
            $pedido->meses=$request->dias;
        } 
        $pedido->recibe=$request->recibe;
        $pedido->pdfContrato="s/n";
        $pedido->pdfRemito="s/n";
        $pedido->pdfPresupuesto="s/n"; 

        if ($request->file('imgDniF'))  { 
            $archivo=$request->file('imgDniF');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgDniF=substr($archivo->getClientOriginalName(),0,-4);  
            $imgDniF='dniFrente-'.$pedido->idPedido.'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgDniF );  // public_path ES LA CARPETA 'PUBLIC'

            $pedido->imgDniF=$imgDniF;
        }
        if ($request->file('imgDniD'))  { 
            $archivo=$request->file('imgDniD');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgDniD=substr($archivo->getClientOriginalName(),0,-4);  
            $imgDniD='dniDorso-'.$pedido->idPedido.'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgDniD );  // public_path ES LA CARPETA 'PUBLIC'
            $pedido->imgDniD=$imgDniD;
        }
        if ($request->file('imgOrden'))  { 
            $archivo=$request->file('imgOrden');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgOrden=substr($archivo->getClientOriginalName(),0,-4);  
            $imgOrden='Orden-'.$pedido->idPedido.'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgOrden );  // public_path ES LA CARPETA 'PUBLIC'
            $pedido->imgOrden=$imgOrden;
        }


        $pedido->save();
       
        if($pedido->estadoPedido !='Espera'){
            $registro=Registro::where('idPedido','LIKE',$request->idPedido)->first();
            
            $registro->idPedido=$pedido->idPedido;  
            $registro->nombreCliente=$pedido->nombreCliente;  
            $registro->direccion=$pedido->direccion;  
            $registro->localidad=$pedido->localidad; 
            $registro->idServicio=$pedido->idServicio;
            $registro->nomServicio=$pedido->nombreServ;
            $registro->descripcion=$pedido->descripcion;
            $registro->fechaInicio=$pedido->fechaInicio;
            $registro->fechaFin=$pedido->fechaFin;
            $registro->dias=$pedido->dias;
            $registro->mesesDeUso=$pedido->meses;

             

            $registro->estadoPedido=$pedido->estadoPedido;

            $registro->save();
    
            ////CARGA DE FECHA INICIO///
            $calen=Calendario::where('idPedido','LIKE',$request->idPedido)->where('bandera','LIKE','inicio')->first(); 
            $calen->idPedido=$pedido->idPedido;  
            $calen->nombreServ=$pedido->nombreServ;  
            $calen->descripcion=$pedido->descripcion;  
            $calen->nombreCliente=$pedido->nombreCliente;  
            $calen->dni=$pedido->dni;  
            $calen->telefono=$pedido->telefono;  
            $calen->direccion=$pedido->direccion;  
            $calen->localidad=$pedido->localidad; 

            
            $originalDate = $pedido->fechaInicio;
            $fechaInicio = date("Y-m-d H:i", strtotime($originalDate)); 

            $calen->start=$fechaInicio ; 

            $calen->fechaInicio=$pedido->fechaInicio ;
            $calen->fechaFin=$pedido->fechaFin;

            $calen->bandera="inicio";
            $calen->recibe=$pedido->recibe;
            //$calen->estadoPedido=$pedido->estadoPedido;
            //$calen->title=$pedido->estadoPedido.' '.$pedido->idPedido;
            $calen->textColor='black';
           // $calen->backgroundcolor='#f8ef6e';
            $calen->borderColor='black';
            $calen->fechaCalendario= date("Y-m-d", strtotime($pedido->fechaInicio)); 
            $calen->comentarios=$request->comentarios;

            $calen->save(); 

            ////CARGA DE FECHA FIN///

            $calen=Calendario::where('idPedido','LIKE',$request->idPedido)->where('bandera','LIKE','fin')->first(); 
            
            $calen->idPedido=$pedido->idPedido;  
            $calen->nombreServ=$pedido->nombreServ;  
            $calen->descripcion=$pedido->descripcion;  
            $calen->nombreCliente=$pedido->nombreCliente;  
            $calen->dni=$pedido->dni;  
            $calen->telefono=$pedido->telefono;  
            $calen->direccion=$pedido->direccion;  
            $calen->localidad=$pedido->localidad; 

            $originalDate = $pedido->fechaFin;
            $fechaFin = date("Y-m-d", strtotime($originalDate)); 
            
            if($pedido->estadoPedido!='Retirar'){
                $calen->start=$fechaFin ; 
                $calen->fechaCalendario= date("Y-m-d", strtotime($pedido->fechaFin)); 
            } 

            $calen->fechaInicio=$pedido->fechaInicio ;
            $calen->fechaFin=$pedido->fechaFin ;
            $calen->bandera="fin";
            $calen->recibe=$pedido->recibe;
            //$calen->estadoPedido='Retiro';
            //$calen->title='Retiro  '.$pedido->idPedido;
            $calen->textColor='black';
            //$calen->backgroundcolor='#f8ef6e';
            $calen->borderColor='black';
            $calen->comentarios=$request->comentarios;

            $calen->save();




            
        }


        return redirect('/adminPedidos')
        ->with('mensaje2','Alquiler N°  '.$request->idPedido.'  fue  Modificado Correctamente'); 
    }

    public function eliminarPedido($id)
    {   
        $pedido=Pedido::find($id); 
        $idER=$pedido->dispoER;
        $idEA=$pedido->dispoEA;
        $idEY=$pedido->dispoEY;
        $idT1=$pedido->dispoT1;
        $idT415=$pedido->dispoT415;
        $idO=$pedido->dispoO;

        if($idER!=0){
            $equipo=Equipo::find($idER)->update(['estado'=>'Disponible']);    
        } 
        if($idEA!=0){
            $equipo=Equipo::find($idEA)->update(['estado'=>'Disponible']);    
        }
        if($idEY!=0){
            $equipo=Equipo::find($idEY)->update(['estado'=>'Disponible']);    
        }

        if($idT1!=0){
            $tuboT1=Tubo::find($idT1)->update(['estado'=>'Disponible']);      
        }

        if($idT415!=0){
            $tuboT415=Tubo::find($idT415)->update(['estado'=>'Disponible']);      
        }

        if($idO!=0){
            $oximetro=Oximetro::find($idO)->update(['estado'=>'Disponible']);      
        }


        $garantia=Garantia::where('idPedido','LIKE',$id)->first();
        if($garantia){
            $idUsuario=$garantia->idUsuario;
            $usuario=User::find($idUsuario); 
            if($usuario->rol=='admin'){
                $usuario->garantiaActiva=$usuario->garantiaActiva - $pedido->garantia ; 

                if($usuario->tipo=='Control Digital'){
                    $garantiaActivaDispo=$usuario->garantiaActiva;

                    if ($usuario->porcenFci != 0 ){
                        $usuario->fci = ($usuario->porcenFci * $garantiaActivaDispo)/100;
                        $garantiaActivaDispo=$usuario->garantiaActiva - $usuario->fci;
                    }

                    if ($usuario->porcenFci != 0 ){
                        $usuario->plazoFijo=($usuario->porcenPlazoFijo * $garantiaActivaDispo)/100; 
                    }

                    $usuario->liquidasHoy=($usuario->porcenFci * $usuario->garantiaActiva)/100;  
                }

                if($usuario->tipo=='Control de Efectivo'){

                    $usuario->efectivo=$usuario->efectivo - $pedido->garantia ;  
                    $usuario->liquidasHoy=$usuario->liquidasHoy - $pedido->garantia;  
                }
                $usuario->save();
                $usuario=User::find($idUsuario);
                if($usuario->liquidasHoy <= 0 && is_null($usuario->fci)==false){   
                    $usuario->estado='peligro';
                }else{
                    $usuario->estado='ok';
                }
                $usuario->save(); 
            }
        }


        $pedido->delete();

        return redirect('adminPedidos')
        ->with('mensaje3','El Alquiler N° ' .$id. ' fue Eliminado Correctamente');  

    }
 
     

    public function cambiarEstadoPedidoP($id,Request $request){  
 
        $pedido=Pedido::find($id);
        if($pedido->estadoPedido=='Espera'){

            $request->validate([  
               'medioPagoAlquiler'=>'required',
               'medioPagoGarantia'=>'required',
               'medioPagoEnvio'=>'required',
               'idUsuario'=>'required', 
               'logisticaE'=>'required', 
               'idUsuarioAlquiler'=>'required', 
               'costoEnvio'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',
            ],[
               'medioPagoAlquiler.required'=>'El Medio de Pago es Obligatorio',
               'medioPagoGarantia.required'=>'El Medio de Pago es Obligatorio',
               'medioPagoEnvio.required'=>'El Medio de Pago es Obligatorio',
               'idUsuario.required'=>'La Asignacion del Dinero es Obligatoria',
               'logisticaE.required'=>'La Asignacion de Logistica es Obligatoria',
               'idUsuarioAlquiler.required'=>'La Asignacion del Dinero es Obligatoria',
               'costoEnvio.regex'=>'El Costo de Envio Incorrecto',
               ]);
            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Entrega']);
            
            if($pedido->dispoER != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoER)->update(['estado'=>'Por Entregar']);
            }
            if($pedido->dispoEA != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEA)->update(['estado'=>'Por Entregar']);
            }
            if($pedido->dispoEY != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEY)->update(['estado'=>'Por Entregar']);
            }
            if($pedido->dispoT1!= 0){
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'Por Entregar']);
            }
            if($pedido->dispoT415!= 0){
                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'Por Entregar']);
            }
            if($pedido->dispoO!= 0){
                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'Por Entregar']);
            }
            /////////ACTUALIZA EL MEDIO DE PAGO Y COBRO Y ENTREGA//////////
            
            $usuario=User::find($request->logisticaE);
            
            
            $pedido=Pedido::find($id);
            $pedido->medioPagoAlquiler=$request->medioPagoAlquiler;
            $pedido->medioPagoGarantia=$request->medioPagoGarantia;
            $pedido->medioPagoEnvio=$request->medioPagoEnvio;
            $pedido->costoEnvio=$request->costoEnvio;
            $pedido->idLogisticaE=$request->logisticaE;   
            $pedido->logisticaE=$usuario->name.' '.$usuario->apellido;   

            $usuario=User::find($request->idUsuarioAlquiler);
            $pedido->idCobro=$request->idUsuarioAlquiler;
            $pedido->cuentaCobro=$usuario->name.' '.$usuario->apellido;

            $pedido->save();
             


            /////////AGREGA REGISTRO//////////

            $registro=new Registro();

            $registro->idPedido=$pedido->idPedido;  
            $registro->nombreCliente=$pedido->nombreCliente;  
            $registro->direccion=$pedido->direccion;  
            $registro->localidad=$pedido->localidad; 
            $registro->idServicio=$pedido->idServicio;
            $registro->nomServicio=$pedido->nombreServ;
            $registro->descripcion=$pedido->descripcion;
            $registro->fechaInicio=$pedido->fechaInicio;
            $registro->fechaFin=$pedido->fechaFin;
            $registro->dias=$pedido->dias;
            $registro->mesesDeUso=$pedido->meses;
            $registro->comentarios=$pedido->comentarios;
            $registro->estadoPedido='Entrega';

            $usuario=User::find($request->logisticaE);
            $registro->idLogisticaE=$request->logisticaE;
            $registro->logisticaE=$usuario->name.' '.$usuario->apellido;



            $registro->save();

            ////CARGA DE FECHA INICIO///
            $calen=new Calendario(); 
            $calen->idPedido=$pedido->idPedido; 
             
            $calen->idUsuario=$request->logisticaE;  

            $calen->nombreServ=$pedido->nombreServ;  
            $calen->descripcion=$pedido->descripcion;  
            $calen->nombreCliente=$pedido->nombreCliente;  
            $calen->dni=$pedido->dni;  
            $calen->telefono=$pedido->telefono;  
            $calen->direccion=$pedido->direccion;  
            $calen->localidad=$pedido->localidad; 

              
            $originalDate = $pedido->fechaInicio;
            $fechaInicio = date("Y-m-d H:i", strtotime($originalDate)); 
  
            $calen->start=$fechaInicio ; 

            $calen->fechaInicio=$pedido->fechaInicio ;
            $calen->fechaFin=$pedido->fechaFin;
            $calen->fechaRetiro=$pedido->fechaRetiro;

            $calen->bandera="inicio";
            $calen->recibe=$pedido->recibe;
            $calen->estadoPedido='Entrega';
            $calen->title='Entrega '.$pedido->idPedido;
            $calen->textColor='black';
            $calen->backgroundcolor='#f8ef6e';
            $calen->borderColor='black';

            $calen->logisticaE=$usuario->name.' '.$usuario->apellido;


            $calen->imgDniF=$pedido->imgDniF;
            $calen->imgDniD=$pedido->imgDniD;
            $calen->imgOrden=$pedido->imgOrden;

            $calen->comentarios=$pedido->comentarios;
            $calen->fechaCalendario= date("Y-m-d", strtotime($pedido->fechaInicio)); 

            $calen->save(); 

             
 
 
            


            ////CARGA DE FECHA FIN///
            
            $calen=new Calendario();   
            $calen->idPedido=$pedido->idPedido;  

            $calen->nombreServ=$pedido->nombreServ;  
            $calen->descripcion=$pedido->descripcion;  
            $calen->nombreCliente=$pedido->nombreCliente;  
            $calen->dni=$pedido->dni;  
            $calen->telefono=$pedido->telefono;  
            $calen->direccion=$pedido->direccion;  
            $calen->localidad=$pedido->localidad; 
          
            $originalDate = $pedido->fechaFin;
            $fechaFin = date("Y-m-d H:i", strtotime($originalDate)); 

            $calen->start=$fechaFin ; 


            $calen->fechaInicio=$pedido->fechaInicio ;
            $calen->fechaFin=$pedido->fechaFin ;
            $calen->fechaRetiro=$pedido->fechaRetiro;

            $calen->bandera="fin";
            $calen->recibe=$pedido->recibe;
            $calen->estadoPedido='Vencido';

            $calen->title='Vencido '.$pedido->idPedido;
            $calen->textColor='black';
            $calen->backgroundcolor='#f8ef6e';
            $calen->borderColor='black';

            $usuario=User::find($request->logisticaE);
            $calen->logisticaE=$usuario->name.' '.$usuario->apellido;
 
            $calen->imgDniF=$pedido->imgDniF;
            $calen->imgDniD=$pedido->imgDniD;
            $calen->imgOrden=$pedido->imgOrden;

            $calen->comentarios=$pedido->comentarios;
            $calen->fechaCalendario= date("Y-m-d", strtotime($pedido->fechaFin)); 

            $calen->save();


            ///CARGA DE GARANTIA///

            if($request->idUsuario!=0){

                $usuario=User::find($request->idUsuario); 
                $garantia=new Garantia;
                $garantia->idPedido=$pedido->idPedido;
                $garantia->nombreCliente=$pedido->nombreCliente;
                $garantia->monto=$pedido->garantia;
                $garantia->fechaInicio=$pedido->fechaInicio;
                $garantia->fechaFin=$pedido->fechaFin;
                $garantia->medioPagoGarantia=$pedido->medioPagoGarantia;
                $garantia->usuario=$pedido->usuario;
                $garantia->idUsuario=$request->idUsuario;

                $garantia->estaEnCaja=$usuario->name.' '.$usuario->apellido;

                $garantia->save(); 
            }

            /////////ACTUALIZA LA GARANTIA ACTIVAS-DESGLOSE//////////
            $usuario=User::find($request->idUsuario);
            if($request->idUsuario!=0){
            
                if($usuario->rol=='admin'){
                    $usuario->garantiaActiva=$pedido->garantia + $usuario->garantiaActiva; 

                    if($usuario->tipo=='Control Digital'){
                        $garantiaActivaDispo=$usuario->garantiaActiva;

                        if ($usuario->porcenFci != 0 ){
                            $usuario->fci = ($usuario->porcenFci * $garantiaActivaDispo)/100;
                            $garantiaActivaDispo=$usuario->garantiaActiva - $usuario->fci;
                        }

                        if ($usuario->porcenFci != 0 ){
                            $usuario->plazoFijo=($usuario->porcenPlazoFijo * $garantiaActivaDispo)/100; 
                        }

                        $usuario->liquidasHoy=($usuario->porcenFci * $usuario->garantiaActiva)/100;  
                    }

                    if($usuario->tipo=='Control de Efectivo'){

                        $usuario->efectivo=$pedido->garantia + $usuario->efectivo;  
                        $usuario->liquidasHoy=$pedido->garantia + $usuario->liquidasHoy;  
                    }

                    $usuario->save();

                    $usuario=User::find($request->idUsuario);
                    if($usuario->liquidasHoy <= 0 && is_null($usuario->fci)==false){   
                        $usuario->estado='peligro';
                    }else{
                        $usuario->estado='ok';
                    }
                    $usuario->save();
                }
            }
             

            ////////CARGA DE GASTO ENTRADA//////////
            if(is_null ($pedido->costoEnvio)){
                $pedido->costoEnvio=0;
            }

            $cajaEntrada=new Caja();
            $cajaEntrada->idPedido=$pedido->idPedido;
            $cajaEntrada->descripcion=$pedido->descripcion;
            $cajaEntrada->fechaInicio=$pedido->fechaInicio;
            $cajaEntrada->garantia=$pedido->garantia;
            $cajaEntrada->costoServ=$pedido->costoServ;
            $cajaEntrada->costoEnvio=$pedido->costoEnvio;
            $cajaEntrada->medioPagoAlquiler=$pedido->medioPagoAlquiler;
            $cajaEntrada->medioPagoGarantia=$pedido->medioPagoGarantia;
            $cajaEntrada->medioPagoEnvio=$pedido->medioPagoEnvio;
            $cajaEntrada->usuario=$pedido->usuario;
            $cajaEntrada->total=$pedido->garantia+$pedido->costoServ+$pedido->costoEnvio;
            $cajaEntrada->idCobro=$pedido->idCobro;
            $cajaEntrada->cuentaCobro=$pedido->cuentaCobro;
            $cajaEntrada->save();
            $ped=Pedido::find($id);
            $ped->idEntrada=$cajaEntrada->idEntrada;
            $ped->save();

            

            return redirect('adminPedidos')
            ->with('mensaje4','El Alquiler N° ' .$id. ' ha sido Marcado como  "Entrega" ');
        }

        if($pedido->estadoPedido=='Entrega'){
             
            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Entregado']);
            
            $regi=Registro::where('idPedido','LIKE',$id)->update(['estadoPedido'=>'Entregado']);
            
            $calen=Calendario::where('idPedido','LIKE',$id)
            ->where('estadoPedido','LIKE','Entrega')
            ->update(['backgroundcolor'=>'#28a745','estadoPedido'=>'Entregado','title'=>'Entregado '.$id]);
            
            $calen=Calendario::where('idPedido','LIKE',$id)
            ->where('estadoPedido','LIKE','Vencido')
            ->update(['backgroundcolor'=>'#d14529','estadoPedido'=>'Vencido','title'=>'Vencido '.$id]);

            if($pedido->dispoER != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoER)->update(['estado'=>'En Uso']);
            }
            if($pedido->dispoEA != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEA)->update(['estado'=>'En Uso']);
            }
            if($pedido->dispoEY != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEY)->update(['estado'=>'En Uso']);
            }
            if($pedido->dispoT1!= 0){
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'En Uso']);
            }
            if($pedido->dispoT415!= 0){
                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'En Uso']);
            }
            if($pedido->dispoO!= 0){
                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'En Uso']);
            }

            $pedido=Pedido::find($id);


            /////////////////////////////////////////
            ////////////CARGA DE CAJA QUINCENAL-entrada de alquiler//////
            $cajaQuincenal=new CajaQuincenal(); 
        
            $cajaQuincenal->idEntrada=$pedido->idPedido;
            $cajaQuincenal->idUsuario=$pedido->idCobro;
            $cajaQuincenal->Usuario=$pedido->cuentaCobro; 
            $cajaQuincenal->fecha=date("Y-m-d", strtotime($pedido->fechaInicio));
            $cajaQuincenal->dinero=$pedido->costoServ;
            $cajaQuincenal->descripcion='Entrega de: '.$pedido->descripcion;
            $cajaQuincenal->medioDePago=$pedido->medioPagoAlquiler;
            $cajaQuincenal->tipo='alquiler';
            $cajaQuincenal->save();

            /////////////////////////////////////////
            ////////////CARGA DE CAJA QUINCENAL-entrada de garantia//////
            $garantia=Garantia::where('idPedido','LIKE',$id)->first();
            if($garantia){
                $cajaQuincenal=new CajaQuincenal();
            
                $cajaQuincenal->idEntrada=$garantia->idGarantia;
                $cajaQuincenal->idUsuario=$garantia->idUsuario;
                $cajaQuincenal->Usuario=$garantia->estaEnCaja; 
                $cajaQuincenal->fecha=date("Y-m-d", strtotime($garantia->fechaInicio));

                $cajaQuincenal->dinero=$garantia->monto;
                $cajaQuincenal->descripcion='Deposito de Garantia';
                $cajaQuincenal->medioDePago=$pedido->medioPagoGarantia;
                $cajaQuincenal->tipo='garantia';
                $cajaQuincenal->save();
            }
              
            /////////////////////////////////////////
            ////////////CARGA DE CAJA QUINCENAL-entrada de envios//////
            if($pedido->costoEnvio != 0){

                $cajaQuincenal=new CajaQuincenal();
                $garantia=Garantia::where('idPedido','LIKE',$id)->first();
            
                $cajaQuincenal->idEntrada=$pedido->idPedido;
                $cajaQuincenal->idUsuario=$garantia->idUsuario;
                $cajaQuincenal->Usuario=$garantia->estaEnCaja; 
                $cajaQuincenal->fecha=date("Y-m-d", strtotime($pedido->fechaInicio));
                $cajaQuincenal->dinero=$pedido->costoEnvio;
                $cajaQuincenal->descripcion='Envio de Alquiler N°: '.$pedido->idPedido;
                $cajaQuincenal->medioDePago=$pedido->medioPagoEnvio;
                $cajaQuincenal->tipo='envio';
                $cajaQuincenal->save();

            }
            

            //ENVIO DE EMAIL

            $pedido=Pedido::find($id);
            if($pedido->email!=''){
                
                $email=$pedido->email;
                $nombreCliente=$pedido->nombreCliente;

                $mensaje=['asunto'=>'Archivos Adjutos HHOxigeno',
                    'email'=>$email,
                    'nombreCliente'=>$pedido->nombreCliente,   
                    'id'=>$id,    
                ];
                
                dispatch(new EnvioContratoPresupuestoJobs($mensaje)); 
            }


            return redirect('adminPedidos')
            ->with('mensaje4','El Alquiler N° ' .$id. ' ha sido Marcado como  "Entregado" ');
        }/*
        if($pedido->estadoPedido=='Entregado'){

            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Retirar']);
            $regi=Registro::where('idPedido','LIKE',$id)->update(['estadoPedido'=>'Retirar']);
            
            $Hoy= date("Y-m-d");

            $calen=Calendario::where('idPedido','LIKE',$id)
            ->where('estadoPedido','LIKE','Retiro')
            ->update(['backgroundcolor'=>'#d33','start'=>$Hoy]);


            if($pedido->dispoER != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoER)->update(['estado'=>'Por Retirar']);
            }

            if($pedido->dispoEA != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEA)->update(['estado'=>'Por Retirar']);
            }

            if($pedido->dispoT1 != 0){
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'Por Retirar']);
            }
            if($pedido->dispoT415 != 0){
                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'Por Retirar']);
            }
            if($pedido->dispoO!= 0){
                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'Por Retirar']);
            }


            return redirect('adminPedidos')
            ->with('mensaje4','El Alquiler N° ' .$id. ' ha sido Marcado como  "Retiro" ');
        }*/
        if($pedido->estadoPedido=='Retirar'){

            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Retirado']);
            $regi=Registro::where('idPedido','LIKE',$id)->update(['estadoPedido'=>'Retirado']);
            
            $calen=Calendario::where('idPedido','LIKE',$id)
            ->where('estadoPedido','LIKE','Retirar')
            ->update(['backgroundcolor'=>'#55acee','title'=>'Retirado '.$id,'estadoPedido'=>'Retirado']);

            
            if($pedido->dispoER != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoER)->update(['estado'=>'Disponible']);
            }
            if($pedido->dispoEA != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEA)->update(['estado'=>'Disponible']);
            }
            if($pedido->dispoEY != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEY)->update(['estado'=>'Disponible']);
            }
            if($pedido->dispoT1!= 0){
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'Disponible']);
            }
            if($pedido->dispoT415!= 0){

                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'Disponible']);
    
            }
            if($pedido->dispoO!= 0){

                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'Disponible']);

            }


          

            ////CODIGO QUE CREA  FINANZAS//////////

            $garant=Garantia::where('idPedido','=',$id)->first();
            if($garant){
                if($garant->medioPagoGarantia!='Efectivo' || $garant->medioPagoGarantia!='No Se Cobra'){
                    $usuario=$garant->usuario; 

                    $finanza=new Finanza();
                    $finanza->idPedido=$pedido->idPedido;
                    $finanza->usuario=$usuario;
                    $finanza->nombreCliente=$pedido->nombreCliente;
                    $finanza->monto=$pedido->garantia;
                    $finanza->fechaInicio=$pedido->fechaInicio;
                    $finanza->fechaFin=$pedido->fechaRetiro; 


                    date_default_timezone_set("America/Argentina/Buenos_Aires");

                    $originalDate = $pedido->fechaInicio;
                    $fechaInicio = date("Y-m-d", strtotime($originalDate)); 
                    $originalDate = $pedido->fechaRetiro;
                    $fechaRetiro = date("Y-m-d", strtotime($originalDate)); 

                    $fecha1= new DateTime($fechaInicio);
                    $fecha2= new DateTime($fechaRetiro);
                    $diff = $fecha1->diff($fecha2);

                    $finanza->diasInvertido=$diff->days;

                    $renta=Rentabilidad::find(1);
                    $finanza->rentabAnual=$renta->valor;
        

                    $finanza->ganancia=($renta->valor/365 * $diff->days * $pedido->garantia)/100;


                    $finanza->save();

                    ////////////CARGA DE CAJA QUINCENAL-entrada de finanza//////
                    $cajaQuincenal=new CajaQuincenal();
                    $finanza=Finanza::where('idPedido','LIKE',$id)->first();
                    $garantia=Garantia::where('idPedido','LIKE',$id)->first();

                    $cajaQuincenal->idEntrada=$finanza->idFinanza;
                    $cajaQuincenal->idUsuario=$garantia->idUsuario;
                    $cajaQuincenal->Usuario=$garantia->estaEnCaja; 
                    $cajaQuincenal->fecha=date("Y-m-d", strtotime($finanza->fechaInicio)); 
                    $cajaQuincenal->dinero=$finanza->ganancia;
                    $cajaQuincenal->descripcion='Finanzas';
                    $cajaQuincenal->medioDePago='Bank';
                    $cajaQuincenal->tipo='finanzas';
                    $cajaQuincenal->save();
                }
            }
            ////CODIGO QUE RESTA LA GARANTIA ALA TABLA DEL USUARIO ADIGNADA//////////Y BORRA LA GARANTIA

            $garantia=Garantia::where('idPedido','=',$id)->first();
            if($garant){

                $idGU=$garantia->idUsuario;
                $montoG=$garantia->monto;  

                $usuario=User::find($idGU); 
                if($usuario->rol=='admin'){
                    $usuario->garantiaActiva=$usuario->garantiaActiva - $pedido->garantia ; 

                    if($usuario->tipo=='Control Digital'){
                        $garantiaActivaDispo=$usuario->garantiaActiva;

                        if ($usuario->porcenFci != 0 ){
                            $usuario->fci = ($usuario->porcenFci * $garantiaActivaDispo)/100;
                            $garantiaActivaDispo=$usuario->garantiaActiva - $usuario->fci;
                        }

                        if ($usuario->porcenFci != 0 ){
                            $usuario->plazoFijo=($usuario->porcenPlazoFijo * $garantiaActivaDispo)/100; 
                        }

                        $usuario->liquidasHoy=($usuario->porcenFci * $usuario->garantiaActiva)/100;  
                    }

                    if($usuario->tipo=='Control de Efectivo'){

                        $usuario->efectivo=$usuario->efectivo - $pedido->garantia ;  
                        $usuario->liquidasHoy=$usuario->liquidasHoy - $pedido->garantia;  
                    }

                    $usuario->save();

                    $usuario=User::find($idGU);
                    if($usuario->liquidasHoy <= 0 && is_null($usuario->fci)==false){   
                        $usuario->estado='peligro';
                    }else{
                        $usuario->estado='ok';
                    }
                    $usuario->save();


                }
            }

            

            return redirect('adminPedidos')
            ->with('mensaje4','El Alquiler N° ' .$id. ' ha sido Marcado como  "Retirado" ');
        }

        if($pedido->estadoPedido=='Retirado'){

            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Archivado']);
            $regi=Registro::where('idPedido','LIKE',$id)->update(['estadoPedido'=>'Archivado']);
            $garantia=Garantia::where('idPedido','LIKE',$id)->update(['estado'=>'Archivado']);
            $finanza=Finanza::where('idPedido','LIKE',$id)->update(['estado'=>'Archivado']);
            
            
            



            return redirect('adminPedidosArchivados')
            ->with('mensaje','El Alquiler N° ' .$id. ' ha sido Marcado como  "Archivado" ');
        }
    }
 
    public function formCambiosFinales($id,Request $request){

            //dd($request->costoEnvio,$request->medioPagoEnvio);

            $usuario=User::find($request->logisticaE);
        
            $calen=Calendario::where('idPedido','LIKE',$id)->
            where('bandera','=','inicio')->
            update(['logisticaE'=>$usuario->name.' '.$usuario->apellido,'idUsuario'=>$usuario->id]);

            $calen=Calendario::where('idPedido','LIKE',$id)->
            where('bandera','=','fin')->
            update(['logisticaE'=>$usuario->name.' '.$usuario->apellido]);

            $pedi=Pedido::find($id)->update([
                'idLogisticaE'=>$usuario->id,
                'logisticaE'=>$usuario->name.' '.$usuario->apellido,
                'costoEnvio'=>$request->costoEnvio,
                'medioPagoEnvio'=>$request->medioPagoEnvio,
                ]);

            $regi=Registro::where('idPedido','LIKE',$id)->update([
                'idLogisticaE'=>$usuario->id,
                'logisticaE'=>$usuario->name.' '.$usuario->apellido
                ]); 
                
            $pedido=Pedido::find($id);
            $cajaEntrada=Caja::find($pedido->idEntrada);    
            $cajaEntrada->costoEnvio=$request->costoEnvio; 
            $cajaEntrada->medioPagoEnvio=$request->medioPagoEnvio; 
            $cajaEntrada->save();

            return redirect('adminPedidos')
            ->with('mensaje7','Actualizacion de Alquiler Concretada');

        
        
    }

    public function vercambiarEstadoPedidoPFecha($id){
             
        $pedido=Pedido::find($id);
        $users=User::Where('rol','=','admin')->orWhere('rol','=','logistica')->get();



        return view('formModificarPedidoPFecha',['pedido'=>$pedido,'users'=>$users ]);

    }

    public function modificarPedidoPFecha(Request $request){

        $request->validate([
            //reglas de validacion
           'fechaRetiro'=>'required',
           'logisticaR'=>'required',
       ],[
           'fechaRetiro.required'=>'La Fecha de Retiro es Obligatoria',
           'logisticaR.required'=>'El Personal de Logistica es Obligatorio', 
       ]);
  
 
        $originalDate = $request->fechaRetiro;
        $fechaRetiro = date("d-m-Y H:i", strtotime($originalDate));
         
        $usuario=User::find($request->logisticaR);

 


        $pedi=Pedido::find($request->idPedido)
        ->update(['fechaRetiro'=>$fechaRetiro,
        'estadoPedido'=>'Retirar',
        'idLogisticaR'=>$request->logisticaR,
        'logisticaR'=>$usuario->name.' '.$usuario->apellido]);

        $regi=Registro::where('idPedido','=',$request->idPedido)
        ->update(['estadoPedido'=>'Retirar',
        'idLogisticaR'=>$request->logisticaR,
        'logisticaR'=>$usuario->name.' '.$usuario->apellido,
        ]);
        
        $pedido=Pedido::find($request->idPedido);
        if($pedido->dispoER != 0){
            $E=Equipo::where('idEquipo','LIKE',$pedido->dispoER)->update(['estado'=>'Por Retirar']);
        }
        if($pedido->dispoEA != 0){
            $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEA)->update(['estado'=>'Por Retirar']);
        } 
        if($pedido->dispoEY != 0){
            $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEY)->update(['estado'=>'Por Retirar']);
        }
        if($pedido->dispoT1 != 0){
            $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'Por Retirar']);
        }
        if($pedido->dispoT415 != 0){
            $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'Por Retirar']);
        }
        if($pedido->dispoO!= 0){
            $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'Por Retirar']);
        }


        $calen=Calendario::where('idPedido','=',$request->idPedido)->
        where('bandera','=','fin')->first();
        $calen->start=$request->fechaRetiro; 

        $originalDate = $request->fechaRetiro;
        $fechaRetiro = date("d-m-Y H:i", strtotime($originalDate));
        
        $calen->fechaRetiro=$fechaRetiro;
        $calen->title='Retirar '.$request->idPedido;
        $calen->estadoPedido='Retirar';
        $calen->logisticaR=$usuario->name.' '.$usuario->apellido;
        $calen->idUsuario=$usuario->id;

        $calen->fechaCalendario= date("Y-m-d", strtotime($pedido->fechaRetiro)); 


        $calen->save();

        
        $calenf=Calendario::where('idPedido','=',$request->idPedido)->
        where('bandera','=','inicio')->first(); 

        $originalDate = $request->fechaRetiro;
        $fechaRetiro = date("d-m-Y H:i", strtotime($originalDate));
        
        $calenf->fechaRetiro=$fechaRetiro;
        $calenf->logisticaR=$usuario->name.' '.$usuario->apellido;


        $calenf->save();

        return redirect('/adminCalendario');
        
    }

    public function pedidosDescargaPdfTodo($id){ 

        $pedido=Pedido::find($id);
        $ER=$pedido->dispoER;   
        $EA=$pedido->dispoEA;   
        $EY=$pedido->dispoEY;   
        $T1=$pedido->dispoT1;   
        $T415=$pedido->dispoT415;   
        $idServ=$pedido->idServicio;   

        $equipoER=Equipo::find($ER); 
        $equipoEA=Equipo::find($EA); 
        $equipoEY=Equipo::find($EY); 
        $tuboT1=Tubo::find($T1); 
        $tuboT415=Tubo::find($T415); 
        $servicio=Servicio::find($idServ); 
        $registro=Registro::where('idPedido','LIKE',$id)->first(); 

        $formatter = new NumeroALetras();
        $pesos=$formatter->toWords($pedido->garantia);

        $pdf=PDF::loadView('vistaPdfTodo',compact('pedido','equipoER','equipoEA','equipoEY','tuboT1','tuboT415','servicio','registro','pesos'));
        
        return $pdf->stream();
         
    }

    public function pedidosDescargaPdfPresu($id){

        $pedido=Pedido::find($id);
        $ER=$pedido->dispoER;   
        $EA=$pedido->dispoEA;   
        $EY=$pedido->dispoEY;   
        $T1=$pedido->dispoT1;   
        $T415=$pedido->dispoT415;   
        $idServ=$pedido->idServicio;   

        $equipoER=Equipo::find($ER); 
        $equipoEA=Equipo::find($EA); 
        $equipoEY=Equipo::find($EY); 
        $tuboT1=Tubo::find($T1); 
        $tuboT415=Tubo::find($T415); 
        $servicio=Servicio::find($idServ); 
        $registro=Registro::where('idPedido','LIKE',$id)->first(); 

        $pdf=PDF::loadView('vistaPdfPresu',compact('pedido','equipoER','equipoEA','equipoEY','tuboT1','tuboT415','servicio','registro'));
        
        return $pdf->stream();
    } 
    public function cambiarPedidoARetirar($id){

        $pedido=Pedido::find($id);
        $registro=Registro::where('idPedido','LIKE',$id)->first();


        if(($pedido->estadoPedido=='Vencido') or ($registro->estadoPedido=='Vencido')){
            //dd($id);

            $pedi=Pedido::find($id)->update(['estadoPedido'=>'Retirar']);
            $regi=Registro::where('idPedido','LIKE',$id)->update(['estadoPedido'=>'Retirar']);
         

            return  back()
            ->with('mensaje4','El Pedido N° ' .$id. ' ha sido Marcado como  "Retiro" ');
        }
    }
 
    public function verCambios(Request $request){

        $buscar=trim($request->get('buscar'));
        $pedidos = Pedido::where('estadoPedido','LIKE','Entregado')->orderBy('idPedido', 'DESC')->paginate(14);
        
        if ($buscar){

            $pedidos=Pedido::where('idPedido','LIKE','%'.$buscar.'%')->paginate(14);
            return view('adminCambios',['pedidos'=>$pedidos]);
        }
        else{
            return view('adminCambios',['pedidos'=>$pedidos]);

        }
    }

    public function formCambioPedido($id){
        $servicios=Servicio::get();
        $equipos=Equipo::where('estado','LIKE','Disponible')->get();
        $equiposR=Equipo::where('nombre','LIKE','Respironics')->where('estado','LIKE','Disponible')->get();
        $equiposA=Equipo::where('nombre','LIKE','Airsep')->where('estado','LIKE','Disponible')->get();
        $equiposY=Equipo::where('nombre','LIKE','Yuwell')->where('estado','LIKE','Disponible')->get();
        $tubos1M=Tubo::where('descripcion','LIKE','680L')->where('estado','LIKE','Disponible')->get();
        $tubos415M=Tubo::where('descripcion','LIKE','415L')->where('estado','LIKE','Disponible')->get();
        $oximetros=Oximetro::where('estado','LIKE','Disponible')->get();
        $users=User::get();
          

        $pedido=Pedido::find($id);
        return view('formCambioPedido',[
            'pedido'=>$pedido,
            'servicios'=>$servicios,
            'equipos'=>$equipos,
            'equiposR'=>$equiposR,
            'equiposA'=>$equiposA,
            'equiposY'=>$equiposY,
            'tubos1M'=>$tubos1M,
            'tubos415M'=>$tubos415M,
            'oximetros'=>$oximetros,
            'users'=>$users,
 
            ]);

    }
    
    public function modificarCambioPedido(Request $request){
 
        $request->validate([
            //reglas de validacion
           'logistica'=>'required',   
           'dispoC'=>'required',   
           'dispoT1'=>'required',   
           'dispoT415'=>'required',   
           'dispoO'=>'required',   
           'fechaInicio'=>'required',   
        ],[
            'logistica.required'=>'Este Campo es Obligatorio', 
            'dispoC.required'=>'Este Campo es Obligatorio', 
            'dispoT1.required'=>'Este Campo es Obligatorio', 
            'dispoT415.required'=>'Este Campo es Obligatorio', 
            'dispoO.required'=>'Este Campo es Obligatorio', 
            'fechaInicio.required'=>'Este Campo es Obligatorio', 
        ]);


        $pedido=Pedido::find($request->idPedido); 
        $dispoCRetiro=0;
        if($pedido->dispoER<>0){
            $dispoCRetiro=$pedido->dispoER;
            $letra='R';
        }elseif($pedido->dispoEA<>0){
            $dispoCRetiro=$pedido->dispoEA;
            $letra='A';
        }elseif($pedido->dispoEY<>0){
            $dispoCRetiro=$pedido->dispoEY;
            $letra='Y';
        }
        

        if($request->dispoC != 0){
            $equipoEntrega=Equipo::find($request->dispoC);  
            
            if ($equipoEntrega) {
                if($equipoEntrega->nombre=='Respironics'){
                    $nombreEquipoEntrega='Respironics N° R';
                }elseif($equipoEntrega->nombre=='Airsep'){
                    $nombreEquipoEntrega='Airsep N° A';
                }elseif($equipoEntrega->nombre=='Yuwell'){
                    $nombreEquipoEntrega='Yuwell N° Y';
                }
            }
        }
        if($dispoCRetiro != 0){
            $equipoRetiro=Equipo::find($dispoCRetiro);  
            if ($equipoRetiro) {
                if($equipoRetiro->nombre=='Respironics'){
                    $nombreEquipoRetiro='Respironics N° R';
                }elseif($equipoRetiro->nombre=='Airsep'){
                    $nombreEquipoRetiro='Airsep N° A';
                }elseif($equipoRetiro->nombre=='Yuwell'){
                    $nombreEquipoRetiro='Yuwell N° Y';
                }
            }
        }


        $entrega="CAMBIOS/ENTREGA :  Entrega de ".PHP_EOL;
        $retiro="CAMBIOS/RETIRO :  Retiro de ".PHP_EOL; 
        $cambio='';
        if ($request->dispoC != 0){
            $entrega=$entrega.' -Concentrador '.$nombreEquipoEntrega.$request->dispoC .PHP_EOL;
            $retiro=$retiro.' -Concentrador '.$nombreEquipoRetiro.$dispoCRetiro .PHP_EOL;
            if($request->comenC){
                $equipo=Equipo::find($dispoCRetiro)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'- SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE CONCENTRADOR:  '.PHP_EOL.$request->comenC]);
                $cambio=$cambio.'-Concentrador '.$letra.$dispoCRetiro.'  :  '.$request->comenC.PHP_EOL;
            }

            $equipo=Equipo::find($dispoCRetiro)->update(['estado'=>'Por Retirar']);
            $equipo=Equipo::find($request->dispoC)->update(['estado'=>'Por Entregar']);
 
            $equipo=Equipo::find($request->dispoC);  
           
            if ($equipo) {
                if($equipo->nombre=='Respironics'){
                    $pedido->dispoERCambio=$request->dispoC; 
                    $pedido->save();
                }elseif($equipo->nombre=='Airsep'){
                    $pedido->dispoEACambio=$request->dispoC; 
                    $pedido->save();
                }elseif($equipo->nombre=='Yuwell'){
                    $pedido->dispoEYCambio=$request->dispoC; 
                    $pedido->save();
                }
            } 
        }
 
        if ($request->dispoT1  != 0){
            $entrega=$entrega.' -Tubo de 680L N° T'.$request->dispoT1 .PHP_EOL;
            $retiro=$retiro.' -Tubo de 680L N° T'.$pedido->dispoT1 .PHP_EOL;
            if($request->comenT1){
                $tubo1TM=Tubo::find($pedido->dispoT1)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'  - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE TUBO:  '.PHP_EOL.$request->comenT1]);
                $cambio=$cambio.'-Tubo T'.$pedido->dispoT1.'  :  '.$request->comenT1.PHP_EOL;
            }
            $tubo1TM=Tubo::find($pedido->dispoT1)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoT1Cambio=$request->dispoT1;

            $tubo1TM=Tubo::find($request->dispoT1)->update(['estado'=>'Por Entregar']);
        }
        if ($request->dispoT415  != 0){
            $entrega=$entrega.' -Tubo de 415L N° T'.$request->dispoT415 .PHP_EOL;
            $retiro=$retiro.' -Tubo de 415L N° T'.$pedido->dispoT415 .PHP_EOL;
            
            if($request->comenT415){
                $tuboT415=Tubo::find($pedido->dispoT415)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'  - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE TUBO:  '.PHP_EOL.$request->comenT415]);
                $cambio=$cambio.'-Tubo T'.$pedido->dispoT415.'  :  '.$request->comenT415.PHP_EOL;
            }
            $tuboT415=Tubo::find($pedido->dispoT415)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoT415Cambio=$request->dispoT415;
 
            $tuboT415=Tubo::find($request->dispoT415)->update(['estado'=>'Por Entregar']);
        }
        if ($request->dispoO  != 0){
            $entrega=$entrega.' -Oximetro N° X'.$request->dispoO .PHP_EOL;
            $retiro=$retiro.' -Oximetro N° X'.$pedido->dispoO .PHP_EOL;
            
            if($request->comenO){
                $oximetro=Oximetro::find($pedido->dispoO)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.' - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE OXIMETRO:  '.PHP_EOL.$request->comenO]);
                $cambio=$cambio.'-Oximetro X'.$pedido->dispoO.'  :  '.$request->comenO.PHP_EOL;
            }
            $oximetro=Oximetro::find($pedido->dispoO)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoOCambio=$request->dispoO;

            $oximetro=Oximetro::find($request->dispoO)->update(['estado'=>'Por Entregar']);

        } 
        $pedido->cambio=$cambio;
        $pedido->comentarios=$request->comentarios;
        $pedido->save();


        //CARGA DE ENTREGA/RETIRO DE CAMBIO///    
        $calen=new Calendario();
        $calen->idPedido=$request->idPedido;
        $calen->descripcion=$entrega.PHP_EOL.PHP_EOL.$retiro;
        $calen->nombreCliente=$pedido->nombreCliente;
        $calen->dni=$pedido->dni;
        $calen->telefono=$pedido->telefono;
        $calen->direccion=$pedido->direccion;
        $calen->localidad=$pedido->localidad; 


        $originalDate = $request->fechaInicio;
        $fechaInicio = date("d-m-Y H:i", strtotime($originalDate)); 
         
        $fechaInicioS = date("Y-m-d H:i", strtotime($originalDate)); 

        $calen->start=$fechaInicioS; 
        $calen->fechaInicio=$fechaInicio ; 

        $calen->recibe=$pedido->recibe; 
        $calen->bandera="Cambio"; 

        $calen->estadoPedido='Entrega/Retiro';
        $calen->title='Cambio '.$pedido->idPedido;
        $calen->textColor='black';
        $calen->backgroundcolor='#f8ef6e';
        $calen->borderColor='black';
        $calen->cambio=$cambio;

        $calen->fechaCalendario= date("Y-m-d", strtotime($request->fechaInicio)); 

        $calen->idUsuario=$request->logistica;   
        $user=User::find($request->logistica);
        $calen->logisticaE=$user->name.' '.$user->apellido;
        $calen->comentarios=$request->comentarios;



        $calen->save(); 


        
        
        return redirect('/adminCambios')
        ->with('mensaje','El Cambio fue  Realizado Exitosamente'); 
    }

    public function formModificarCambio($id){  
        $servicios=Servicio::get();
        $equipos=Equipo::where('estado','LIKE','Disponible')->get(); 
        $tubos1M=Tubo::where('descripcion','LIKE','680L')->where('estado','LIKE','Disponible')->get();
        $tubos415M=Tubo::where('descripcion','LIKE','415L')->where('estado','LIKE','Disponible')->get();
        $oximetros=Oximetro::where('estado','LIKE','Disponible')->get();
        $users=User::get();
          
        $calendario=Calendario::find($id); 
        $pedido=Pedido::find($calendario->idPedido);
        return view('formModificarCambio',[
            'pedido'=>$pedido,
            'calendario'=>$calendario,
            'servicios'=>$servicios,
            'equipos'=>$equipos, 
            'tubos1M'=>$tubos1M,
            'tubos415M'=>$tubos415M,
            'oximetros'=>$oximetros,
            'users'=>$users, 
            ]);
 
    }
    public function modificarCambio(Request $request,$id){
 
        $request->validate([
            //reglas de validacion
           'logistica'=>'required',   
           'dispoC'=>'required',   
           'dispoT1'=>'required',   
           'dispoT415'=>'required',   
           'dispoO'=>'required',   
           'fechaInicio'=>'required',   
        ],[
            'logistica.required'=>'Este Campo es Obligatorio', 
            'dispoC.required'=>'Este Campo es Obligatorio', 
            'dispoT1.required'=>'Este Campo es Obligatorio', 
            'dispoT415.required'=>'Este Campo es Obligatorio', 
            'dispoO.required'=>'Este Campo es Obligatorio', 
            'fechaInicio.required'=>'Este Campo es Obligatorio', 
        ]);
        $calen=Calendario::find($request->idCalendario);
        $calen->cambio='';
        $calen->save();

        $pedido=Pedido::find($request->idPedido); 
        if($pedido->dispoERCambio != 0){
            $equipo=Equipo::find($pedido->dispoERCambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $pedido->dispoERCambio=0;
            $equipo->save();
        } 
        if($pedido->dispoEACambio != 0){
            $equipo=Equipo::find($pedido->dispoEACambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $pedido->dispoEACambio=0;
            $equipo->save();
        }
        if($pedido->dispoEYCambio != 0){
            $equipo=Equipo::find($pedido->dispoEYCambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $pedido->dispoEYCambio=0;
            $equipo->save();
        }   
        if($pedido->dispoT1Cambio != 0){
            $tubo=Tubo::find($pedido->dispoT1Cambio);
            $tubo->estado='Disponible';
            $tubo->comentario='';
            $pedido->dispoT1Cambio=0;
            $tubo->save();
        }
        if($pedido->dispoT415Cambio != 0){
            $tubo=Tubo::find($pedido->dispoT415Cambio);
            $tubo->estado='Disponible';
            $tubo->comentario='';
            $pedido->dispoT415Cambio=0;
            $tubo->save();
        } 

        if($pedido->dispoOCambio != 0){
            $oximetro=Oximetro::find($pedido->dispoOCambio);
            $oximetro->estado='Disponible';
            $oximetro->comentario='';
            $pedido->dispoOCambio=0;
            $oximetro->save();
        }    

        $pedido->cambio='';
        $entrega="CAMBIOS/ENTREGA :  Entrega de ".PHP_EOL;
        $retiro="CAMBIOS/RETIRO :  Retiro de ".PHP_EOL; 
        $cambio='';



        $dispoCRetiro=0;
        if($pedido->dispoER<>0){
            $dispoCRetiro=$pedido->dispoER;
            $letra='R';
        }elseif($pedido->dispoEA<>0){
            $dispoCRetiro=$pedido->dispoEA;
            $letra='A';
        }elseif($pedido->dispoEY<>0){
            $dispoCRetiro=$pedido->dispoEY;
            $letra='Y';
        }
        if($request->dispoC != 0){
            $equipoEntrega=Equipo::find($request->dispoC);  
            
            if ($equipoEntrega) {
                if($equipoEntrega->nombre=='Respironics'){
                    $nombreEquipoEntrega='Respironics N° R';
                }elseif($equipoEntrega->nombre=='Airsep'){
                    $nombreEquipoEntrega='Airsep N° A';
                }elseif($equipoEntrega->nombre=='Yuwell'){
                    $nombreEquipoEntrega='Yuwell N° Y';
                }
            }
        }
        if($dispoCRetiro != 0){
            $equipoRetiro=Equipo::find($dispoCRetiro);  
            if ($equipoRetiro) {
                if($equipoRetiro->nombre=='Respironics'){
                    $nombreEquipoRetiro='Respironics N° R';
                }elseif($equipoRetiro->nombre=='Airsep'){
                    $nombreEquipoRetiro='Airsep N° A';
                }elseif($equipoRetiro->nombre=='Yuwell'){
                    $nombreEquipoRetiro='Yuwell N° Y';
                }
            }
        }
        if ($request->dispoC != 0){
            $entrega=$entrega.' -Concentrador '.$nombreEquipoEntrega.$request->dispoC .PHP_EOL;
            $retiro=$retiro.' -Concentrador '.$nombreEquipoRetiro.$dispoCRetiro .PHP_EOL;
            if($request->comenC){
                $equipo=Equipo::find($dispoCRetiro)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'- SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE CONCENTRADOR:  '.PHP_EOL.$request->comenC]);
                $cambio=$cambio.'-Concentrador '.$letra.$dispoCRetiro.'  :  '.$request->comenC.PHP_EOL;
            }else{
                $equipo=Equipo::find($dispoCRetiro)->update(['comentario'=>'']);

            }

            $equipo=Equipo::find($dispoCRetiro)->update(['estado'=>'Por Retirar']);
            $equipo=Equipo::find($request->dispoC)->update(['estado'=>'Por Entregar']);
 
            $equipo=Equipo::find($request->dispoC);  
           
            if ($equipo) {
                if($equipo->nombre=='Respironics'){
                    $pedido->dispoERCambio=$request->dispoC; 
                    $pedido->save();
                }elseif($equipo->nombre=='Airsep'){
                    $pedido->dispoEACambio=$request->dispoC; 
                    $pedido->save();
                }elseif($equipo->nombre=='Yuwell'){
                    $pedido->dispoEYCambio=$request->dispoC; 
                    $pedido->save();
                }
            } 
        }
 
        if ($request->dispoT1  != 0){
            $entrega=$entrega.' -Tubo de 680L N° T'.$request->dispoT1 .PHP_EOL;
            $retiro=$retiro.' -Tubo de 680L N° T'.$pedido->dispoT1 .PHP_EOL;
            if($request->comenT1){
                $tubo1TM=Tubo::find($pedido->dispoT1)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'  - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE TUBO:  '.PHP_EOL.$request->comenT1]);
                $cambio=$cambio.'-Tubo T'.$pedido->dispoT1.'  :  '.$request->comenT1.PHP_EOL;
            }else{
                $tubo1TM=Tubo::find($pedido->dispoT1)->update(['comentario'=>'']);
            }
            $tubo1TM=Tubo::find($pedido->dispoT1)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoT1Cambio=$request->dispoT1;

            $tubo1TM=Tubo::find($request->dispoT1)->update(['estado'=>'Por Entregar']);
        }
        if ($request->dispoT415  != 0){
            $entrega=$entrega.' -Tubo de 415L N° T'.$request->dispoT415 .PHP_EOL;
            $retiro=$retiro.' -Tubo de 415L N° T'.$pedido->dispoT415 .PHP_EOL;
            
            if($request->comenT415){
                $tuboT415=Tubo::find($pedido->dispoT415)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.'  - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE TUBO:  '.PHP_EOL.$request->comenT415]);
                $cambio=$cambio.'-Tubo T'.$pedido->dispoT415.'  :  '.$request->comenT415.PHP_EOL;
            }else{
                $tuboT415=Tubo::find($pedido->dispoT415)->update(['comentario'=>'']);
            }
            $tuboT415=Tubo::find($pedido->dispoT415)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoT415Cambio=$request->dispoT415;
 
            $tuboT415=Tubo::find($request->dispoT415)->update(['estado'=>'Por Entregar']);
        }
 
        if ($request->dispoO  != 0){
            $entrega=$entrega.' -Oximetro N° X'.$request->dispoO .PHP_EOL;
            $retiro=$retiro.' -Oximetro N° X'.$pedido->dispoO .PHP_EOL;
            
            if($request->comenO){
                $oximetro=Oximetro::find($pedido->dispoO)->update(['comentario'=>'NO DISPONIBLE '.PHP_EOL.' - SE HIZO UN CAMBIO POR UN PROBLEMA CON ESTE OXIMETRO:  '.PHP_EOL.$request->comenO]);
                $cambio=$cambio.'-Oximetro X'.$pedido->dispoO.'  :  '.$request->comenO.PHP_EOL;
            }else{
                $oximetro=Oximetro::find($pedido->dispoO)->update(['comentario'=>'']);
            }
            $oximetro=Oximetro::find($pedido->dispoO)->update(['estado'=>'Por Retirar']);
            
            $pedido->dispoOCambio=$request->dispoO;

            $oximetro=Oximetro::find($request->dispoO)->update(['estado'=>'Por Entregar']);

        } 
        $pedido->cambio=$cambio;
        $pedido->comentarios=$request->comentarios;
        $pedido->save();


        //CARGA DE ENTREGA/RETIRO DE CAMBIO///    
        $calen=Calendario::find($request->idCalendario);
        $calen->descripcion=$entrega.PHP_EOL.PHP_EOL.$retiro;
          
        $originalDate = $request->fechaInicio;
        $fechaInicio = date("d-m-Y H:i", strtotime($originalDate)); 
        $fechaInicioS = date("Y-m-d H:i", strtotime($originalDate)); 
        $calen->start=$fechaInicioS; 
        $calen->fechaInicio=$fechaInicio ;  

        $calen->cambio=$cambio;

        $calen->fechaCalendario= date("Y-m-d", strtotime($request->fechaInicio)); 

        $calen->idUsuario=$request->logistica;   
        $user=User::find($request->logistica);
        $calen->logisticaE=$user->name.' '.$user->apellido;
        $calen->comentarios=$request->comentarios;
        $calen->save(); 

        return redirect('/adminCambiosH')
        ->with('mensaje','La Modificacion Del Cambio fue  Realizado Exitosamente'); 
    }
    public function eliminarCambio($idCalen)
    {   
        $calendario=Calendario::find($idCalen);
        $pedido=Pedido::find($calendario->idPedido); 
        
        //dd($calendario,$pedido);

        if($pedido->dispoER != 0){
            $equipo=Equipo::find($pedido->dispoER); 
            $equipo->estado='En Uso';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoERCambio != 0){
            $equipo=Equipo::find($pedido->dispoERCambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoEA != 0){
            $equipo=Equipo::find($pedido->dispoEA);
            $equipo->estado='En Uso';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoEACambio != 0){
            $equipo=Equipo::find($pedido->dispoEACambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoEY != 0){
            $equipo=Equipo::find($pedido->dispoEY);
            $equipo->estado='En Uso';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoEYCambio != 0){
            $equipo=Equipo::find($pedido->dispoEYCambio);
            $equipo->estado='Disponible';
            $equipo->comentario='';
            $equipo->save();
        }
        if($pedido->dispoT1 != 0){
            $tubo=Tubo::find($pedido->dispoT1);
            $tubo->estado='En Uso';
            $tubo->comentario='';
            $tubo->save();
        }
        if($pedido->dispoT1Cambio != 0){
            $tubo=Tubo::find($pedido->dispoT1Cambio);
            $tubo->estado='Disponible';
            $tubo->comentario='';
            $tubo->save();
        }
        if($pedido->dispoT415 != 0){
            $tubo=Tubo::find($pedido->dispoT415);
            $tubo->estado='En Uso';
            $tubo->comentario='';
            $tubo->save();
        }
        if($pedido->dispoT415Cambio != 0){
            $tubo=Tubo::find($pedido->dispoT415Cambio);
            $tubo->estado='Disponible';
            $tubo->comentario='';
            $tubo->save();
        }
        if($pedido->dispoO != 0){
            $oximetro=Oximetro::find($pedido->dispoO);
            $oximetro->estado='En Uso';
            $oximetro->comentario='';
            $oximetro->save();
        }
        if($pedido->dispoOCambio != 0){
            $oximetro=Oximetro::find($pedido->dispoOCambio);
            $oximetro->estado='Disponible';
            $oximetro->comentario='';
            $oximetro->save();
        }

        $pedido->dispoERCambio=0;
        $pedido->dispoEACambio=0;
        $pedido->dispoEYCambio=0;
        $pedido->dispoT1Cambio=0;
        $pedido->dispoT415Cambio=0;
        $pedido->dispoOCambio=0;
        $pedido->cambio='';

        $pedido->save();
        $calendario->delete();

        return redirect('adminCambiosH')
        ->with('mensaje','El Cambio fue Eliminado Correctamente');  

    }


    public function formUbicacionGarantiaEspera($id){

        $pedido=Pedido::find($id);
        $usuario=User::where('rol','=','admin')->get();
        $users=User::where('rol','=','admin')->orwhere('rol','=','logistica')->get();
        $calen=Calendario::where('idPedido','=',$id)->
        where('bandera','=','inicio')->first();
        $garantia=Garantia::where('idPedido','=',$id)->first();

        
        return view('formUbicacionGarantiaEspera',['pedido'=>$pedido,'usuario'=>$usuario,'users'=>$users,'garantia'=>$garantia,'calen'=>$calen]);
    } 
    public function formUbicacionGarantiaEntrega($id){

        $pedido=Pedido::find($id);
        $usuario=User::where('rol','=','admin')->get();
        $users=User::where('rol','=','admin')->orwhere('rol','=','logistica')->get();
        $calen=Calendario::where('idPedido','=',$id)->
        where('bandera','=','inicio')->first();
        $garantia=Garantia::where('idPedido','=',$id)->first();

        
        return view('formUbicacionGarantiaEntrega',['pedido'=>$pedido,'usuario'=>$usuario,'users'=>$users,'garantia'=>$garantia,'calen'=>$calen]);
    } 
    public function verModificarPedidoVencidoP($id){
            
        $servicios=Servicio::get();
        $pedido=Pedido::find($id);
        $usuario=User::where('rol','LIKE','admin')->get();
        return view('formModificarPedidoVencidoP',['pedido'=>$pedido,'servicios'=>$servicios,'usuario'=>$usuario]);

    }

    public function modificarPedidoVencidoP(Request $request){

        $request->validate([
           'costoEnvio'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',
           'medioPagoAlquiler'=>'required',
           'telefono'=>'required|regex:/^[1-9]{1}\d{0,}$/',
           'fechaInicio'=>'required',
           'idUsuario'=>'required',
           'dias'=>'required', 
       ],[
           'costoEnvio.regex'=>'El Costo de Envio es Incorrecto',
           'medioPagoAlquiler.required'=>'El Medio de Pago es Obligatorio',
           'telefono.required'=>'El Telefono es Obligatorio',
           'telefono.regex'=>'El Telefono es Incorrecto',
           'fechaInicio.required'=>'La Fecha de Renovacion es Obligatoria',
           'idUsuario.required'=>'La Cuenta es Obligatoria',
           'dias.required'=>'Los Mes/Meses es/son Obligatorio',
       ]);
  

        $pedido=Pedido::find($request->idPedido); 
        $pedido->costoEnvio=$request->costoEnvio;
        $pedido->medioPagoAlquiler=$request->medioPagoAlquiler;
        $pedido->telefono=$request->telefono;
        $pedido->email=$request->email; 
        $pedido->fechaFin=$request->fechaFin;
        $pedido->fechaRetiro=$request->fechaFin;
     
        if($request->dias==15){
            $pedido->dias=$pedido->dias+$request->dias;
            $pedido->meses=$pedido->meses + 0.5;
        }else{
            $pedido->dias=$pedido->dias + ($request->dias * 30);
            $pedido->meses=$pedido->meses + $request->dias;
        } 
        $pedido->recibe=$pedido->recibe; 
        $pedido->estadoPedido='Entregado';
        $pedido->save();
        

        $registro=Registro::where('idPedido','LIKE',$request->idPedido)->first();
        
        $registro->fechaFin=$pedido->fechaFin;  
        $registro->dias=$pedido->dias;
        $registro->mesesDeUso=$pedido->meses;
        $registro->estadoPedido=$pedido->estadoPedido;

        $registro->save();

        ////CARGA DE FECHA FIN///

        $calen=Calendario::where('idPedido','LIKE',$request->idPedido)->where('bandera','LIKE','fin')->first(); 


        $originalDate = $request->fechaFin;
        $fechaFin = date("Y-m-d H:i", strtotime($originalDate)); 
        $calen->start=$fechaFin ;  
        $calen->fechaFin=$request->fechaFin; 
        $calen->fechaRetiro=$request->fechaFin; 
        $calen->recibe=$request->recibe;
        $calen->estadoPedido='Vencido';
        $calen->title='Vencido  '.$pedido->idPedido;
        $calen->textColor='black';
        $calen->backgroundcolor='#d14529';
        $calen->borderColor='black';

        $calen->fechaCalendario= date("Y-m-d", strtotime($request->fechaFin)); 

        $calen->save();

        ////CARGA DE FECHA INICIO///

        $calen=Calendario::where('idPedido','LIKE',$request->idPedido)->where('bandera','LIKE','inicio')->first(); 
        $calen->fechaFin=$request->fechaFin; 
        $calen->fechaRetiro=$request->fechaFin; 
        $calen->save();



        /////////////CARGA LA RENOVAVION EN LA CAJA DE ENTRADA////


        $cajaEntrada=new Caja();
        $pedido=Pedido::find($request->idPedido); 

        $cajaEntrada->idPedido=$request->idPedido;
        $cajaEntrada->descripcion='RENOVAVION :'.$request->descripcion;
        $cajaEntrada->fechaInicio=date("d-m-Y", strtotime($request->fechaInicio)); 
        $cajaEntrada->garantia=0;
        $cajaEntrada->costoServ=$request->costoServ;
        $cajaEntrada->costoEnvio=$request->costoEnvio;
        $cajaEntrada->medioPagoAlquiler=$request->medioPagoAlquiler; 
        $cajaEntrada->medioPagoGarantia='No se Cobro';
        $cajaEntrada->usuario=Auth::user()->name.' '.Auth::user()->apellido;
        $cajaEntrada->total=$request->costoServ + $request->costoEnvio;
        $usuario=User::find($request->idUsuario); 
        $cajaEntrada->idCobro=$request->idUsuario;
        $cajaEntrada->cuentaCobro=$usuario->name.' '.$usuario->apellido;
        $cajaEntrada->save();



        ////////////CARGA DE CAJA QUINCENAL-entrada de renovacion de alquiler//////
        $cajaQuincenal=new CajaQuincenal();
        $pedido=Pedido::find($request->idPedido); 
        $usuario=User::find($request->idUsuario); 
 
        $cajaQuincenal->idEntrada=$pedido->idPedido;
        $cajaQuincenal->idUsuario=$request->idUsuario;
        $cajaQuincenal->Usuario=$usuario->name.' '.$usuario->apellido; 
        $cajaQuincenal->fecha=$request->fechaInicio; 
        $cajaQuincenal->dinero=$request->costoServ;
        $cajaQuincenal->descripcion='Renovacion de Alquiler: '.$pedido->descripcion;
        $cajaQuincenal->medioDePago=$request->medioPagoAlquiler;
        $cajaQuincenal->tipo='renovacion';
        $cajaQuincenal->save();




        return redirect('/adminPedidos')
        ->with('mensaje6','Alquiler N°  '.$request->idPedido.' fue Renovado Correctamente'); 
    }

    public function UserAsignacionDelDineroGarantia(Request $request){
          
        $usuarios=User::where('rol','=','admin')->where('tipo','=',$request->perfilFinanciero)->get(); 
        
        $pedido=Garantia::where('idPedido','=',$request->idPedido)->get();


        $array=[
            'usuarios'=>$usuarios, 
            'pedido'=>$pedido, 
        ];

       return response(json_encode($array),200)->header('Content-type','text/plain');
        
    }

    public function vencidoComentarios($id,Request $request){
        $pedido=Pedido::find($id);
        $pedido->comentarios=$request->comentarios;
        $pedido->save();
 
        $calendario=Calendario::where('idPedido','LIKE',$id)->get();
        if($calendario){
            foreach($calendario as $calen){
                $calen->comentarios=$request->comentarios;
                $calen->save();
            }
        }

        if ($pedido->estadoPedido!='Espera'){
            $registro=Registro::where('idPedido','LIKE',$id)->first();
            $registro->comentarios=$request->comentarios;
            $registro->save(); 
        }

        return redirect('/adminPedidos')
        ->with('mensaje8','Comentario Agregado Correctamente'); 
    }
    

    public function enviarArchivos($id){
        
        $pedido=Pedido::find($id);
        $email=$pedido->email;
        $nombreCliente=$pedido->nombreCliente;

        
        $mensaje=['asunto'=>'Archivos Adjutos HHOxigeno',
            'email'=>$email,
            'nombreCliente'=>$pedido->nombreCliente,  
            'id'=>$id,    
        ];
         
        dispatch(new EnvioContratoPresupuestoJobs($mensaje)); 
 
        return redirect('/adminPedidos')
        ->with('mensaje9','Archivos Enviados Correctamente');


    }
    public function modificarEmail($id,Request $request){
        
        $pedido=Pedido::find($id);
        $pedido->email=$request->email;
        $pedido->save();

        return redirect('/adminPedidos')
        ->with('mensaje10','Email Modificado Correctamente');
    }
    



}