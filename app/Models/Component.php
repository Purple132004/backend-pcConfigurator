<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'price',
        'specs',
        'is_active',
        'img',
    ];

    protected $casts = [
        'specs' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ComponentCategory::class, 'category_id');
    }

    public function buildComponents(): HasMany
    {
        return $this->hasMany(BuildComponent::class);
    }
}