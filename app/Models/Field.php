<?php

namespace App\Models;

use Decimal\Decimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Field extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'source_name',
        'destination_field',
        'map',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    protected function casts(): array
    {
        return [
            'map' => 'json',
        ];
    }

    public function mapFromTransaction(array $transaction): string
    {
        $value = Arr::get($transaction, $this->source_name);

        if (! empty($this->map)) {
            foreach ($this->map as $step) {
                $value = match ($step['action']) {
                    'replace' => $this->applyReplacementStep($step, $value),
                    'negate' => $this->applyNegateStep($step, $value),
                    'case' => $this->applyCaseStep($step, $value),
                    'date' => $this->applyDateStep($step, $value),
                    default => $value,
                };
            }
        }

        return $value;
    }

    private function applyReplacementStep(array $step, string $value): string
    {
        if (Arr::boolean($step, 'wildcard')) {
            if (str_contains($value, $step['search'])) {
                return $step['replacement'];
            }
        } else {
            if ($value === $step['search']) {
                return $step['replacement'];
            }
        }

        return $value;
    }

    private function applyNegateStep(array $step, string $value): string
    {
        return with(new Decimal($value))->negate()->toFixed(2);
    }

    private function applyCaseStep(array $step, string $value): string
    {
        foreach($step['cases'] as $search => $replace) {
            if ($search === $value) {
                return $replace;
            }
        }

        return $value;
    }

    private function applyDateStep(array $step, string $value): string
    {
        return Carbon::parse($value)->format($step['format']);
    }
}
