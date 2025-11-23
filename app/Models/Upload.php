<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'disk',
        'path',
        'size',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
