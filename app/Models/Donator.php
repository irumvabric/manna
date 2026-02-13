<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'payment_method',
        'target_amount',
        'periodicity',
        'currency',
    ];

    public function getCurrencySymbolAttribute()
    {
        return match($this->currency) {
            'USD' => '$',
            'EUR' => '€',
            'BIF' => 'FBu',
            default => '$'
        };
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'target_amount' => 'double',
            'periodicity' => 'integer',
        ];
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function engagements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Engagement::class);
    }

    public function donations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Donation::class);
    }
}
