<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey='idEquipo';

    protected $fillable = ['estado','comentario','vencido'];
    
    public $timestamps=false;
}
