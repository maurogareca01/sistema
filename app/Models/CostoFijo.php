<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostoFijo extends Model
{
    protected $table = 'costosFijos';
    protected $primaryKey='idCostoFijo';

    
    public $timestamps=false;
}
