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
}
