<?php

namespace App\Models;

use App\Helpers\Helpers;
use App\Helpers\MaskHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo';

    protected $fillable = [
        'empresa', // decimal(4,0)
        'codigo', // decimal(4,0)
        'razao_social', // varchar(255)
        'tipo', // enum('PJ', 'PF')
        'cpf_cnpj', // varchar(14)
    ];

    protected static function boot(): void
    {
        parent::boot();

        if (auth()->user()->role_id === 2) {
            static::addGlobalScope('client', function (Builder $builder) {
                $builder->where('recnum', auth()->user()->client_id);
            });
        }

        static::addGlobalScope('company', function (Builder $builder) {
            $builder->with('company');
        });
    }

    public function cpfCnpj(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => MaskHelper::maskCPFCNPJ($value),
            set: fn (string $value) => Helpers::getNumbers($value),
        );
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'empresa', 'codigo');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'client_id', 'recnum');
    }
}
