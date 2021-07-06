<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenLogistica extends Model
{
    protected $table = 'ordenLogistica';
    protected $primaryKey='idDatosTabla'; 

    
    public $timestamps=false;
}
