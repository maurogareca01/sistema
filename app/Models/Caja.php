<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajaentrada';
    protected $primaryKey='idEntrada';

    
    public $timestamps=false;
}
