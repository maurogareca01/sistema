<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentabilidad extends Model
{
    protected $table = 'rentabilidad';
    protected $primaryKey='idRentabilidad';
    protected $fillable = ['valor'];
    public $timestamps=false;
}
