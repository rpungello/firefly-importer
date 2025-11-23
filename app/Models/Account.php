<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        ];
    }
}
