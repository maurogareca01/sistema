<?php

namespace App\Http\Controllers;
use App\Models\Equipo;
use DateTime;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class EquiposController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    

    public function listarEquipos(Request $request)
    {   

        $equi = Equipo::get();
        foreach($equi as $equipo){
            if(!is_null($equipo->hsProxCam) && !is_null($equipo->hsAct)){
                if($equipo->hsProxCam >= $equipo->hsAct){
                    $equipo->vencido='No';
                    $equipo->save();
                }elseif($equipo->hsProxCam <= $equipo->hsAct){
                    if($equipo->estado=='Disponible'){
                        $equipo->vencido='Si';
                        $equipo->estado='Revisar';
                        $equipo->comentario='El Concentrador esta Vencido, necesita un Cambio';
                        $equipo->save();
                    }
                }
            }
        }
         
        
        $buscar=trim($request->get('buscar'));
        $equipos = Equipo::paginate(14);

        if ($buscar){

            $equipos=Equipo::where('idEquipo','LIKE','%'.$buscar.'%')->paginate(14);
            return view('adminEquipos',['equipos'=>$equipos,'buscar'=>$buscar]);
        }
        else{ 
            return view('adminEquipos',['equipos'=>$equipos ]);
        }
    }

    public function agregarEquipo(Request $request)
    {
        
        $request->validate([
            //reglas de validacion
            'nombre'=>'required',
            'concen2lpm'=>'required|numeric|regex:/^[\d]{1,2}(\.[\d]{1,2})?$/',
            'concen4lpm'=>'required|numeric|regex:/^[\d]{1,2}(\.[\d]{1,2})?$/',
            'estado'=>'required', 
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048',

            'hsCompra'=>'regex:/^[1-9]{1}\d{0,}$/|nullable',  
            'hsAct'=>'regex:/^[1-9]{1}\d{0,}$/|nullable',  
            'hsProxCam'=>'regex:/^[1-9]{1}\d{0,}$/|nullable',  
            'hsUltCam'=>'regex:/^[1-9]{1}\d{0,}$/|nullable',  
        ],[
            'nombre.required'=>'El Tipo/Nombre es Obligatorio',
            'concen2lpm.required'=>'La Concetracion de 2lpm es Obligatoria',
            'concen4lpm.required'=>'La Concetracion de 4lpm es Obligatoria',
            'estado.required'=>'La Disponibilidad es Obligatoria',
            
            'hsCompra.regex'=>'Las Horas de Compra debe ser mayor a 0',
            'hsUltCam.regex'=>'Las Horas de Compra debe ser mayor a 0',
            'hsAct.regex'=>'Las Horas Actuales debe ser mayor a 0',
            'hsProxCam.regex'=>'Las Horas del Proximo Cambio debe ser mayor a 0',
        ]);

         

        //RENOMBRA EL ARCHIVO

        $imgE='noDispo.jpg';    
        
        if ($request->file('imgE'))  { 
            $archivo=$request->file('imgE');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgE=substr($archivo->getClientOriginalName(),0,-4);  
            $imgE=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgE );  // public_path ES LA CARPETA 'PUBLIC'

            

        }

        $numSerie='S/N';    
        
        $equipo=new Equipo();


        if($request->numSerie){
            $equipo->numSerie=$request->numSerie;  
        }
        else{
            $equipo->numSerie=$numSerie;  
        }

        

        $equipo->hsCompra=$request->hsCompra; 
        $equipo->nombre=$request->nombre; 
        $equipo->hsCompra=$request->hsCompra;  
        $equipo->hsAct=$request->hsAct;  
        $equipo->hsUltCam=$request->hsUltCam;
        $equipo->hsProxCam=$request->hsProxCam;
        $equipo->psi=$request->psi;
        $equipo->concen2lpm=$request->concen2lpm;
        $equipo->concen4lpm=$request->concen4lpm;
        $equipo->mantenimiento=$request->mantenimiento; 
        $equipo->estado=$request->estado;

        $equipo->imgE=$imgE;
        $equipo->save();
        
        return redirect('/adminEquipos')
        ->with('mensaje','Concentrador Agregado Correctamente'); 
 
    }

    public function verModificarEquipo($id){

        $equipo=Equipo::find($id);
        return view('formModificarEquipo',['equipo'=>$equipo]);

    }
    
    public function modificarEquipo(Request $request){ 

        $request->validate([
            //reglas de validacion
            'nombre'=>'required',
            'concen2lpm'=>'required|numeric|regex:/^[\d]{1,2}(\.[\d]{1,2})?$/',
            'concen4lpm'=>'required|numeric|regex:/^[\d]{1,2}(\.[\d]{1,2})?$/',
            'estado'=>'required', 
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048',

            'hsCompra'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',  
            'hsUltCam'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',  
            'hsAct'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',  
            'hsProxCam'=>'regex:/^[0-9]{1}\d{0,}$/|nullable',  
        ],[
            'nombre.required'=>'El Tipo/Nombre es Obligatorio',
            'concen2lpm.required'=>'La Concetracion de 2lpm es Obligatoria',
            'concen4lpm.required'=>'La Concetracion de 4lpm es Obligatoria',
            'estado.required'=>'La Disponibilidad es Obligatoria',
            
            'hsCompra.regex'=>'Las Horas de Compra debe ser mayor a 0',
            'hsUltCam.regex'=>'Las Horas de Compra debe ser mayor a 0',
            'hsAct.regex'=>'Las Horas Actuales debe ser mayor a 0',
            'hsProxCam.regex'=>'Las Horas del Proximo Cambio debe ser mayor a 0',
        ]);

        

        $numSerie='S/N';    

        $equipo=Equipo::find($request->idEquipo);

        if($request->numSerie){
            $equipo->numSerie=$request->numSerie;  
        }
        else{
            $equipo->numSerie=$numSerie;  
        }
        $equipo->nombre=$request->nombre; 
        $equipo->hsCompra=$request->hsCompra; 
        $equipo->hsAct=$request->hsAct;  
        $equipo->hsUltCam=$request->hsUltCam;
        $equipo->hsProxCam=$request->hsProxCam;
        $equipo->psi=$request->psi;
        $equipo->concen2lpm=$request->concen2lpm;
        $equipo->concen4lpm=$request->concen4lpm;
        $equipo->mantenimiento=$request->mantenimiento;
        $equipo->comentario=$request->comentario;
        $equipo->estado=$request->estado;
         

        if ($request->file('imgE'))  { 
            $archivo=$request->file('imgE');

            $extension=$archivo->getClientOriginalExtension();//extencion
            $imgE=substr($archivo->getClientOriginalName(),0,-4);  
            $imgE=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgE );  // public_path ES LA CARPETA 'PUBLIC'
    
            $equipo->imgE=$imgE;

        }
        

        $equipo->save();


         return redirect('/adminEquipos')
        ->with('mensaje2','Concentrador Modificado Correctamente');  
    }

    public function eliminarEquipo($id)
    {
        $equipo=Equipo::find($id);
        $equipo->delete();

        return redirect('adminEquipos')
        ->with('mensaje3','Concentrador Eliminado Correctamente');  

    }


    public function cambiarEstadoEquipo($id){
        $equipo=Equipo::find($id);

        if($equipo->estado=='Revisar'){
            $equipo->estado='Reparacion';
            $equipo->save();

            if($equipo->nombre=='Respironics'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador R'.$id.' Cambio de estado Correctamente');
            }elseif($equipo->nombre=='Airsep'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador A'.$id.' Cambio de estado Correctamente');
            } elseif($equipo->nombre=='Yuwell'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador Y'.$id.' Cambio de estado Correctamente');
            }
        }
        elseif($equipo->estado=='Reparacion'){
            $equipo->estado='Disponible';
            $equipo->comentario='';
            if($equipo->vencido=='Si'){
                $equipo->vencido='No';
                $equipo->hsProxCam=$equipo->hsAct +1; ////FALTA POR HCER
            }
            $equipo->save();

            if($equipo->nombre=='Respironics'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador R'.$id.' Cambio de estado Correctamente');
            }elseif($equipo->nombre=='Airsep'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador A'.$id.' Cambio de estado Correctamente');
            }elseif($equipo->nombre=='Yuwell'){
                return redirect('/adminEquipos')->with('cambio','El Concentrador Y'.$id.' Cambio de estado Correctamente');
            }
        }

    }
}
