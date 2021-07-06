<?php

namespace App\Http\Controllers;

use App\Models\Finanza;
use Illuminate\Http\Request;
use App\Models\Garantia;
use App\Models\Finanzas;
use App\Models\Cajas;
use App\Models\DesgloseActivos;
use App\Models\User; 
use App\Models\CostoFijo; 
use App\Models\DesgloseFondoHH; 

class GarantiaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    

    public function verGarantias(Request $request){

        $buscar=trim($request->get('buscar'));
        $garantias=Garantia::where('estado','LIKE','Activa')->paginate(14); 

        $garantiaTotal=0;
        foreach($garantias as $garan){
            $garantiaTotal=$garan->monto+$garantiaTotal;
        }  
 
        
        $garantias=Garantia::where('estado','LIKE','Activa')->orderBy('idGarantia', 'DESC')->paginate(14); 
        if ($buscar){

            $garantias=Garantia::where('idPedido','LIKE','%'.$buscar.'%')->orderBy('idGarantia', 'DESC')->paginate(10);
            return view('adminGaran-Finan',['garantias'=>$garantias,'buscar'=>$buscar,'garantiaTotal'=>$garantiaTotal]);
        }
        else{
            return view('adminGaran-Finan',['garantias'=>$garantias,'garantiaTotal'=>$garantiaTotal]); 
        } 
    }

    public function adminDesglose(Request $request){
        
        $buscar=trim($request->get('buscar'));
        $buscarSalida=trim($request->get('buscarSalida'));

        $usuarios=User::where('rol','=','admin')->paginate(14); 
        $usuActivos=User::where('rol','=','admin')->where('activos','>',0)->get(); 
         
        $desgloseActivos=DesgloseActivos::where('estado','LIKE','Visible')->orderBy('idDesglose', 'DESC')->paginate(14); 

        $cajaSalidas=Cajas::where('tipo','LIKE','garantiaActivas')->orderBy('idSalida', 'DESC')->paginate(20); 

        $costoFijo=CostoFijo::paginate(20);   
        $sueldos=User::sum('sueldo');
        $fondoHH=DesgloseFondoHH::first(); 

        $garantias=Garantia::get(); 
        $garantiaTotal=0;
        foreach($garantias as $garan){
            $garantiaTotal=$garan->monto+$garantiaTotal;
        } 


        if ($buscar || $buscarSalida){
            $desgloseActivos=DesgloseActivos::where('idDesglose','LIKE','%'.$buscar.'%')
            ->where('estado','LIKE','Visible')->paginate(14);  

            $cajaSalidas=Cajas::where('idSalida','LIKE','%'.$buscarSalida.'%')->paginate(10);

            return view('adminDesglose',['usuarios'=>$usuarios,'usuActivos'=>$usuActivos,'garantiaTotal'=>$garantiaTotal,'desgloseActivos'=>$desgloseActivos,'buscar'=>$buscar,'buscarSalida'=>$buscarSalida,'cajaSalidas'=>$cajaSalidas,'costoFijo'=>$costoFijo,'sueldos'=>$sueldos,'fondoHH'=>$fondoHH]);

        }else{
            return view('adminDesglose',['usuarios'=>$usuarios,'usuActivos'=>$usuActivos,'garantiaTotal'=>$garantiaTotal,'desgloseActivos'=>$desgloseActivos,'cajaSalidas'=>$cajaSalidas,'costoFijo'=>$costoFijo,'sueldos'=>$sueldos,'fondoHH'=>$fondoHH]);
        }
    
    
    
    } 
    public function adminDesgloseArchivados(Request $request){
        
        $buscar=trim($request->get('buscar'));
        $buscarSalida=trim($request->get('buscarSalida'));

        $usuarios=User::where('rol','=','admin')->paginate(14); 
        $usuActivos=User::where('rol','=','admin')->where('activos','>',0)->get(); 
         
        $desgloseActivos=DesgloseActivos::where('estado','LIKE','Archivado')->paginate(14); 
        $cajaSalidas=Cajas::where('tipo','LIKE','garantiaActivas')->paginate(20);   
         
        $costoFijo=CostoFijo::paginate(20);   
        $sueldos=User::sum('sueldo');
        $fondoHH=DesgloseFondoHH::first();

        

        $garantias=Garantia::get(); 
        $garantiaTotal=0;
        foreach($garantias as $garan){
            $garantiaTotal=$garan->monto+$garantiaTotal;
        } 

        if ($buscar || $buscarSalida){
            $desgloseActivos=DesgloseActivos::where('idDesglose','LIKE','%'.$buscar.'%')
            ->where('estado','LIKE','Archivado')->paginate(14); 
            
            $cajaSalidas=Cajas::where('idSalida','LIKE','%'.$buscarSalida.'%')->paginate(10);
            return view('adminDesglose',['usuarios'=>$usuarios,'usuActivos'=>$usuActivos,'garantiaTotal'=>$garantiaTotal,'desgloseActivos'=>$desgloseActivos,'buscar'=>$buscar,'cajaSalidas'=>$cajaSalidas,'costoFijo'=>$costoFijo,'sueldos'=>$sueldos,'fondoHH'=>$fondoHH]);

        }else{
            return view('adminDesglose',['usuarios'=>$usuarios,'usuActivos'=>$usuActivos,'garantiaTotal'=>$garantiaTotal,'desgloseActivos'=>$desgloseActivos,'cajaSalidas'=>$cajaSalidas,'costoFijo'=>$costoFijo,'sueldos'=>$sueldos,'fondoHH'=>$fondoHH]);
        }
    
    
    
    } 

    public function formModificarGarantiasUsuarios($idUsuario){


        $usuario=User::find($idUsuario);

        if($usuario->tipo=='Usuario Operacional' || $usuario->tipo=='Control de Efectivo'){

            $usuarios=User::where('rol','=','admin')->paginate(14); 

            $garantias=Garantia::get(); 
            $garantiaTotal=0;
            foreach($garantias as $garan){
                $garantiaTotal=$garan->monto+$garantiaTotal;
            } 

            return view('adminDesglose',['usuarios'=>$usuarios,'garantiaTotal'=>$garantiaTotal]);

        }else{
 
            return view('formModificarGarantiasUsuarios',['usuario'=>$usuario]);
        }


    }

    public function modificarGarantiaActiva(Request $request){
         

        $usuario=User::find($request->idUsuario);
 
        $usuario->fci=$request->fci;
        $usuario->porcenFci=$request->fciChange;

        $usuario->plazoFijo=$request->plazoFijo;
        $usuario->porcenPlazoFijo=$request->plazoFijoChange;

        $usuario->activos=$request->activos;
        $usuario->efectivo=$request->efectivo;
        $usuario->liquidasHoy=$request->fci;
        $usuario->save();

        return redirect('/adminDesglose')
        ->with('mensaje','Actualizacion Realizada Correctamente'); 
    }
    
    public function verFinanzas(Request $request){

        $buscar=trim($request->get('buscar'));
        $finanzas=Finanza::where('estado','LIKE','Activa')->orderBy('idFinanza', 'DESC')->paginate(14); 
        $garantias=Garantia::where('estado','LIKE','Activa')->paginate(14); 

        $garantiaTotal=0;
        foreach($garantias as $garan){
            $garantiaTotal=$garan->monto+$garantiaTotal;
        }  
 
        if ($buscar){

            $finanzas=Finanza::where('idPedido','LIKE','%'.$buscar.'%')->orderBy('idFinanza', 'DESC')->paginate(10);
            return view('adminFinanzas',['finanzas'=>$finanzas,'buscar'=>$buscar,'garantiaTotal'=>$garantiaTotal]);
        }
        else{
            return view('adminFinanzas',['finanzas'=>$finanzas,'garantiaTotal'=>$garantiaTotal]); 
        } 
    }


    public function agregarDesgloseActivo(Request $request){

        $request->validate([   

           'cuenta'=>'required',
           'reponer'=>'required|regex:/^[1-9]{1}\d{0,}$/',
           'descripcion'=>'required',
           'medioPagoDesglose'=>'required', 
            
        ],[
            'cuenta.required'=>'El Usuario es Obligatorio',
            'reponer.required'=>'El Dinero es Obligatorio',
            'reponer.regex'=>'El Dinero es Incorrecto',
            'descripcion.required'=>'La Descripcion es Obligatoria',
            'medioPagoDesglose.required'=>'El Medio de Pago es Obligatorio',
        ]);


        $desgloseActivos=new DesgloseActivos(); 
        $desgloseActivos->fecha=$request->fecha;
        $desgloseActivos->altaUsuario=$request->usuario;

        $user=User::find($request->cuenta);
        $desgloseActivos->idReponeUsuario=$request->cuenta;
        $desgloseActivos->reponeUsuario=$user->name.' '.$user->apellido;

        $desgloseActivos->dinero=$request->reponer;
        $desgloseActivos->estado='Visible';
        $desgloseActivos->descripcion=$request->descripcion;
        $desgloseActivos->medioDePago=$request->medioPagoDesglose;
        $desgloseActivos->save();

        $usuario=User::find($request->cuenta);

        $activos=$usuario->activos-$request->reponer;

        $usuario->activos=$activos;

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
    
            $usuario->liquidasHoy=$usuario->garantiaActiva - $activos;  
        }     


        if($usuario->liquidasHoy>0){
            $usuario->estado='ok';
        }
        $usuario->save();


        


        return redirect('/adminDesglose')
            ->with('mensaje2','Reposicion Agregada Correctamente'); 
    } 


    public function archivarReposicionDesgloseActivo($idDesglose){

        $desglose=DesgloseActivos::find($idDesglose);
        $desglose->estado='Archivado';
        $desglose->save();
        return redirect('adminDesglose')->with('mensaje5','La Reposicion fue Archivada Exitosamente');
    }


    /////////////////////////COSTO FIJOS////////////////////////////////

    public function agregarCostoFijo(Request $request){
        $request->validate([   

            'descripcion'=>'required',
            'valor'=>'required|regex:/^[1-9]{1}\d{0,}$/', 
             
         ],[
             'descripcion.required'=>'La Descripcion es Obligatoria',
             'valor.required'=>'El Costo es Obligatorio', 
             'valor.regex'=>'El Costo es Incorrecto', 
         ]);
            

         $costoFijo=new CostoFijo();
         $costoFijo->descripcion=$request->descripcion;
         $costoFijo->valor=$request->valor;
         $costoFijo->save();

        return redirect('adminDesglose')->with('mensaje6','El Costo Fijo fue Agregado Exitosamente');

    }
    public function formModificarCostoFijo($idCostoFijo){
        $costoFijo=CostoFijo::find($idCostoFijo);

        return view('formModificarCostoFijo',['costoFijo'=>$costoFijo]);
    }
    public function modificarCostoFijo(Request $request){
        $request->validate([   

            'descripcion'=>'required',
            'valor'=>'required|regex:/^[1-9]{1}\d{0,}$/', 
             
         ],[
             'descripcion.required'=>'La Descripcion es Obligatoria',
             'valor.required'=>'El Costo es Obligatorio', 
             'valor.regex'=>'El Costo es Incorrecto', 
         ]);
            

         $costoFijo=CostoFijo::find($request->idCostoFijo);
         $costoFijo->descripcion=$request->descripcion;
         $costoFijo->valor=$request->valor;
         $costoFijo->save();

        return redirect('adminDesglose')->with('mensaje7','El Costo Fijo fue Modificado Exitosamente');
    }

    public function eliminarCostoFijo($idCostoFijo){

        $costoFijo=CostoFijo::find($idCostoFijo);
 
        $costoFijo->delete();

        return redirect('/adminDesglose')
        ->with('mensaje8','Costo Fijo N°: '.$idCostoFijo. ' Eliminado Correctamente');
    }

    public function modificarFondoHH(Request $request){ 

        $request->validate([   
 
            'cash'=>'required|regex:/^[1-9]{1}\d{0,}$/', 
            'bank'=>'required|regex:/^[1-9]{1}\d{0,}$/', 
             
         ],[
            'cash.required'=>'El Cash es Obligatorio', 
            'cash.regex'=>'El Cash es Incorrecto', 
            'bank.required'=>'El Bank es Obligatorio', 
            'bank.regex'=>'El Bank es Incorrecto', 
         ]);
          

         $desgloseFondoHH=DesgloseFondoHH::find(1);
         $desgloseFondoHH->cash=$request->cash;
         $desgloseFondoHH->bank=$request->bank;
         $desgloseFondoHH->total=$request->cash + $request->bank;
         $desgloseFondoHH->save();

        return redirect('adminDesglose')->with('mensaje9','El Fondo HH fue Modificado Exitosamente');
    }

