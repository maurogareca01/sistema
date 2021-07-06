<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendario';
    protected $primaryKey='idCalendario';

    protected $fillable = [
    'estadoPedido',
    'title',
    'logisticaE',
    'logisticaR'];
    
    public $timestamps=false;
}
