<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{
    protected $table = 'cajasalida';
    protected $primaryKey='idSalida';

    
    public $timestamps=false;
}
