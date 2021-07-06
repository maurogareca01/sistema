<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finanza extends Model
{
    protected $table = 'finanzas';
    protected $primaryKey='idFinanzas'; 
    protected $fillable = ['estado'];

    
    public $timestamps=false;
}
