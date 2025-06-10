<?php

namespace App\Http\Controllers;

use App\Models\SipCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SipCalculatorController extends Controller
{
    public function index()
    {
        $history = [];
        if (Auth::check()) {
            $history = Auth::user()->sipCalculations()->latest()->take(5)->get();
        }
        return view('sip-calculator.index', compact('history'));
    }

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
        ];

        if (Auth::check()) {
            Auth::user()->sipCalculations()->create($result);
        }

        return response()->json([
            'status' => 'success',
            'result' => $result
        ]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $history = Auth::user()->sipCalculations()->latest()->get();
        return response()->json([
            'status' => 'success',
            'history' => $history
        ]);
    }
} 