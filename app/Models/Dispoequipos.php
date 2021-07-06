<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispoequipos extends Model
{
    protected $table = 'dispoequipos';
    protected $primaryKey='idDispo';

    
    public $timestamps=false;
}
