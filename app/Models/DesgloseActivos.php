<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesgloseActivos extends Model
{
    protected $table = 'desgloseActivos';
    protected $primaryKey='idDesglose';

    
    public $timestamps=false;
}
