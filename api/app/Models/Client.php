<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa', // decimal(4,0)
        'codigo', // decimal(4,0)
        'razao_social', // varchar(255)
        'tipo', // enum('PJ', 'PF')
        'cpf_cnpj', // varchar(14)
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'empresa', 'codigo');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'client_id', 'recnum');
    }
}
