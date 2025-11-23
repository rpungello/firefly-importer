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

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }

    public function mapTransaction(array $transaction): array
    {
        $result = [];
        foreach ($this->fields as $field) {
            $result[$field->destination_field] = $field->mapFromTransaction($transaction);
        }

        return $result;
    }
}
