<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oximetro extends Model
{
    protected $table = 'oximetros';
    protected $primaryKey='idOximetro';
    protected $fillable = ['estado','comentario'];

    
    public $timestamps=false;
}
