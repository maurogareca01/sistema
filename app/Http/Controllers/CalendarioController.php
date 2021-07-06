<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Models\Pedido;  
use App\Models\Equipo; 
use App\Models\Tubo;
use App\Models\Oximetro; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador,logistica']);
    } 
    public function verCalendario(Request $request){    
        
        $usuarios=User::get(); 

        $fechaCalendario=trim($request->get('fechaCalendario'));

        if($fechaCalendario){
            $array=[];
            foreach($usuarios as $user){

                $calendario=Calendario::join('users', 'users.id', '=', 'calendario.idUsuario')->
                where('fechaCalendario','LIKE',$fechaCalendario)->
                where('idUsuario','LIKE',$user->id)->
                Where(function($query) { 

                    $query->where('estadoPedido','LIKE','Entrega')->
                    orwhere('estadoPedido','LIKE','Retirar')->
                    orWhere('estadoPedido','LIKE','Entrega/Retiro');

                })->orderBy('orden', 'ASC')->get();
                
                if(!$calendario->isEmpty()){
                   
                    $nombre=$user->name.$user->apellido; 
                    $array[$nombre]=$calendario;
     
                }
            } 
        }else{
            
            $fechaHoy=date("Y-m-d");   
            $array=[];
            foreach($usuarios as $user){

                $calendario=Calendario::join('users', 'users.id', '=', 'calendario.idUsuario')->
                where('fechaCalendario','LIKE',$fechaHoy)->
                where('idUsuario','LIKE',$user->id)->
                Where(function($query) { 

                    $query->where('estadoPedido','LIKE','Entrega')->
                    orWhere('estadoPedido','LIKE','Retirar');

                })->orderBy('orden', 'ASC')->get();
                 
                
                if(!$calendario->isEmpty()){
                   
                    $nombre=$user->name.$user->apellido; 
                    $array[$nombre]=$calendario;
     
                }
            } 
        }

       //dd($array);
 
        return view('adminCalendario',['usuarios'=>$usuarios,'array'=>$array]);
    }
 
    public function verFechas(){

        if(Auth::user()->rol=='logistica'){
            $id=Auth::user()->id;
            
            $calendario['calendario']=Calendario::where('idUsuario','LIKE',$id)->get();
        }else{
            $calendario['calendario']=Calendario::all();
        }
  
        return response()->json($calendario['calendario']); 
         
    }

    public function verCambiosSet(Request $request){  
        $buscar=trim($request->get('buscar'));
        $cambios=Calendario::where('bandera','LIKE','Cambio')->orderBy('idPedido', 'DESC')->paginate(20);

        if ($buscar){
                
            $cambios=Calendario::where('idPedido','LIKE',$buscar) 
            ->Where('bandera', 'LIKE', 'Cambio')->paginate(20);

            
            /*->Where(function($query)
            {
                $query->Where('bandera', 'LIKE', 'EntregaCambio')
                      ->orWhere('bandera', 'LIKE', 'RetiroCambio');
            })->paginate(20);*/

            return view('adminCambiosH',['cambios'=>$cambios]); 
        }
        else{
            return view('adminCambiosH',['cambios'=>$cambios]); 
        }
    }

    public function cambiarEstadoCambios($id){
        $cambio=Calendario::find($id);
        $idPedido=$cambio->idPedido;

        $pedido=Pedido::find($idPedido);    

        

        if($cambio->estadoPedido=='Entrega/Retiro'){

            $cambio->estadoPedido='Entregado/Retirado';
            $cambio->backgroundColor='#28a745';
            $cambio->save();

            
            if($pedido->dispoER<>0){
                $dispoRevisar=$pedido->dispoER;
            }elseif($pedido->dispoEA<>0){
                $dispoRevisar=$pedido->dispoEA;
            }elseif($pedido->dispoEY<>0){
                $dispoRevisar=$pedido->dispoEY;
            }


            if($pedido->dispoERCambio != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoERCambio)->update(['estado'=>'En Uso']);
                $E=Equipo::where('idEquipo','LIKE',$dispoRevisar)->update(['estado'=>'Revisar']);
                $pedido->dispoER=$pedido->dispoERCambio;
                $pedido->dispoERCambio=0;
                $pedido->dispoEACambio=0;
                $pedido->dispoEYCambio=0; 
                $pedido->dispoEA=0;
                $pedido->dispoEY=0;
            }
            if($pedido->dispoEACambio != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEACambio)->update(['estado'=>'En Uso']); 
                $E=Equipo::where('idEquipo','LIKE',$dispoRevisar)->update(['estado'=>'Revisar']);
                $pedido->dispoEA=$pedido->dispoEACambio;
                $pedido->dispoERCambio=0;
                $pedido->dispoEACambio=0;
                $pedido->dispoEYCambio=0;
                $pedido->dispoER=0; 
                $pedido->dispoEY=0;
            }
            if($pedido->dispoEYCambio != 0){
                $E=Equipo::where('idEquipo','LIKE',$pedido->dispoEYCambio)->update(['estado'=>'En Uso']); 
                $E=Equipo::where('idEquipo','LIKE',$dispoRevisar)->update(['estado'=>'Revisar']);
                $pedido->dispoEY=$pedido->dispoEYCambio;
                $pedido->dispoERCambio=0;
                $pedido->dispoEACambio=0;
                $pedido->dispoEYCambio=0;
                $pedido->dispoER=0;
                $pedido->dispoEA=0; 
            }
            if($pedido->dispoT1Cambio != 0){
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1Cambio)->update(['estado'=>'En Uso']);
                $T1=Tubo::where('idTubo','LIKE',$pedido->dispoT1)->update(['estado'=>'Revisar']);
                $pedido->dispoT1=$pedido->dispoT1Cambio;
                $pedido->dispoT1Cambio=0;
            }
            if($pedido->dispoT415Cambio != 0){
                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415Cambio)->update(['estado'=>'En Uso']);
                $T415=Tubo::where('idTubo','LIKE',$pedido->dispoT415)->update(['estado'=>'Revisar']);
                $pedido->dispoT415=$pedido->dispoT415Cambio;
                $pedido->dispoT415Cambio=0;
            }
            if($pedido->dispoOCambio != 0){
                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoOCambio)->update(['estado'=>'En Uso']);
                $O=Oximetro::where('idOximetro','LIKE',$pedido->dispoO)->update(['estado'=>'Revisar']);
                $pedido->dispoO=$pedido->dispoOCambio;
                $pedido->dispoOCambio=0;
            } 
        $pedido->save();
 
        return redirect('/adminCambiosH')->with('mensaje','El Cambio fue  Realizado Exitosamente'); 
        }

    }   

     
    public function modificarOrden(Request $request,$idUsuario){
        $orden=$request->orden;
        $ordenCalendario=$request->ordenCalendario;

         //dd($orden,$ordenCalendario,$idUsuario,count($orden),$ordenCalendario[0]);
        $calendario=Calendario::where('idUsuario','LIKE',$idUsuario)->get();

        for ($i=0; $i < count($orden); $i++) { 
            foreach ($calendario as $calen) {
                if($calen->idCalendario==$ordenCalendario[$i]){
                    $calen->orden=$orden[$i];
                    $calen->save();
                }
            }
        }
         
        return redirect('/adminCalendario')
        ->with('mensaje','Orden Guardado Correctamente');

    }
    
}