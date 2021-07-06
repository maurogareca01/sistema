<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    protected $table = 'garantias';
    protected $primaryKey='idGarantia';
    protected $fillable = ['estaEnCaja','estado'];

    
    public $timestamps=false;
}