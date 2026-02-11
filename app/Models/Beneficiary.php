<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'name',
        'age',
        'departement',
        'faculte',
        'address',
        'phone',
        'email',
        'amount_received',
        'tuition',
        'notes',
    ];

    public function expenses()
    {
        return $this->hasMany(BeneficiaryExpense::class);
    }

    protected static function boot()
    {
        parent::boot();

        // No need for a separate observer for simple logic
    }
}
