<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesgloseFondoHH extends Model
{
    protected $table = 'desgloseFondoHH';
    protected $primaryKey='idCuenta';

    
    public $timestamps=false;
}
