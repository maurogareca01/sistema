<?php

namespace App\Http\Controllers;
use App\Models\Dispoequipos;
use App\Models\Dispotubos;
use App\Models\Dispooximetros;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Tubo;
use App\Models\Oximetro;
use App\Models\Servicio;
use PhpParser\Node\Stmt\Foreach_;

class DisponibilidadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    
    public function adminServiciosActua(Request $request){
        
         
        //////////////////EQUIPOS CONCENTRADORES RESPIRONICS///////////////



        $countDisponibleR = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Respironics')->count();
        $countEnUsoR = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Respironics')->count();
        $countReservadoR = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Respironics')->count();
        $countRevisarR = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Respironics')->count();
        $countReparacionR = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Respironics')->count();
        $countEntregarR= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Respironics')->count();
        $countRetirarR= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Respironics')->count();
        $countTotalR=$countDisponibleR+$countEnUsoR+$countReservadoR+$countRevisarR+$countReparacionR+$countEntregarR+$countRetirarR;
        $dispoeR=Dispoequipos::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponibleR,
                'enUsoDispo' => $countEnUsoR,
                'reserDispo' => $countReservadoR,
                'revisarDispo' => $countRevisarR,
                'reparacionDispo' => $countReparacionR,
                'entregarDispo'=>$countEntregarR,
                'retirarDispo'=>$countRetirarR,
                'totalDispo' => $countTotalR
                ]);
         

        //////////////////EQUIPOS CONCENTRADORES AIRSEP///////////////

        $countDisponibleA = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Airsep')->count();
        $countEnUsoA = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Airsep')->count();
        $countReservadoA = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Airsep')->count();
        $countRevisarA = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Airsep')->count();
        $countReparacionA = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Airsep')->count();
        $countEntregarA= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Airsep')->count();
        $countRetirarA= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Airsep')->count();
        $countTotalA=$countDisponibleA+$countEnUsoA+$countReservadoA+$countRevisarA+$countReparacionA+$countEntregarA+$countRetirarA;
        $dispoeA=Dispoequipos::where('idDispo', 'LIKE',2)->update(
            [
                'siDispo' => $countDisponibleA,
                'enUsoDispo' => $countEnUsoA,
                'reserDispo' => $countReservadoA,
                'revisarDispo' => $countRevisarA,
                'reparacionDispo' => $countReparacionA,
                'entregarDispo'=>$countEntregarA,
                'retirarDispo'=>$countRetirarA,
                'totalDispo' => $countTotalA
                ]);
               

        //////////////////EQUIPOS CONCENTRADORES YUWELL///////////////

        $countDisponibleY = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Yuwell')->count();
        $countEnUsoY = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Yuwell')->count();
        $countReservadoY = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Yuwell')->count();
        $countRevisarY = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Yuwell')->count();
        $countReparacionY = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Yuwell')->count();
        $countEntregarY= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Yuwell')->count();
        $countRetirarY= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Yuwell')->count();
        $countTotalY=$countDisponibleY+$countEnUsoY+$countReservadoY+$countRevisarY+$countReparacionY+$countEntregarY+$countRetirarY;
        $dispoeY=Dispoequipos::where('idDispo', 'LIKE',3)->update(
            [
                'siDispo' => $countDisponibleY,
                'enUsoDispo' => $countEnUsoY,
                'reserDispo' => $countReservadoY,
                'revisarDispo' => $countRevisarY,
                'reparacionDispo' => $countReparacionY,
                'entregarDispo'=>$countEntregarY,
                'retirarDispo'=>$countRetirarY,
                'totalDispo' => $countTotalY
                ]);
                
        $dispoequipos=Dispoequipos::get();   

        ////////////////////////TUBOS/////////////
        //////////////////COUNT DE 1 METRO///////////////
         

        $countDisponible680 = Tubo::where('estado', 'LIKE','Disponible')->where('descripcion', 'LIKE','680L')->count();
        $countEnUso680 = Tubo::where('estado', 'LIKE','En Uso')->where('descripcion', 'LIKE','680L')->count();
        $countReservado680 = Tubo::where('estado', 'LIKE','Reservado')->where('descripcion', 'LIKE','680L')->count();
        $countRevisar680 = Tubo::where('estado', 'LIKE','Revisar')->where('descripcion', 'LIKE','680L')->count();
        $countReparacion680= Tubo::where('estado', 'LIKE','Reparacion')->where('descripcion', 'LIKE','680L')->count();
        $countEntregar680= Tubo::where('estado', 'LIKE','Por Entregar')->where('descripcion', 'LIKE','680L')->count();
        $countRetirar680= Tubo::where('estado', 'LIKE','Por Retirar')->where('descripcion', 'LIKE','680L')->count();
        $countTotal680=$countDisponible680+$countEnUso680+$countReservado680+$countRevisar680+$countReparacion680+$countEntregar680+$countRetirar680;
        
        
        $dispoT680=Dispotubos::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponible680,
                'enUsoDispo' => $countEnUso680,
                'reserDispo' => $countReservado680,
                'revisarDispo' => $countRevisar680,
                'reparacionDispo' => $countReparacion680,
                'entregarDispo'=>$countEntregar680,
                'retirarDispo'=>$countRetirar680,
                'totalDispo' => $countTotal680
                ]);

        //////////////////COUNT DE 415///////////////
        $countDisponible415 = Tubo::where('estado', 'LIKE','Disponible')->where('descripcion', 'LIKE','415L')->count();
        $countEnUso415 = Tubo::where('estado', 'LIKE','En Uso')->where('descripcion', 'LIKE','415L')->count();
        $countReservado415 = Tubo::where('estado', 'LIKE','Reservado')->where('descripcion', 'LIKE','415L')->count();
        $countRevisar415 = Tubo::where('estado', 'LIKE','Revisar')->where('descripcion', 'LIKE','415L')->count();
        $countReparacion415= Tubo::where('estado', 'LIKE','Reparacion')->where('descripcion', 'LIKE','415L')->count();
        $countEntregar415= Tubo::where('estado', 'LIKE','Por Entregar')->where('descripcion', 'LIKE','415L')->count();
        $countRetirar415= Tubo::where('estado', 'LIKE','Por Retirar')->where('descripcion', 'LIKE','415L')->count();
        $countTotal415=$countDisponible415+$countEnUso415+$countReservado415+$countRevisar415+$countReparacion415+ $countEntregar415+ $countRetirar415;
        
        
        $dispoe=Dispotubos::where('idDispo', 'LIKE',2)->update(
            [
                'siDispo' => $countDisponible415,
                'enUsoDispo' => $countEnUso415,
                'reserDispo' => $countReservado415, 
                'revisarDispo' => $countRevisar415,
                'reparacionDispo' => $countReparacion415,
                'entregarDispo'=>$countEntregar415,
                'retirarDispo'=>$countRetirar415,
                'totalDispo' => $countTotal415
                ]);


        $dispotubos=Dispotubos::get();   
        
        
        //////////////////OXIMETROS///////////////

        
        $countDisponibleO = Oximetro::where('estado', 'LIKE','Disponible')->count();
        $countEnUsuO = Oximetro::where('estado', 'LIKE','En Uso')->count();
        $countReservadoO = Oximetro::where('estado', 'LIKE','Reservado')->count();
        $countRevisarO = Oximetro::where('estado', 'LIKE','Revisar')->count();
        $countReparacionO = Oximetro::where('estado', 'LIKE','Reparacion')->count();
        $countEntregarO= Oximetro::where('estado', 'LIKE','Por Entregar')->count();
        $countRetirarO= Oximetro::where('estado', 'LIKE','Por Retirar')->count();
        $countTotalO=$countDisponibleO+$countEnUsuO+$countReservadoO+$countRevisarO+$countReparacionO+$countEntregarO+$countRetirarO;
        $dispoe=Dispooximetros::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponibleO,
                'enUsoDispo' => $countEnUsuO,
                'reserDispo' => $countReservadoO,
                'revisarDispo' => $countRevisarO,
                'reparacionDispo' => $countReparacionO,
                'entregarDispo'=>$countEntregarO,
                'retirarDispo'=>$countRetirarO,
                'totalDispo' => $countTotalO
                ]);
                
        $dispooximetros=Dispooximetros::get();        

    }
    public function listarDispo(Request $request){
 

        //////////////////EQUIPOS CONCENTRADORES RESPIRONICS///////////////



        $countDisponibleR = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Respironics')->count();
        $countEnUsoR = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Respironics')->count();
        $countReservadoR = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Respironics')->count();
        $countRevisarR = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Respironics')->count();
        $countReparacionR = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Respironics')->count();
        $countEntregarR= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Respironics')->count();
        $countRetirarR= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Respironics')->count();
        $countTotalR=$countDisponibleR+$countEnUsoR+$countReservadoR+$countRevisarR+$countReparacionR+$countEntregarR+$countRetirarR;
        $dispoeR=Dispoequipos::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponibleR,
                'enUsoDispo' => $countEnUsoR,
                'reserDispo' => $countReservadoR,
                'revisarDispo' => $countRevisarR,
                'reparacionDispo' => $countReparacionR,
                'entregarDispo'=>$countEntregarR,
                'retirarDispo'=>$countRetirarR,
                'totalDispo' => $countTotalR
                ]);
         

        //////////////////EQUIPOS CONCENTRADORES AIRSEP///////////////

        $countDisponibleA = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Airsep')->count();
        $countEnUsoA = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Airsep')->count();
        $countReservadoA = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Airsep')->count();
        $countRevisarA = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Airsep')->count();
        $countReparacionA = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Airsep')->count();
        $countEntregarA= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Airsep')->count();
        $countRetirarA= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Airsep')->count();
        $countTotalA=$countDisponibleA+$countEnUsoA+$countReservadoA+$countRevisarA+$countReparacionA+$countEntregarA+$countRetirarA;
        $dispoeA=Dispoequipos::where('idDispo', 'LIKE',2)->update(
            [
                'siDispo' => $countDisponibleA,
                'enUsoDispo' => $countEnUsoA,
                'reserDispo' => $countReservadoA,
                'revisarDispo' => $countRevisarA,
                'reparacionDispo' => $countReparacionA,
                'entregarDispo'=>$countEntregarA,
                'retirarDispo'=>$countRetirarA,
                'totalDispo' => $countTotalA
                ]);
               
        $dispoequipos=Dispoequipos::get();            

        //////////////////EQUIPOS CONCENTRADORES YUWELL///////////////

        $countDisponibleY = Equipo::where('estado', 'LIKE','Disponible')->where('nombre', 'LIKE','Yuwell')->count();
        $countEnUsoY = Equipo::where('estado', 'LIKE','En Uso')->where('nombre', 'LIKE','Yuwell')->count();
        $countReservadoY = Equipo::where('estado', 'LIKE','Reservado')->where('nombre', 'LIKE','Yuwell')->count();
        $countRevisarY = Equipo::where('estado', 'LIKE','Revisar')->where('nombre', 'LIKE','Yuwell')->count();
        $countReparacionY = Equipo::where('estado', 'LIKE','Reparacion')->where('nombre', 'LIKE','Yuwell')->count();
        $countEntregarY= Equipo::where('estado', 'LIKE','Por Entregar')->where('nombre', 'LIKE','Yuwell')->count();
        $countRetirarY= Equipo::where('estado', 'LIKE','Por Retirar')->where('nombre', 'LIKE','Yuwell')->count();
        $countTotalY=$countDisponibleY+$countEnUsoY+$countReservadoY+$countRevisarY+$countReparacionY+$countEntregarY+$countRetirarY;
        $dispoeY=Dispoequipos::where('idDispo', 'LIKE',3)->update(
            [
                'siDispo' => $countDisponibleY,
                'enUsoDispo' => $countEnUsoY,
                'reserDispo' => $countReservadoY,
                'revisarDispo' => $countRevisarY,
                'reparacionDispo' => $countReparacionY,
                'entregarDispo'=>$countEntregarY,
                'retirarDispo'=>$countRetirarY,
                'totalDispo' => $countTotalY
                ]);
                
        $dispoequipos=Dispoequipos::get();   
        
        ////////////////////////TUBOS/////////////
        //////////////////COUNT DE 1 METRO///////////////
         

        $countDisponible680 = Tubo::where('estado', 'LIKE','Disponible')->where('descripcion', 'LIKE','680L')->count();
        $countEnUso680 = Tubo::where('estado', 'LIKE','En Uso')->where('descripcion', 'LIKE','680L')->count();
        $countReservado680 = Tubo::where('estado', 'LIKE','Reservado')->where('descripcion', 'LIKE','680L')->count();
        $countRevisar680 = Tubo::where('estado', 'LIKE','Revisar')->where('descripcion', 'LIKE','680L')->count();
        $countReparacion680= Tubo::where('estado', 'LIKE','Reparacion')->where('descripcion', 'LIKE','680L')->count();
        $countEntregar680= Tubo::where('estado', 'LIKE','Por Entregar')->where('descripcion', 'LIKE','680L')->count();
        $countRetirar680= Tubo::where('estado', 'LIKE','Por Retirar')->where('descripcion', 'LIKE','680L')->count();
        $countTotal680=$countDisponible680+$countEnUso680+$countReservado680+$countRevisar680+$countReparacion680+$countEntregar680+$countRetirar680;
        
        
        $dispoT680=Dispotubos::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponible680,
                'enUsoDispo' => $countEnUso680,
                'reserDispo' => $countReservado680,
                'revisarDispo' => $countRevisar680,
                'reparacionDispo' => $countReparacion680,
                'entregarDispo'=>$countEntregar680,
                'retirarDispo'=>$countRetirar680,
                'totalDispo' => $countTotal680
                ]);

        //////////////////COUNT DE 415///////////////
        $countDisponible415 = Tubo::where('estado', 'LIKE','Disponible')->where('descripcion', 'LIKE','415L')->count();
        $countEnUso415 = Tubo::where('estado', 'LIKE','En Uso')->where('descripcion', 'LIKE','415L')->count();
        $countReservado415 = Tubo::where('estado', 'LIKE','Reservado')->where('descripcion', 'LIKE','415L')->count();
        $countRevisar415 = Tubo::where('estado', 'LIKE','Revisar')->where('descripcion', 'LIKE','415L')->count();
        $countReparacion415= Tubo::where('estado', 'LIKE','Reparacion')->where('descripcion', 'LIKE','415L')->count();
        $countEntregar415= Tubo::where('estado', 'LIKE','Por Entregar')->where('descripcion', 'LIKE','415L')->count();
        $countRetirar415= Tubo::where('estado', 'LIKE','Por Retirar')->where('descripcion', 'LIKE','415L')->count();
        $countTotal415=$countDisponible415+$countEnUso415+$countReservado415+$countRevisar415+$countReparacion415+ $countEntregar415+ $countRetirar415;
        
        
        $dispoe=Dispotubos::where('idDispo', 'LIKE',2)->update(
            [
                'siDispo' => $countDisponible415,
                'enUsoDispo' => $countEnUso415,
                'reserDispo' => $countReservado415, 
                'revisarDispo' => $countRevisar415,
                'reparacionDispo' => $countReparacion415,
                'entregarDispo'=>$countEntregar415,
                'retirarDispo'=>$countRetirar415,
                'totalDispo' => $countTotal415
                ]);


        $dispotubos=Dispotubos::get();   
        
        
        //////////////////OXIMETROS///////////////

        
        $countDisponibleO = Oximetro::where('estado', 'LIKE','Disponible')->count();
        $countEnUsuO = Oximetro::where('estado', 'LIKE','En Uso')->count();
        $countReservadoO = Oximetro::where('estado', 'LIKE','Reservado')->count();
        $countRevisarO = Oximetro::where('estado', 'LIKE','Revisar')->count();
        $countReparacionO = Oximetro::where('estado', 'LIKE','Reparacion')->count();
        $countEntregarO= Oximetro::where('estado', 'LIKE','Por Entregar')->count();
        $countRetirarO= Oximetro::where('estado', 'LIKE','Por Retirar')->count();
        $countTotalO=$countDisponibleO+$countEnUsuO+$countReservadoO+$countRevisarO+$countReparacionO+$countEntregarO+$countRetirarO;
        $dispoe=Dispooximetros::where('idDispo', 'LIKE',1)->update(
            [
                'siDispo' => $countDisponibleO,
                'enUsoDispo' => $countEnUsuO,
                'reserDispo' => $countReservadoO,
                'revisarDispo' => $countRevisarO,
                'reparacionDispo' => $countReparacionO,
                'entregarDispo'=>$countEntregarO,
                'retirarDispo'=>$countRetirarO,
                'totalDispo' => $countTotalO
                ]);
                
        $dispooximetros=Dispooximetros::get();        



        //////////////////SERVICIOS///////////////


        /*VISTA DE SERVICIOS*/
    

        $buscar=trim($request->get('buscar'));
        
        $servicios = Servicio::get();
                
        if ($buscar){
            
            $servicios=Servicio::where('idServicio','LIKE','%'.$buscar.'%')->get();
            return view('adminServicios',['servicios'=>$servicios,'dispoequipos'=>$dispoequipos,'dispotubos'=>$dispotubos,'dispooximetros'=>$dispooximetros,'buscar'=>$buscar]);

        }
        else{
            return view('adminServicios',['servicios'=>$servicios,'dispoequipos'=>$dispoequipos,'dispotubos'=>$dispotubos,'dispooximetros'=>$dispooximetros]);

        }

    }


    public function agregarServicio(Request $request){
        
        $request->validate([
            //reglas de validacion
            
           'costoServ'=>'required|regex:/^[0-9]{1}\d{0,}$/',
           'garantia'=>'required|regex:/^[0-9]{1}\d{0,}$/',
           'concen'=>'required',
           'dispoT1'=>'required',
           'dispoT415'=>'required',
           'dispoO'=>'required',
           'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
                
            'costoServ.required'=>'El Costo es Obligatorio',
            'costoServ.regex'=>'El Costo es Incorrecto',
            'garantia.required'=>'La Garantia es Obligatoria',
            'garantia.regex'=>'La Garantia es Incorrecta',
            'concen.required'=>'Este Campo es Obligatorio',
            'dispoT1.required'=>'Este Campo es Obligatorio',
            'dispoT415.required'=>'Este Campo es Obligatorio',
            'dispoO.required'=>'Este Campo es Obligatorio',
        ]); /*
        if($request->concentradores){
            $concentradores = $request->concentradores;
            foreach($concentradores as $concentrador){
                if($concentrador=='respironics'){
                    $servicio=new Servicio();
                    
                    $servicio->costoServ=$request->costoServ;  
                    $servicio->garantia=$request->garantia;
                    $servicio->dispoER=1;    
                    $servicio->dispoEA=0;    
                    $servicio->dispoEY=0;    
                    $servicio->dispoT1=$request->dispoT1;    
                    $servicio->dispoT415=$request->dispoT415;    
                    $servicio->dispoO=$request->dispoO;    

                

                    $nombre=''; 
                    $descripcion=''; 

                    if($servicio->dispoER==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'RES';
                            $descripcion=$descripcion.', '.'Concen. Respironics';
                        }else{
                            $nombre='RES';
                            $descripcion='Concen. Respironics';
                        }
                    }

                    if($servicio->dispoT1==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T680L';
                            $descripcion=$descripcion.', '.'Tubo 680 Litros';
                        }else{
                            $nombre='T680L';
                            $descripcion='Tubo 680 Litros';
                        }
                    }
                    if($servicio->dispoT415==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T415L';
                            $descripcion=$descripcion.', '.'Tubo 415 Litros';

                        }else{
                            $nombre='T415L';
                            $descripcion='Tubo 415 Litros';
                        }
                    }
                    if($servicio->dispoO==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'OXI';
                            $descripcion=$descripcion.', '.'Oximetro';
                        }else{
                            $nombre='OXI';
                            $descripcion='Oximetro';
                        }
                    }

                    $servicio->descripcion=$descripcion; 
                    $servicio->nombreServ=$nombre; 

                    

                    $servicio->save(); 
                }
                if($concentrador=='airsep'){
                    $servicio=new Servicio();
                    
                    $servicio->costoServ=$request->costoServ;  
                    $servicio->garantia=$request->garantia;
                    $servicio->dispoER=0;    
                    $servicio->dispoEA=1;    
                    $servicio->dispoEY=0;    
                    $servicio->dispoT1=$request->dispoT1;    
                    $servicio->dispoT415=$request->dispoT415;    
                    $servicio->dispoO=$request->dispoO;    

                

                    $nombre=''; 
                    $descripcion=''; 

                    if($servicio->dispoEA==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'ARS';
                            $descripcion=$descripcion.', '.'Concen. Airsep';
                        }else{
                            $nombre='ARS';
                            $descripcion='Concen. Airsep';
                        }
                    }

                    if($servicio->dispoT1==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T680L';
                            $descripcion=$descripcion.', '.'Tubo 680 Litros';
                        }else{
                            $nombre='T680L';
                            $descripcion='Tubo 680 Litros';
                        }
                    }
                    if($servicio->dispoT415==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T415L';
                            $descripcion=$descripcion.', '.'Tubo 415 Litros';

                        }else{
                            $nombre='T415L';
                            $descripcion='Tubo 415 Litros';
                        }
                    }
                    if($servicio->dispoO==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'OXI';
                            $descripcion=$descripcion.', '.'Oximetro';
                        }else{
                            $nombre='OXI';
                            $descripcion='Oximetro';
                        }
                    }

                    $servicio->descripcion=$descripcion; 
                    $servicio->nombreServ=$nombre; 
    

                    $servicio->save(); 
                }
                if($concentrador=='yuwell'){
                    $servicio=new Servicio();
                    
                    $servicio->costoServ=$request->costoServ;  
                    $servicio->garantia=$request->garantia;
                    $servicio->dispoER=0;    
                    $servicio->dispoEA=0;    
                    $servicio->dispoEY=1;    
                    $servicio->dispoT1=$request->dispoT1;    
                    $servicio->dispoT415=$request->dispoT415;    
                    $servicio->dispoO=$request->dispoO;    

                

                    $nombre=''; 
                    $descripcion=''; 

                    if($servicio->dispoEY==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'YUW';
                            $descripcion=$descripcion.', '.'Concen. Yuwell';
                        }else{
                            $nombre='YUW';
                            $descripcion='Concen. Yuwell';
                        }
                    }

                    if($servicio->dispoT1==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T680L';
                            $descripcion=$descripcion.', '.'Tubo 680 Litros';
                        }else{
                            $nombre='T680L';
                            $descripcion='Tubo 680 Litros';
                        }
                    }
                    if($servicio->dispoT415==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T415L';
                            $descripcion=$descripcion.', '.'Tubo 415 Litros';

                        }else{
                            $nombre='T415L';
                            $descripcion='Tubo 415 Litros';
                        }
                    }
                    if($servicio->dispoO==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'OXI';
                            $descripcion=$descripcion.', '.'Oximetro';
                        }else{
                            $nombre='OXI';
                            $descripcion='Oximetro';
                        }
                    }

                    $servicio->descripcion=$descripcion; 
                    $servicio->nombreServ=$nombre; 
    

                    $servicio->save(); 
                }
            } 
        }else{
            $servicio=new Servicio();
                
            $servicio->costoServ=$request->costoServ;  
            $servicio->garantia=$request->garantia;
            $servicio->dispoER=0;    
            $servicio->dispoEA=0;    
            $servicio->dispoEY=0;    
            $servicio->dispoT1=$request->dispoT1;    
            $servicio->dispoT415=$request->dispoT415;    
            $servicio->dispoO=$request->dispoO;    

            $nombre=''; 
            $descripcion=''; 
            if($servicio->dispoT1==1){
                $nombre='T680L';
                $descripcion='Tubo 680 Litros';
            }
            if($servicio->dispoT415==1){
                if($nombre!=''){
                    $nombre=$nombre.' + '.'T415L';
                    $descripcion=$descripcion.', '.'Tubo 415 Litros';

                }else{
                    $nombre='T415L';
                    $descripcion='Tubo 415 Litros';
                }
            }
            if($servicio->dispoO==1){
                if($nombre!=''){
                    $nombre=$nombre.' + '.'OXI';
                    $descripcion=$descripcion.', '.'Oximetro';
                }else{
                    $nombre='OXI';
                    $descripcion='Oximetro';
                }
            }
            $servicio->descripcion=$descripcion; 
            $servicio->nombreServ=$nombre;          
            $servicio->save();
        } */


        $servicio=new Servicio();
        $servicio->costoServ=$request->costoServ;  
        $servicio->garantia=$request->garantia; 

        $nombre=''; 
        $descripcion=''; 

        if($request->concen==1){
            $servicio->dispoER=1;    
            $servicio->dispoEA=1;    
            $servicio->dispoEY=1;    
            $nombre='CON'; 
            $descripcion='Concentrador'; 
        }else{
            $servicio->dispoER=0;    
            $servicio->dispoEA=0;    
            $servicio->dispoEY=0;
        }

        $servicio->dispoT1=$request->dispoT1;    
        $servicio->dispoT415=$request->dispoT415;    
        $servicio->dispoO=$request->dispoO;

        if($servicio->dispoT1==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'T680L';
                $descripcion=$descripcion.', '.'Tubo 680 Litros';
            }else{
                $nombre='T680L';
                $descripcion='Tubo 680 Litros';
            }
        }
        if($servicio->dispoT415==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'T415L';
                $descripcion=$descripcion.', '.'Tubo 415 Litros';

            }else{
                $nombre='T415L';
                $descripcion='Tubo 415 Litros';
            }
        }
        if($servicio->dispoO==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'OXI';
                $descripcion=$descripcion.', '.'Oximetro';
            }else{
                $nombre='OXI';
                $descripcion='Oximetro';
            }
        }
        $servicio->nombreServ=$nombre;
        $servicio->descripcion=$descripcion;
        $servicio->save(); 

 

        /*
            if ($request->file('imgServ')){ 
                    $archivo=$request->file('imgServ');

                    $extension=$archivo->getClientOriginalExtension();//extencion
                    $imgServ=substr($archivo->getClientOriginalName(),0,-4);  
                    $imgServ=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
                    //MOVER EL ARCHIVO
                    $archivo->move(public_path('img/'), $imgServ );  // public_path ES LA CARPETA 'PUBLIC'

                    $servicio->imgServ=$imgServ;
                } 
        */

        return redirect('/adminServicios')
        ->with('mensaje','Servicio Agregado Correctamente'); 
    }


    public function verModificarServicio($id){
        $servicio=Servicio::find($id);
        return view('formModificarServicio',['servicio'=>$servicio]);

    }

    public function modificarServicio(Request $request,$idServicio){
         
        ///ME QUEDE ACA    
        $request->validate([
            //reglas de validacion
            
           'costoServ'=>'required|regex:/^[0-9]{1}\d{0,}$/',
           'garantia'=>'required|regex:/^[0-9]{1}\d{0,}$/',
           'concen'=>'required',
           'dispoT1'=>'required',
           'dispoT415'=>'required',
           'dispoO'=>'required',
           'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
                
            'costoServ.required'=>'El Costo es Obligatorio',
            'costoServ.regex'=>'El Costo es Incorrecto',
            'garantia.required'=>'La Garantia es Obligatoria',
            'garantia.regex'=>'La Garantia es Incorrecta',
            'concen.required'=>'Este Campo es Obligatorio',
            'dispoT1.required'=>'Este Campo es Obligatorio',
            'dispoT415.required'=>'Este Campo es Obligatorio',
            'dispoO.required'=>'Este Campo es Obligatorio',
        ]);
        $servicio=Servicio::find($idServicio);
        /*
                if($request->concentradores){
                    $concentradores = $request->concentradores;
                    foreach($concentradores as $concentrador){
                        if($concentrador=='respironics'){
                            
                            $servicio->costoServ=$request->costoServ;  
                            $servicio->garantia=$request->garantia;
                            $servicio->dispoER=1;    
                            $servicio->dispoEA=0;    
                            $servicio->dispoEY=0;    
                            $servicio->dispoT1=$request->dispoT1;    
                            $servicio->dispoT415=$request->dispoT415;    
                            $servicio->dispoO=$request->dispoO;    

                        

                            $nombre=''; 
                            $descripcion=''; 

                            if($servicio->dispoER==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'RES';
                                    $descripcion=$descripcion.', '.'Concen. Respironics';
                                }else{
                                    $nombre='RES';
                                    $descripcion='Concen. Respironics';
                                }
                            }

                            if($servicio->dispoT1==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T680L';
                                    $descripcion=$descripcion.', '.'Tubo 680 Litros';
                                }else{
                                    $nombre='T680L';
                                    $descripcion='Tubo 680 Litros';
                                }
                            }
                            if($servicio->dispoT415==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T415L';
                                    $descripcion=$descripcion.', '.'Tubo 415 Litros';

                                }else{
                                    $nombre='T415L';
                                    $descripcion='Tubo 415 Litros';
                                }
                            }
                            if($servicio->dispoO==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'OXI';
                                    $descripcion=$descripcion.', '.'Oximetro';
                                }else{
                                    $nombre='OXI';
                                    $descripcion='Oximetro';
                                }
                            }

                            $servicio->descripcion=$descripcion; 
                            $servicio->nombreServ=$nombre; 

                            

                            $servicio->save(); 
                        }
                        if($concentrador=='airsep'){
                            
                            $servicio->costoServ=$request->costoServ;  
                            $servicio->garantia=$request->garantia;
                            $servicio->dispoER=0;    
                            $servicio->dispoEA=1;    
                            $servicio->dispoEY=0;    
                            $servicio->dispoT1=$request->dispoT1;    
                            $servicio->dispoT415=$request->dispoT415;    
                            $servicio->dispoO=$request->dispoO;    

                        

                            $nombre=''; 
                            $descripcion=''; 

                            if($servicio->dispoEA==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'ARS';
                                    $descripcion=$descripcion.', '.'Concen. Airsep';
                                }else{
                                    $nombre='ARS';
                                    $descripcion='Concen. Airsep';
                                }
                            }

                            if($servicio->dispoT1==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T680L';
                                    $descripcion=$descripcion.', '.'Tubo 680 Litros';
                                }else{
                                    $nombre='T680L';
                                    $descripcion='Tubo 680 Litros';
                                }
                            }
                            if($servicio->dispoT415==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T415L';
                                    $descripcion=$descripcion.', '.'Tubo 415 Litros';

                                }else{
                                    $nombre='T415L';
                                    $descripcion='Tubo 415 Litros';
                                }
                            }
                            if($servicio->dispoO==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'OXI';
                                    $descripcion=$descripcion.', '.'Oximetro';
                                }else{
                                    $nombre='OXI';
                                    $descripcion='Oximetro';
                                }
                            }

                            $servicio->descripcion=$descripcion; 
                            $servicio->nombreServ=$nombre; 
            

                            $servicio->save(); 
                        }
                        if($concentrador=='yuwell'){
                            
                            $servicio->costoServ=$request->costoServ;  
                            $servicio->garantia=$request->garantia;
                            $servicio->dispoER=0;    
                            $servicio->dispoEA=0;    
                            $servicio->dispoEY=1;    
                            $servicio->dispoT1=$request->dispoT1;    
                            $servicio->dispoT415=$request->dispoT415;    
                            $servicio->dispoO=$request->dispoO;    

                        

                            $nombre=''; 
                            $descripcion=''; 

                            if($servicio->dispoEY==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'YUW';
                                    $descripcion=$descripcion.', '.'Concen. Yuwell';
                                }else{
                                    $nombre='YUW';
                                    $descripcion='Concen. Yuwell';
                                }
                            }

                            if($servicio->dispoT1==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T680L';
                                    $descripcion=$descripcion.', '.'Tubo 680 Litros';
                                }else{
                                    $nombre='T680L';
                                    $descripcion='Tubo 680 Litros';
                                }
                            }
                            if($servicio->dispoT415==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'T415L';
                                    $descripcion=$descripcion.', '.'Tubo 415 Litros';

                                }else{
                                    $nombre='T415L';
                                    $descripcion='Tubo 415 Litros';
                                }
                            }
                            if($servicio->dispoO==1){
                                if($nombre!=''){
                                    $nombre=$nombre.' + '.'OXI';
                                    $descripcion=$descripcion.', '.'Oximetro';
                                }else{
                                    $nombre='OXI';
                                    $descripcion='Oximetro';
                                }
                            }

                            $servicio->descripcion=$descripcion; 
                            $servicio->nombreServ=$nombre; 
            

                            $servicio->save(); 
                        }
                    } 
                }else{
                        
                    $servicio->costoServ=$request->costoServ;  
                    $servicio->garantia=$request->garantia;
                    $servicio->dispoER=0;    
                    $servicio->dispoEA=0;    
                    $servicio->dispoEY=0;    
                    $servicio->dispoT1=$request->dispoT1;    
                    $servicio->dispoT415=$request->dispoT415;    
                    $servicio->dispoO=$request->dispoO;    

                    $nombre=''; 
                    $descripcion=''; 
                    if($servicio->dispoT1==1){
                        $nombre='T680L';
                        $descripcion='Tubo 680 Litros';
                    }
                    if($servicio->dispoT415==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'T415L';
                            $descripcion=$descripcion.', '.'Tubo 415 Litros';

                        }else{
                            $nombre='T415L';
                            $descripcion='Tubo 415 Litros';
                        }
                    }
                    if($servicio->dispoO==1){
                        if($nombre!=''){
                            $nombre=$nombre.' + '.'OXI';
                            $descripcion=$descripcion.', '.'Oximetro';
                        }else{
                            $nombre='OXI';
                            $descripcion='Oximetro';
                        }
                    }
                    $servicio->descripcion=$descripcion; 
                    $servicio->nombreServ=$nombre;          

                    $servicio->save();
                } 
        */


        $servicio->costoServ=$request->costoServ;  
        $servicio->garantia=$request->garantia; 

        $nombre=''; 
        $descripcion=''; 

        if($request->concen==1){
            $servicio->dispoER=1;    
            $servicio->dispoEA=1;    
            $servicio->dispoEY=1;    
            $nombre='CON'; 
            $descripcion='Concentrador'; 
        }else{
            $servicio->dispoER=0;    
            $servicio->dispoEA=0;    
            $servicio->dispoEY=0;
        }

        $servicio->dispoT1=$request->dispoT1;    
        $servicio->dispoT415=$request->dispoT415;    
        $servicio->dispoO=$request->dispoO;

        if($servicio->dispoT1==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'T680L';
                $descripcion=$descripcion.', '.'Tubo 680 Litros';
            }else{
                $nombre='T680L';
                $descripcion='Tubo 680 Litros';
            }
        }
        if($servicio->dispoT415==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'T415L';
                $descripcion=$descripcion.', '.'Tubo 415 Litros';

            }else{
                $nombre='T415L';
                $descripcion='Tubo 415 Litros';
            }
        }
        if($servicio->dispoO==1){
            if($nombre!=''){
                $nombre=$nombre.' + '.'OXI';
                $descripcion=$descripcion.', '.'Oximetro';
            }else{
                $nombre='OXI';
                $descripcion='Oximetro';
            }
        }
        $servicio->nombreServ=$nombre;
        $servicio->descripcion=$descripcion;



        if ($request->file('imgServ')){ 
            $archivo=$request->file('imgServ');

            $extension=$archivo->getClientOriginalExtension();//extencion
            $imgServ=substr($archivo->getClientOriginalName(),0,-4);  
            $imgServ=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgServ );  // public_path ES LA CARPETA 'PUBLIC'

            $servicio->imgServ=$imgServ;

        } 

        $servicio->save();  

        return redirect('/adminServicios')
        ->with('mensaje3','Servicio Modificado Correctamente'); 
    }


    public function eliminarServicio($id)
    {
        $servicio=Servicio::find($id);
        $servicio->delete();

        return redirect('/adminServicios')
        ->with('mensaje3','Servicio Eliminado Correctamente');  

    }
}
