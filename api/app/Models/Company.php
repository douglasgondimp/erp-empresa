<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo', // decimal(4,0) 
        'empresa', // decimal(4, 0)
        'sigla', // varchar(40)
        'razao_social' // varchar(255)
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'empresa', 'codigo');
    }  
}
