<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donator_id',
        'amount',
        'currency',
        'payment_method',
        'controller',
        'seed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'donator_id' => 'integer',
            'amount' => 'double',
        ];
    }

    public function donator(): BelongsTo
    {
        return $this->belongsTo(Foreign::class);
    }
}
