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
use App\Models\User; 
use Illuminate\Http\Request;

class RegistrosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    

        
    public function listarRegistros(Request $request){

        $Hoy= strtotime(date("d-m-Y"));
        $regi=Registro::where('estadoPedido','=','Entregado')->get();

        foreach($regi as $reg){
            $fecha= strtotime($reg->fechaFin);
            if($Hoy>=$fecha){
                $reg->estadoPedido='Vencido';
                $reg->save();
            }
        }

        $buscar=trim($request->get('buscar'));
        $registros=Registro:: where('estadoPedido','<>','Archivado')->orderBy('idPedido', 'DESC')->paginate(14);
        if ($buscar){

            $registros=Registro::where('idPedido','LIKE','%'.$buscar.'%')->orderBy('idPedido', 'DESC')->paginate(14);
            return view('adminRegistros',['registros'=>$registros,'buscar'=>$buscar]);
        }
        else{
            return view('adminRegistros',['registros'=>$registros]);

        }
    }
     
   
}
