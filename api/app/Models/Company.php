<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', // decimal(4,0) 
        'empresa', // decimal(4, 0)
        'sigla', // varchar(40)
        'razao_social' // varchar(255)
    ];
}
