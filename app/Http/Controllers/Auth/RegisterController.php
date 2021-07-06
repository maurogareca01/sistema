<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
     

    use RegistersUsers; 
    protected $redirectTo = RouteServiceProvider::HOME;
 
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('auth');
    } 

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'], 
            'apellido' => ['required', 'string', 'max:255'], 
            'rol' => ['required', 'string', 'max:255'], 
            'tipo' => ['required', 'string', 'max:255'], 
            'sueldo' => ['integer'], 
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } 
  
    protected function create(array $data)
    {
         User::create([
            'name' => $data['name'],  
            'apellido' => $data['apellido'],  
            'rol' => $data['rol'],  
            'tipo' => $data['tipo'],  
            'sueldo' => $data['sueldo'],  
            'email' => $data['email'],
            'usuario' => $data['usuario'],
            'password' => Hash::make($data['password']),
            //'password' =>$data['password']
        ]); 
    }

    
}