/*
    public function formModificarDesgloseActivos($idDesglose){

        $desgloseActivos=DesgloseActivos::find($idDesglose); 
        $usuarios=User::where('rol','=','admin')->where('activos','>',0)->get(); 
 



        return view('formModificarDesgloseActivos',['desgloseActivos'=>$desgloseActivos,'usuarios'=>$usuarios]);

    }   
    public function modificarDesgloseActivos(Request $request){

        $request->validate([   

            'cuenta'=>'required',
            'reponer'=>'required|regex:/^[1-9]{1}\d{0,}$/',
            'descripcion'=>'required',
            'medioPagoDesglose'=>'required', 
             
        ],[
            'cuenta.required'=>'El Usuario es Obligatorio',
            'reponer.required'=>'El Dinero es Obligatorio',
            'reponer.regex'=>'El Dinero es Incorrecto',
            'descripcion.required'=>'La Descripcion es Obligatoria',
            'medioPagoDesglose.required'=>'El Medio de Pago es Obligatorio',
        ]);

        $desgloseActivos=DesgloseActivos::find($request->idDesglose);  
         
        $user=User::find($request->cuenta);  
        $desgloseActivos->idReponeUsuario=$request->cuenta; 
        $desgloseActivos->reponeUsuario=$user->name.' '.$user->apellido; 

        $desgloseActivos->dinero=$request->reponer;
        $desgloseActivos->descripcion=$request->descripcion;
        $desgloseActivos->medioDePago=$request->medioPagoDesglose;
        $desgloseActivos->save();
        ///////////////////////


        $desgloseActivos=DesgloseActivos::find($request->idDesglose);  
        $userr=User::find($request->cuenta);
 
        $userr->activos=$desgloseActivos->activosMomento;
        $userr->activos=$userr->activos - $request->reponer;

        $liquidasHoy=$userr->garantiaActiva - $activos;   
        $userr->liquidasHoy=$liquidasHoy;

        $userr->save();

        return redirect('/adminDesglose')
        ->with('mensaje3','Reposicion N°: '.$request->idDesglose. ' Modificada Correctamente');
    } 
    public function eliminarDesgloseActivos(Request $request){
        $desgloseActivos=DesgloseActivos::find($request->idDesglose); 

        $desgloseActivos->delete();

        return redirect('/adminDesglose')
        ->with('mensaje4','Reposicion N°: '.$request->idDesglose. ' Eliminada Correctamente');
    } 
    public function desgloseVerElMaxDeUsuarioConActivo(Request $request){


        $desgloseActivos=DesgloseActivos::find($request->idDesglose);
        $user=User::find($request->cuenta);
        $array=[
            'user'=>$user,
            'desgloseActivos'=>$desgloseActivos
        ];

       return response(json_encode($array),200)->header('Content-type','text/plain');
    }
*/

} 
