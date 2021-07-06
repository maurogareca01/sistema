<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tubo extends Model
{
    protected $table = 'tubos';
    protected $primaryKey='idTubo';

    protected $fillable = ['estado','comentario','vencido'];
    
    public $timestamps=false;
}
