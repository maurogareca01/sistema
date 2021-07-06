<?php

namespace App\Http\Controllers;
use App\Models\Oximetro;

use Illuminate\Http\Request;

class OximetrosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }
    

    public function listarOximetros(Request $request)
    { 
         
        $buscar=trim($request->get('buscar'));
        $oximetros = Oximetro::paginate(14);
        

        if ($buscar){

            $oximetros=Oximetro::where('idOximetro','LIKE','%'.$buscar.'%')->paginate(14);
            return view('adminOximetros',['oximetros'=>$oximetros,'buscar'=>$buscar]);
        }
        else{
            return view('adminOximetros',['oximetros'=>$oximetros ]);
        }
    }
    public function agregarOximetro(Request $request)
    {
         
 
        $request->validate([
             //reglas de validacion
            'estado'=>'required',
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
            'estado.required'=>'La Disponibilidad es Obligatoria',

        ]);

        //RENOMBRA EL ARCHIVO

        $imgO='noDispo.jpg';    
        
        if ($request->file('imgT'))  { 
            $archivo=$request->file('imgT');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgO=substr($archivo->getClientOriginalName(),0,-4);  
            $imgO=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgO );  // public_path ES LA CARPETA 'PUBLIC'
        }
        $oximetro=new Oximetro();

        $oximetro->estado=$request->estado;
        $oximetro->descripcion=$request->descripcion;
        $oximetro->comentario=$request->comentario;
        $oximetro->imgO=$imgO;
        $oximetro->save();
        
        return redirect('/adminOximetros')
        ->with('mensaje','Oximetro Agregado Correctamente'); 
 
    }
    public function verModificarOximetro($id){

        $oximetro=Oximetro::find($id);
        return view('formModificarOximetro',['oximetro'=>$oximetro]);

    }
    public function modificarOximetro(Request $request){ 

 
        $request->validate([
             //reglas de validacion
            'estado'=>'required',
            'imgE'=>'image|mimes:jpeg,png,jpg|max:5048' //mimes : ext
        ],[
            'estado.required'=>'La Disponibilidad es Obligatoria',
        ]);
 
        $oximetro=Oximetro::find($request->idOximetro);


        if ($request->file('imgO'))  { 
            $archivo=$request->file('imgO');

            $extension=$archivo->getClientOriginalExtension();//extencion
        
                
            $imgO=substr($archivo->getClientOriginalName(),0,-4);  
            $imgO=time().'.'.$extension; //GUARDA EL NOMBRE+TIME+EXTE
            //MOVER EL ARCHIVO
            $archivo->move(public_path('img/'), $imgO );  // public_path ES LA CARPETA 'PUBLIC'
        
            $oximetro->imgO=$imgO;
            
        }
         
        $oximetro->estado=$request->estado;
        $oximetro->descripcion=$request->descripcion; 
        $oximetro->comentario=$request->comentario; 
        

        $oximetro->save();
        
        return redirect('/adminOximetros')
        ->with('mensaje2','Oximetro Modificado Correctamente');  
    }
    public function eliminarOximetro($id)
    {
        $oximetro=Oximetro::find($id);
        $oximetro->delete();

        return redirect('/adminOximetros')
        ->with('mensaje3','Oximetro Eliminado Correctamente');  

    }


    public function cambiarEstadoOximetro($id){
        $oximetro=Oximetro::find($id);

        if($oximetro->estado=='Revisar'){
            $oximetro->estado='Reparacion';
            $oximetro->save();

            return redirect('/adminOximetros')->with('cambio','El Oximetro X'.$id.' Cambio de estado Correctamente');
        }
        elseif($oximetro->estado=='Reparacion'){
            $oximetro->estado='Disponible';
            $oximetro->comentario='';
            $oximetro->save();

            return redirect('/adminOximetros')->with('cambio','El Oximetro X'.$id.' Cambio de estado Correctamente');
            
        }

    }
}
