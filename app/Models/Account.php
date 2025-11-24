<?php

namespace App\Models;

use App\Enums\Filetype;
use Decimal\Decimal;
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
        $amount = new Decimal(0);

        foreach ($this->fields as $field) {
            $result[$field->destination_field] = $field->mapFromTransaction($transaction);

            if ($field->destination_field === 'amount') {
                $amount = new Decimal($result['amount']);
            }
        }

        if ($amount->isNegative()) {
            $result['amount'] = $amount->negate()->toFixed(2);
            $result['destination_id'] = $this->firefly_id;
            $result['source_name'] = $result['destination_name'];
            unset($result['destination_name']);
        } else {
            $result['source_id'] = $this->firefly_id;
        }

        return $result;
    }
}
