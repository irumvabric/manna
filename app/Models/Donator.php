<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'payment_method',
        'target_amount',
        'periodicity',
        'currency'
    ];

    protected $casts = [
        'periodicity' => 'integer',
        'target_amount' => 'double',
    ];

    // 🔥 Periodicity constants
    const PERIOD_ONE_TIME = 0;
    const PERIOD_MONTHLY = 1;
    const PERIOD_SEMIANNUALLY = 6;
    const PERIOD_YEARLY = 12;

    public static function getPeriodicityOptions(): array
    {
        return [
            self::PERIOD_ONE_TIME => __('messages.one_time'),
            self::PERIOD_MONTHLY => __('messages.monthly'),
            self::PERIOD_SEMIANNUALLY => __('messages.semiannually'),
            self::PERIOD_YEARLY => __('messages.yearly'),
        ];
    }

    // ✅ Accessor for label
    public function getPeriodicityLabelAttribute(): string
    {
        return self::getPeriodicityOptions()[$this->periodicity]
            ?? __('messages.unknown');
    }

    // 🚀 Calculate next payment date
    public function getNextPaymentDateAttribute(): ?Carbon
    {
        if ($this->periodicity === self::PERIOD_ONE_TIME) {
            return null;
        }

        return $this->created_at?->addMonths($this->periodicity);
    }

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
