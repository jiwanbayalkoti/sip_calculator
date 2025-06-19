<?php

namespace App\Http\Controllers;

use App\Models\LumpsumCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LumpsumCalculatorController extends Controller
{
    public function index()
    {
        $calculations = [];
        if (Auth::check()) {
            $calculations = LumpsumCalculation::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        return view('calculators.lumpsum', compact('calculations'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'lumpsum_amount' => 'required|numeric|min:1000',
            'annual_return_rate' => 'required|numeric|min:1|max:50',
            'investment_duration' => 'required|integer|min:1|max:50',
        ]);

        $lumpsumAmount = $request->lumpsum_amount;
        $annualReturnRate = $request->annual_return_rate;
        $duration = $request->investment_duration;

        // Calculate maturity amount using compound interest formula
        $monthlyRate = $annualReturnRate / 12 / 100;
        $totalMonths = $duration * 12;
        $maturityAmount = $lumpsumAmount * pow(1 + $monthlyRate, $totalMonths);
        $totalInterest = $maturityAmount - $lumpsumAmount;

        // Generate year-wise breakdown
        $yearlyBreakdown = [];
        for ($year = 1; $year <= $duration; $year++) {
            $yearEndAmount = $lumpsumAmount * pow(1 + $annualReturnRate / 100, $year);
            $yearlyBreakdown[] = [
                'year' => $year,
                'amount' => round($yearEndAmount, 2),
                'interest' => round($yearEndAmount - $lumpsumAmount, 2)
            ];
        }

        $calculation = null;
        if (Auth::check()) {
            $calculation = LumpsumCalculation::create([
                'user_id' => Auth::id(),
                'lumpsum_amount' => $lumpsumAmount,
                'annual_return_rate' => $annualReturnRate,
                'investment_duration' => $duration,
                'maturity_amount' => round($maturityAmount, 2),
                'total_interest' => round($totalInterest, 2),
            ]);
        }

        return response()->json([
            'success' => true,
            'calculation' => $calculation,
            'result' => [
                'lumpsum_amount' => number_format($lumpsumAmount, 2),
                'maturity_amount' => number_format(round($maturityAmount, 2), 2),
                'total_interest' => number_format(round($totalInterest, 2), 2),
                'annual_return_rate' => $annualReturnRate,
                'investment_duration' => $duration,
                'yearly_breakdown' => $yearlyBreakdown
            ]
        ]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $calculations = LumpsumCalculation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('calculators.lumpsum-history', compact('calculations'));
    }
} 