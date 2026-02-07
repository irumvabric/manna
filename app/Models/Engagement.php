<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Engagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'donator_id',
        'amount',
        'currency',
        'periodicity',
        'status',
    ];

    public function donator(): BelongsTo
    {
        return $this->belongsTo(Donator::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}
