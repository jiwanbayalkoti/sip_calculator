<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutualFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fund_house',
        'category',
        'sub_category',
        'nav',
        'expense_ratio',
        'one_year_return',
        'three_year_return',
        'five_year_return',
        'ten_year_return',
        'min_investment',
        'min_sip',
        'rating',
        'is_active',
    ];

    protected $casts = [
        'nav' => 'decimal:4',
        'expense_ratio' => 'decimal:2',
        'one_year_return' => 'decimal:2',
        'three_year_return' => 'decimal:2',
        'five_year_return' => 'decimal:2',
        'ten_year_return' => 'decimal:2',
        'min_investment' => 'decimal:2',
        'min_sip' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeTopPerforming($query, $period = 'five_year_return')
    {
        return $query->whereNotNull($period)
                    ->orderBy($period, 'desc');
    }
} 