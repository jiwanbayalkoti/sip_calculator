<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepUpCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'initial_monthly_investment',
        'step_up_percentage',
        'annual_return_rate',
        'investment_duration',
        'maturity_amount',
        'total_investment',
        'total_interest',
    ];

    protected $casts = [
        'initial_monthly_investment' => 'decimal:2',
        'step_up_percentage' => 'decimal:2',
        'annual_return_rate' => 'decimal:2',
        'maturity_amount' => 'decimal:2',
        'total_investment' => 'decimal:2',
        'total_interest' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 