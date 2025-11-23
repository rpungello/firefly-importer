<?php

namespace App\Models;

use App\Enums\Filetype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'firefly_id',
        'credit_card',
        'account_number',
        'filetype',
        'headers',
    ];

    protected function casts(): array
    {
        return [
            'credit_card' => 'boolean',
            'headers' => 'boolean',
            'filetype' => Filetype::class,
        ];
    }

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }
}
