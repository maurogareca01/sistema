<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use App\Models\Calendario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class TareaController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware(['auth','roles:admin,administrador']);

    }*/
    

    public function verTareas(Request $request){
        
        $buscar=trim($request->get('buscar'));

        if(Auth::user()->rol=='logistica'){
            $id=Auth::user()->id;
            $tareas = Tarea::where('idAsignada','LIKE',$id)->orderBy('idTarea', 'DESC')->paginate(14);
 
            if ($buscar){

                $tareas=Tarea::where('idAsignada','LIKE',$id)->where('idTarea','LIKE','%'.$buscar.'%')->paginate(14);
                return view('adminTareas',['tareas'=>$tareas,'buscar'=>$buscar]);
            }
            else{
                return view('adminTareas',['tareas'=>$tareas]); 
            }
 
        }else{

            $tareas = Tarea::orderBy('idTarea', 'DESC')->paginate(14);
            $usuarios = User::paginate(14);

            if ($buscar){

                $tareas=Tarea::where('idTarea','LIKE','%'.$buscar.'%')->paginate(14);
                return view('adminTareas',['tareas'=>$tareas,'usuarios'=>$usuarios,'buscar'=>$buscar]);
            }
            else{
                return view('adminTareas',['tareas'=>$tareas,'usuarios'=>$usuarios]); 
            }

        }

    }

    public function agregarTarea(Request $request)
    {
        $request->validate([
            //reglas de validacion
           'descripcion'=>'required',
           'fecha'=>'required',
           'idAsignada'=>'required',
           'descripcion'=>'required',
       ],[
           'descripcion.required'=>'La Descripcion es Obligatoria',
           'fecha.required'=>'La Fecha es Obligatoria',
           'idAsignada.required'=>'La Asignacion es Obligatoria',
           'descripcion.required'=>'La Descripcion es Obligatoria',
       ]);
        $tarea=new Tarea();  
        $user=User::find($request->idAsignada);
        $tarea->idAsignada=$request->idAsignada;
        $tarea->usuarioAsignada=$user->name.' '.$user->apellido; 
         

        $tarea->altaUsuario=$request->altaUsuario;
        $tarea->descripcion=$request->descripcion;
        $tarea->fecha=$request->fecha;
        $tarea->estado="Pendiente";
        

        
        $tarea->save(); 
        ////CARGA DE TAREA AL CALENDARIO///
        $calen=new Calendario(); 
        $calen->idTarea=$tarea->idTarea;   
        $calen->idUsuario=$tarea->idAsignada;   
        $calen->nombreServ=$tarea->altaUsuario;           //uso la var de nombreServ para guardar el nombre que quien escribi la tarea
        $calen->descripcion=$request->descripcion; 
        $calen->nombreCliente=$tarea->usuarioAsignada;             //uso la var de nombreCliente para guardar el nombre de agignacion de la tarea
        $calen->dni=00;  
        $calen->telefono=00;  
        $calen->direccion="";  
        $calen->localidad="";

        $calen->fechaInicio = $request->fecha;
        $calen->start=$request->fecha;
        $calen->fechaFin="";

        $calen->bandera="tarea";
        $calen->recibe="";
        $calen->estadoPedido='Pendiente';
        $calen->title='Tarea Pend.'.$tarea->idTarea;
        $calen->textColor='black';
        $calen->backgroundcolor='#f8ef6e';
        $calen->borderColor='black';

        $calen->save();  




        return redirect('/adminTareas')
        ->with('mensaje','Tarea Agregada Correctamente'); 
    }

    public function formModificarTarea($id){

        $tarea=Tarea::find($id);
        $usuarios=User::get();
        return view('formModificarTarea',['tarea'=>$tarea,'usuarios'=>$usuarios]);

    }
    public function ModificarTarea(Request $request){
        $request->validate([
            //reglas de validacion
           'descripcion'=>'required',
           'fecha'=>'required',
           'idAsignada'=>'required',
           'descripcion'=>'required',
       ],[
           'descripcion.required'=>'La Descripcion es Obligatoria',
           'fecha.required'=>'La Fecha es Obligatoria',
           'idAsignada.required'=>'La Asignacion es Obligatoria',
           'descripcion.required'=>'La Descripcion es Obligatoria',
       ]);

       
        $tarea=Tarea::find($request->idTarea);
        $tarea->descripcion=$request->descripcion;
        $tarea->fecha=$request->fecha;

        $user=User::find($request->idAsignada);
        $tarea->idAsignada=$request->idAsignada;
        $tarea->usuarioAsignada=$user->name.' '.$user->apellido;

        $tarea->save();

        $calen=Calendario::where('idTarea','=',$request->idTarea)->first(); 
        $calen->idUsuario=$request->idAsignada; 
        $calen->nombreCliente=$user->name.' '.$user->apellido;             //uso la var de nombreCliente para guardar el nombre de agignacion de la tarea
        $calen->descripcion=$request->descripcion; 
        $calen->fechaInicio = $request->fecha;
        $calen->start=$request->fecha;

        $calen->save();  






        return redirect('/adminTareas')
        ->with('mensaje2','La Tarea '.$request->idTarea. ' fue Modificado Correctamente');  
    }
    public function eliminarTarea($id)
    {
        $tarea=Tarea::find($id);
        $tarea->delete();

        return redirect('/adminTareas')
        ->with('mensaje3','La Tarea '.$id. ' fue Eliminada Correctamente');  

    }


    public function cambiarEstadoTarea($id){
        $tarea=Tarea::find($id);

        if($tarea->estado=='Pendiente'){

            $tarea=Tarea::find($id)->update(['estado'=>'Realizada']);

            $calen=Calendario::where('idTarea','LIKE',$id)->
            where('bandera','LIKE','tarea')->
            update(['backgroundcolor'=>'#28a745','estadoPedido'=>'Realizada','title'=>'Tarea Real. '.$id]);

            


            return redirect('adminTareas')
            ->with('mensaje4','La Tarea N° ' .$id. ' ha sido Marcado como "Realizada" ');
        }
        if($tarea->estado=='Realizada'){

            $tarea=Tarea::find($id)->update(['estado'=>'Pendiente']);

            $calen=Calendario::where('idTarea','LIKE',$id)->
            where('bandera','LIKE','tarea')->
            update(['backgroundcolor'=>'#f8ef6e','estadoPedido'=>'Pendiente','title'=>'Tarea Pend. '.$id]);


            return redirect('adminTareas')
            ->with('mensaje4','La Tarea N° ' .$id. ' ha sido Marcado como "Pendiente" ');
        }
    }
}
