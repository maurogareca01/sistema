<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('apellido'); 
            $table->string('rol'); 
            $table->string('tipo'); 
            $table->integer('sueldo')->unsigned(); 
            $table->string('fecha'); 
            $table->string('email');
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('estadoCuenta');
            
            $table->integer('garantiaActiva')->unsigned()->nullable(); 
            $table->integer('fci')->unsigned()->nullable();
            $table->integer('porcenFci')->unsigned()->nullable();
            $table->integer('plazoFijo')->unsigned()->nullable();
            $table->integer('porcenPlazoFijo')->unsiged()->nullable();
            $table->integer('activos')->nullable();
            $table->integer('efectivo')->unsigned()->nullable();
            $table->integer('liquidasHoy')->nullable();
            $table->string('estado')->nullable();
  


        }); 
        
        $usuario=new User();
        $usuario->name='Admin';
        $usuario->apellido='Hhoxigeno';
        $usuario->rol='admin';
        $usuario->tipo='Control de Efectivo';
        $usuario->sueldo=0;
        $usuario->fecha=date('d/m/Y H:i:s');
        $usuario->email='admin@hhoxigeno.com';
        $usuario->usuario='adminhhoxigeno';
        $usuario->password=Hash::make('adminhhoxigeno');
        $usuario->estadoCuenta='Activada'; 
        
        $usuario->save();

/*
        DB::table("users")
        ->insert([
            "name" => 'asdasd',
            "apellido" => "Hhoxigeno",
            "rol" => "admin",
            "tipo" => "Control de Efectivo",
            "sueldo" => "",
            "fecha" => date('d/m/Y H:i:s'),
            "email" => "info@hhoxigeno.com",
            "usuario" => "adminhhoxigeno",
            "password" => Hash::make('adminhhoxigeno'),
            "estadoCuenta" => "Activada",
            "fci" => "",
            "garantiaActiva" => "",
            "porcenFci" => "",
            "plazoFijo" => "",
            "porcenPlazoFijo" => "",
            "activos" => "",
            "efectivo" => "",
            "liquidasHoy" => "",
            "estado" => "",
            ]);
        
*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
