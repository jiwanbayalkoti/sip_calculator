<?php

namespace App\Http\Controllers;

use App\Models\SipCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SipCalculatorController extends Controller
{
    /**
     * Display the calculator dashboard.
     */
    public function index(): View
    {
        $history = [];
        $user = Auth::user();

        if ($user) {
            $history = $user->sipCalculations()
                ->latest()
                ->take(5)
                ->get();
        }

        return view('dashboard', [
            'history' => $history,
            'isAuthenticated' => !is_null($user)
        ]);
    }

    /**
     * Calculate SIP returns.
     */
    public function calculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'monthly_investment' => 'required|numeric|min:1',
            'annual_return_rate' => 'required|numeric|between:1,100',
            'investment_duration' => 'required|integer|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $monthlyInvestment = $request->monthly_investment;
        $annualRate = $request->annual_return_rate;
        $years = $request->investment_duration;

        // Monthly rate
        $monthlyRate = $annualRate / 12 / 100;
        
        // Number of payments
        $numberOfPayments = $years * 12;
        
        // Calculate maturity amount using SIP formula
        $maturityAmount = $monthlyInvestment * 
            ((pow(1 + $monthlyRate, $numberOfPayments) - 1) / $monthlyRate) * 
            (1 + $monthlyRate);

        $totalInvestment = $monthlyInvestment * $numberOfPayments;
        $totalInterest = $maturityAmount - $totalInvestment;

        $result = [
            'monthly_investment' => $monthlyInvestment,
            'annual_return_rate' => $annualRate,
            'investment_duration' => $years,
            'maturity_amount' => round($maturityAmount, 2),
            'total_investment' => round($totalInvestment, 2),
            'total_interest' => round($totalInterest, 2),
            'calculated_at' => now()->toDateTimeString(),
        ];

        // Save calculation for authenticated users
        if (Auth::check()) {
            Auth::user()->sipCalculations()->create($result);
        }

        return response()->json([
            'status' => 'success',
            'result' => $result
        ]);
    }

    /**
     * Get calculation history for authenticated users.
     */
    public function history()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $history = Auth::user()->sipCalculations()
            ->latest()
            ->get()
            ->map(function ($calculation) {
                return [
                    'monthly_investment' => $calculation->monthly_investment,
                    'annual_return_rate' => $calculation->annual_return_rate,
                    'investment_duration' => $calculation->investment_duration,
                    'maturity_amount' => $calculation->maturity_amount,
                    'total_investment' => $calculation->total_investment,
                    'total_interest' => $calculation->total_interest,
                    'calculated_at' => $calculation->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'status' => 'success',
            'history' => $history
        ]);
    }
} 