<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalBasedCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_name',
        'target_amount',
        'time_period',
        'annual_return_rate',
        'required_monthly_sip',
        'total_investment',
        'total_interest',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'annual_return_rate' => 'decimal:2',
        'required_monthly_sip' => 'decimal:2',
        'total_investment' => 'decimal:2',
        'total_interest' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 