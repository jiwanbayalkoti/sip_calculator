<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SipCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_investment',
        'annual_return_rate',
        'investment_duration',
        'maturity_amount',
        'total_investment',
        'total_interest',
    ];

    protected $casts = [
        'monthly_investment' => 'decimal:2',
        'annual_return_rate' => 'decimal:2',
        'investment_duration' => 'integer',
        'maturity_amount' => 'decimal:2',
        'total_investment' => 'decimal:2',
        'total_interest' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 