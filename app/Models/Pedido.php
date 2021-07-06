<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey='idPedido';
    protected $fillable = [
        'estadoPedido',
        'medioPagoEnvio',
        'costoEnvio',
        'fechaRetiro',
        'dispoEA',
        'dispoER',
        'dispoEY',
        'dispoT1',
        'dispoT415',
        'dispoO',
        'logisticaE',
        'logisticaR',
        'idLogisticaE',
        'idLogisticaR',
    ];


    public $timestamps=false;
 
}
