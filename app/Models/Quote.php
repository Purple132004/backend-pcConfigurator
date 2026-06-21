<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    protected $fillable = [
        'build_id',
        'user_id',
        'status',
        'total_price',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function build(): BelongsTo
    {
        return $this->belongsTo(Build::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}