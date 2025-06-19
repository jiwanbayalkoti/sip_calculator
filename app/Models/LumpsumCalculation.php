<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LumpsumCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lumpsum_amount',
        'annual_return_rate',
        'investment_duration',
        'maturity_amount',
        'total_interest',
    ];

    protected $casts = [
        'lumpsum_amount' => 'decimal:2',
        'annual_return_rate' => 'decimal:2',
        'maturity_amount' => 'decimal:2',
        'total_interest' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 