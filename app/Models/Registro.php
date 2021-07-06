<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';
    protected $primaryKey='idRegistro';
    protected $fillable = ['estadoPedido',
    'logisticaE',
    'logisticaR',
    'idLogisticaE',
    'idLogisticaR',
    ];
 
    
    public $timestamps=false;
}
