<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 


class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    public function verUsuarios(){
        $usuarios=User::paginate(15);
        return view('adminUsuarios',['usuarios'=>$usuarios]);

    }

    public function formModificarUsuario($id){
        $usuario=user::find($id);
        return view('formModificarUsuario',['usuario'=>$usuario]);
    }
    public function modificarUsuario(Request $request){
        $request->validate([ 
           'sueldo'=>'regex:/^[0-9]{1}\d{0,}$/', 
           'usuario'=>'unique:users|nullable',
           'email'=>'email|unique:users|nullable', 
       ],[ 
           'sueldo.regex'=>'El Sueldo es Incorrecto',  
           'usuario.unique'=>'Ya existe un Usuario con ese Nombre',  
           'email.email'=>'Introduce una dirección de correo electrónico',
           'email.unique'=>'Ya existe esa dirección de correo electrónico',
       ]);

        $name=strtolower($request->name); //CONVIERTE TODO A MINUSUCLAS
        $name= ucwords($name);//Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.
        $apellido=strtolower($request->apellido); //CONVIERTE TODO A MINUSUCLAS
        $apellido=ucwords($apellido);//Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.

        $usuario=user::find($request->id); 
        
        if($name){
            $usuario->name=$request->name;
        }
        if($apellido){
            $usuario->apellido=$request->apellido;
        }
        if($request->email){
            $usuario->email=$request->email;
        }
        if($request->sueldo || $request->sueldo==0 ){ 

            if( $request->sueldo==0 ){
                $usuario->sueldo=0;
            }else{
                $usuario->sueldo=$request->sueldo;
            }
        }
        if($request->rol){
            $usuario->rol=$request->rol;
        }
        if($request->tipo){
            $usuario->tipo=$request->tipo;
        }
        if($request->usuario){
            $usuario->usuario=$request->usuario;
        }
        if($request->estadoCuenta){
            $usuario->estadoCuenta=$request->estadoCuenta;
        }  

        $usuario->save();

        return redirect('/adminUsuarios')
        ->with('mensaje2','El Usuario fue Modificado Correctamente');  
    }
    public function eliminarUsuario($id){
        $usu=User::find($id);
        $usu->delete();

        return redirect('/adminUsuarios')
        ->with('mensaje3','El Usuario fue Eliminado Correctamente');  

    }

    public function registroForm(){
        return view('auth/register');
    
    }

    public function registro (Request $request){

        $request->validate([
            //reglas de validacion
           'name'=>'required',
           'apellido'=>'required',
           'rol'=>'required',
           'tipo'=>'required',
           'sueldo'=>'required|regex:/^[0-9]{1}\d{0,}$/',
           'password'=>'required|confirmed',
           'usuario'=>'required|unique:users',
           'email'=>'required|string|email|unique:users'
       ],[
           'name.required'=>'El Nombre es Obligatorio',
           'apellido.required'=>'El Apellido es Obligatorio',
           'rol.required'=>'El Rol es Obligatorio',
           'tipo.required'=>'El Perfil Financiero es Obligatorio',
           'sueldo.required'=>'El Sueldo es Obligatorio',
           'sueldo.regex'=>'El Sueldo es Incorrecto',
           'password.required'=>'La Contraseña es Obligatoria', 
           'password.confirmed'=>'La Contraseña No Coincide',
           'usuario.required'=>'El Usuario es Obligatorio',
           'usuario.unique'=>'Ya existe un Usuario con ese Nombre',
           'email.required'=>'El E-Mail es Obligatorio',
           'email.string'=>'El E-Mail es Incorrecto',
           'email.email'=>'Introduce una dirección de correo electrónico',
           'email.unique'=>'Ya existe esa dirección de correo electrónico',
       ]);

        $name=strtolower($request->name); //CONVIERTE TODO A MINUSUCLAS
        $name= ucwords($name);//Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.
        $apellido=strtolower($request->apellido); //CONVIERTE TODO A MINUSUCLAS
        $apellido=ucwords($apellido);//Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.

        $usuario=new User;
        $usuario->name=$name;
        $usuario->apellido=$apellido;
        $usuario->rol=$request->rol;
        $usuario->tipo=$request->tipo;
        $usuario->sueldo=$request->sueldo;
        $usuario->usuario=$request->usuario;
        $usuario->email=$request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->fecha=date("d/m/Y H:i:s"); 
        $usuario->estadoCuenta="Activada"; 
        $usuario->save(); 



        return redirect('/adminUsuarios')
        ->with('mensaje','Usuario Agregado Correctamente'); 



    }


    public function formPasswordUsuario ($id){
        $usuario=user::find($id);
        return view('formPasswordUsuario',['usuario'=>$usuario]);

    }

    public function modificarPassword(Request $request){

        $request->validate([
           'mypassword'=>'required',
           'password'=>'required|confirmed', 
       ],[
           'mypassword.required'=>'La Contraseña Actual es Obligatoria',
           'password.required'=>'La Contraseña Nueva es Obligatoria',
           'password.confirmed'=>'La Contraseña No Coincide',
       ]);

       if(Hash::check($request->mypassword,Auth::user()->password)){
            //dd('la contraseña es igual');
            
            $user=User::find($request->id);
            $user->password=Hash::make($request->password);
            $user->save();

            return redirect('/adminUsuarios')
            ->with('mensaje2','Contraseña Cambiada Correctamente');  
       }else{
            return redirect('/adminUsuarios')
            ->with('mensaje2','No Se Pudo Cambiar La Contraseña');  

       }

    }
    
}
