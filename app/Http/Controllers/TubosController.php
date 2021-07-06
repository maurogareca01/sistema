<?php

namespace App\Http\Controllers;

use App\Models\Tubo;
use Illuminate\Http\Request;

class TubosController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    

    public function listarTubos(Request $request)
    { 
        //ACULIZA SI LA FECHA DE VENCIIMINETO DEL PH ES IGUAL ALA ACTUAL SE OPONE COMO VENCIDO

        $fechaHoy=strtotime(date("Y-m"));  
        $tub=Tubo::get();
        foreach($tub as $tubo){
            $proximoVencer=strtotime($tubo->proximoVencer);
            if($fechaHoy>=$proximoVencer){
                if($tubo->estado=='Disponible'){
                    $tubo->vencido='Si';
                    $tubo->estado='Revisar';
                    $tubo->comentario='El Tubo tiene Vencio el PH';
                    $tubo->save();
                }
            }
        } 
        $buscar=trim($request->get('buscar'));
        $tubos = Tubo::paginate(14);

        if ($buscar){

            $tubos=Tubo::where('idTubo','LIKE','%'.$buscar.'%')->paginate(14);
            return view('adminTubos',['tubos'=>$tubos,'buscar'=>$buscar]);
        }
        else{
            return view('adminTubos',['tubos'=>$tubos ]);
        }
    }

    public function agregarTubo(Request $request)
    {
          
        //CAMPturo EL AÑO Y LE AGREGO LOS 5 PARA SACAR EL VENVCIMIENTO EN AÑOS
        $fechaProxPh=strtotime($request->fechaPh."+ 5 year");
        $fechaProxPh=date("Y-m", $fechaProxPh);

         
 
        $request->validate([
             //reglas de validacion
            'numSerie'=>'required',
            'descripcion'=>'required',
            'año'=>'required|numeric|min:1980|max:2155',
            'fechaPh'=>'required',
            'estado'=>'required',
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
            'numSerie.required'=>'El Numero de Serie es Obligatorio',
            'descripcion.required'=>'La Descripcion es Obligatoria',
            'año.required'=>'El Año es Obligatorio',
            'año.min'=>'El Año Tiene que ser mayor a 1980',
            'año.max'=>'El Año Tiene que ser menor a 2155',
            'fechaPh.required'=>'La de Fecha PH es Obligatoria',
            'estado.required'=>'La Disponibilidad es Obligatoria',

        ]);
 
        //$prdImagen=$archivo->getClientOriginalName();//Nombre original con la extenison
        //substr($archivo->getClientOriginalExtension(),0,-4); //PARA SACAR EL NOMBRE ORGINAL SIN LA EXTENSION


        //RENOMBRA EL ARCHIVO

        $imgT='noDispo.jpg';    
        
        if ($request->file('imgT'))  { 
            $archivo=$request->file('imgT');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgT=substr($archivo->getClientOriginalName(),0,-4);  
            $imgT=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgT );  // public_path ES LA CARPETA 'PUBLIC'
        }
        $tubo=new Tubo();
        
        $tubo->numSerie=$request->numSerie; 
        $tubo->año=$request->año;  
        $tubo->fechaPh=$request->fechaPh;
        $tubo->fechaProxPh=$fechaProxPh;
        $tubo->proximoVencer=$fechaProxPh;
        
    
        $tubo->vencido="No";

        $tubo->estado=$request->estado;
        $tubo->descripcion=$request->descripcion;
        $tubo->mantenimiento=$request->mantenimiento;
        

        $tubo->imgT=$imgT;
        $tubo->save();
        
        return redirect('/adminTubos')
        ->with('mensaje','Tubo Agregado Correctamente'); 
 
    }


    public function verModificarTubo($id){

        $tubo=Tubo::find($id);
        return view('formModificarTubo',['tubo'=>$tubo]);

    }

    public function modificarTubo(Request $request){ 

        $fechaProxPh=strtotime($request->fechaPh."+ 5 year");
        $fechaProxPh=date("Y-m", $fechaProxPh);

         
 
        $request->validate([
             //reglas de validacion
            'numSerie'=>'required',
            'descripcion'=>'required',
            'año'=>'required|numeric|min:1980|max:2155',
            'fechaPh'=>'required',
            'estado'=>'required',
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
            'numSerie.required'=>'El Numero de Serie es Obligatorio',
            'descripcion.required'=>'La Descripcion es Obligatoria',
            'año.required'=>'El Año es Obligatorio',
            'año.min'=>'El Año Tiene que ser mayor a 1980',
            'año.max'=>'El Año Tiene que ser menor a 2155',
            'fechaPh.required'=>'La de Fecha PH es Obligatoria',
            'estado.required'=>'La Disponibilidad es Obligatoria',

        ]);
 
        //$prdImagen=$archivo->getClientOriginalName();//Nombre original con la extenison
        //substr($archivo->getClientOriginalExtension(),0,-4); //PARA SACAR EL NOMBRE ORGINAL SIN LA EXTENSION


        //RENOMBRA EL ARCHIVO
  
        
        $tubo=Tubo::find($request->idTubo);


        if ($request->file('imgT'))  { 
            $archivo=$request->file('imgT');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgT=substr($archivo->getClientOriginalName(),0,-4);  
            $imgT=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgT );  // public_path ES LA CARPETA 'PUBLIC'
        
            $tubo->imgT=$imgT;
            
        }
        
        $tubo->numSerie=$request->numSerie; 
        $tubo->año=$request->año;  
        $tubo->fechaPh=$request->fechaPh;
        $tubo->fechaProxPh=$fechaProxPh;
        $tubo->proximoVencer=$fechaProxPh;
        
    
        $tubo->vencido="No";

        $tubo->estado=$request->estado;
        $tubo->descripcion=$request->descripcion;
        $tubo->comentario=$request->comentario;
        $tubo->mantenimiento=$request->mantenimiento;
        

        $tubo->save();
        
        return redirect('/adminTubos')
        ->with('mensaje2','Tubo Modificado Correctamente');  
    }
    public function eliminarTubo($id)
    {
        $tubo=Tubo::find($id);
        $tubo->delete();

        return redirect('/adminTubos')
        ->with('mensaje3','Tubo Eliminado Correctamente');  

    }

    public function cambiarEstadoTubo($id){
        $tubo=Tubo::find($id);

        if($tubo->estado=='Revisar'){
            $tubo->estado='Reparacion';
            $tubo->save();

            return redirect('/adminTubos')->with('cambio','El Tubo T'.$id.' Cambio de estado Correctamente');
        }
        elseif($tubo->estado=='Reparacion'){
            $tubo->estado='Disponible';
            $tubo->comentario='';

            if($tubo->vencido=='Si'){
                $tubo->vencido='No'; 
            }

            $tubo->save();

            return redirect('/adminTubos')->with('cambio','El Tubo T'.$id.' Cambio de estado Correctamente');
            
        }

    }


    public function cambiarEstadoTuboVencido($id){
        $tubo=Tubo::find($id);
        return view('formModificarTuboPH',['tubo'=>$tubo]);
    }
    public function modificarTuboPH(Request $request){
        $tubo=Tubo::find($request->idTubo); 

        $fechaProxPh=strtotime($request->fechaPh."+ 5 year");
        $fechaProxPh=date("Y-m", $fechaProxPh);

        $tubo->fechaPh=$request->fechaPh;
        $tubo->fechaProxPh=$fechaProxPh;
        $tubo->proximoVencer=$fechaProxPh;
        $tubo->comentario='';
        $tubo->vencido='No';
        $tubo->estado='Disponible';

        
        $tubo->save();
        return redirect('/adminTubos')->with('mensajePh','El PH del tubo  T'.$request->idTubo.'Se Actualizo Correctamente');


    } 
}
