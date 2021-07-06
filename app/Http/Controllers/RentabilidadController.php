<?php

namespace App\Http\Controllers;

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
use App\Models\Caja;
use App\Models\Rentabilidad;
use App\Models\User;
use Illuminate\Http\Request;

class RentabilidadController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function verPanel(Request $request){
        $buscar=trim($request->get('buscar'));

        $pedidos = Pedido::paginate(14);
        $servicios=Servicio::get(); 
        $usuarios=User::get(); 
        $usuadmin=User::where('rol','=','admin')->get(); 
        $rentab=Rentabilidad::get();
        $usuActivos=User::where('rol','=','admin')->where('activos','>',0)->get(); 

        
        return view('panel',['pedidos'=>$pedidos,'servicios'=>$servicios,'rentab'=>$rentab,'usuarios'=>$usuarios,'usuadmin'=>$usuadmin,'usuActivos'=>$usuActivos]);
    }
    public function modificarRentabilidad(Request $request){ 
       $renta=Rentabilidad::find($request->idRenta)->update(['valor'=>$request->renta]); 
       return redirect('/')
        ->with('mensaje','La Rentabilidad Anual Se Actualizo Correctamente');  

    }


    public function alertas(Request $request){ 
 
        if($request->alerta=='entregas'){
             $alerta=Calendario::where('bandera','LIKE','inicio')->where('estadoPedido','LIKE','Entrega')->get();
        }else{
            if($request->alerta=='retiros'){
                $alerta=Calendario::Where('bandera','LIKE','fin')->Where('estadoPedido','LIKE','Retirar')->get();
            }else{
                if($request->alerta=='tareas'){
                    $alerta=Calendario::Where('bandera','LIKE','tarea')->Where('estadoPedido','LIKE','Pendiente')->get(); 
                }else{
                    if($request->alerta=='vencimientos'){
                        $alerta=Calendario::Where('bandera','LIKE','fin')->Where('estadoPedido','LIKE','Vencido')->get(); 
                    }else{
                        $alerta=0;
                    }
                }
            }
        }

        $alertInicio = date("d-m-Y", strtotime($request->alertInicio)); 
        $alertFinal = date("d-m-Y", strtotime($request->alertFinal)); 
  

        $alertInicio=strtotime($alertInicio);
        $alertFinal=strtotime($alertFinal);
        $countAlerta=0;

        if($alerta!==0){
            foreach($alerta as $aler){

                $fechaAler = date("d-m-Y", strtotime($aler->start));  
                $fechaAler=strtotime($fechaAler);
    
                if($fechaAler>=$alertInicio && $fechaAler<=$alertFinal ){
                    $countAlerta=$countAlerta+1;
                }
            }
        }
        $array=[
            'countAlerta'=>$countAlerta,
            'alerta'=>$alerta
        ];
        

       return response(json_encode($array),200)->header('Content-type','text/plain');
    }

    public function adminAlertas(Request $request){
        /*$hoy=strtotime(date("Y-m-d 00:00"));
        $hoy2=strtotime(date("Y-m-d 00:00")."+ 7 days");
        $hoy=date("Y-m-d 00:00",$hoy);
        $hoy2=date("Y-m-d 00:00",$hoy2);
        $alertas=Calendario::where('start','>=',$hoy)->where('start','<=',$hoy2)->orderBy('start', 'ASC')->paginate();*/
        /*
                $hoy2=strtotime(date("Y-m-d 00:00")."+ 7 days");
                $hoy2=date("Y-m-d 00:00",$hoy2);

                $alertas=Calendario::Where(function($query) {
                    
                    $hoy=strtotime(date("Y-m-d 00:00"));
                    $hoy3=strtotime(date("Y-m-d"));

                    $hoy=date("Y-m-d 00:00",$hoy);
                    $hoy3=date("Y-m-d",$hoy3);

                    $query->where('start','>=',$hoy)
                        ->orwhere('start','>=',$hoy3);
                })->where('start','<=',$hoy2)->orderBy('start', 'ASC')->paginate();
        */
        $tipoAlerta=strtoupper($request->alerta);
        $alertInicio = date("d/m/Y", strtotime($request->alertInicio)); 
        $alertFinal = date("d/m/Y", strtotime($request->alertFinal)); 
        
        if($request->alerta=='entregas'){
            $alertas=Calendario::where('bandera','LIKE','inicio')->
            where('estadoPedido','LIKE','Entrega')->
            whereDate('start','>=',$request->alertInicio)->
            whereDate('start','<=',$request->alertFinal)->
            paginate(14);
        }else{
            if($request->alerta=='retiros'){
                $alertas=Calendario::Where('bandera','LIKE','fin')->
                Where('estadoPedido','LIKE','Retirar')->
                whereDate('start','>=',$request->alertInicio)->
                whereDate('start','<=',$request->alertFinal)->
                paginate(14);
            }else{
                if($request->alerta=='tareas'){
                    $alertas=Calendario::Where('bandera','LIKE','tarea')->
                    Where('estadoPedido','LIKE','Pendiente')->
                    whereDate('start','>=',$request->alertInicio)->
                    whereDate('start','<=',$request->alertFinal)->
                    paginate(14); 
                }else{
                    if($request->alerta=='vencimientos'){
                        $alertas=Calendario::Where('bandera','LIKE','fin')->
                        Where('estadoPedido','LIKE','Vencido')->
                        whereDate('start','>=',$request->alertInicio)->
                        whereDate('start','<=',$request->alertFinal)->
                        paginate(14);
                    }
                }
            }
        } 

        
        return view('adminAlertas',['alertas'=>$alertas,'tipoAlerta'=>$tipoAlerta,'alertInicio'=>$alertInicio,'alertFinal'=>$alertFinal]);
    }

    public function alertaGarantiaLiquidas(){

        $user=User::where('rol','LIKE','admin')->get();
        $respuesta='';
        foreach($user as $use){
            if($use->liquidasHoy==10000){
                $respuesta=$respuesta.' / '.$use->name.' '.$use->apellido;
            }
        } 
        $array=[
            'respuesta'=>$respuesta
        ]; 
       return response(json_encode($array),200)->header('Content-type','text/plain');
    }
    
}
