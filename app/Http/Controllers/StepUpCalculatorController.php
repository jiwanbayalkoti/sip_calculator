<?php

namespace App\Http\Controllers;

use App\Models\StepUpCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StepUpCalculatorController extends Controller
{
    public function index()
    {
        $calculations = [];
        if (Auth::check()) {
            $calculations = StepUpCalculation::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        return view('calculators.step-up', compact('calculations'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'initial_monthly_investment' => 'required|numeric|min:500',
            'step_up_percentage' => 'required|numeric|min:1|max:50',
            'annual_return_rate' => 'required|numeric|min:1|max:50',
            'investment_duration' => 'required|integer|min:1|max:50',
        ]);

        $initialInvestment = $request->initial_monthly_investment;
        $stepUpPercentage = $request->step_up_percentage;
        $annualReturnRate = $request->annual_return_rate;
        $duration = $request->investment_duration;

        $monthlyRate = $annualReturnRate / 12 / 100;
        $maturityAmount = 0;
        $totalInvestment = 0;
        $currentMonthlyInvestment = $initialInvestment;

        // Generate year-wise breakdown
        $yearlyBreakdown = [];
        for ($year = 1; $year <= $duration; $year++) {
            $yearlyInvestment = 0;
            $yearStartAmount = $maturityAmount;
            
            // Calculate for each month in the year
            for ($month = 1; $month <= 12; $month++) {
                $maturityAmount = $maturityAmount * (1 + $monthlyRate) + $currentMonthlyInvestment;
                $yearlyInvestment += $currentMonthlyInvestment;
            }
            
            $totalInvestment += $yearlyInvestment;
            $yearlyInterest = $maturityAmount - $yearStartAmount - $yearlyInvestment;
            
            $yearlyBreakdown[] = [
                'year' => $year,
                'monthly_investment' => round($currentMonthlyInvestment, 2),
                'yearly_investment' => round($yearlyInvestment, 2),
                'year_end_amount' => round($maturityAmount, 2),
                'yearly_interest' => round($yearlyInterest, 2)
            ];
            
            // Increase monthly investment for next year
            $currentMonthlyInvestment = $currentMonthlyInvestment * (1 + $stepUpPercentage / 100);
        }

        $totalInterest = $maturityAmount - $totalInvestment;

        $calculation = null;
        if (Auth::check()) {
            $calculation = StepUpCalculation::create([
                'user_id' => Auth::id(),
                'initial_monthly_investment' => $initialInvestment,
                'step_up_percentage' => $stepUpPercentage,
                'annual_return_rate' => $annualReturnRate,
                'investment_duration' => $duration,
                'maturity_amount' => round($maturityAmount, 2),
                'total_investment' => round($totalInvestment, 2),
                'total_interest' => round($totalInterest, 2),
            ]);
        }

        return response()->json([
            'success' => true,
            'calculation' => $calculation,
            'result' => [
                'initial_monthly_investment' => number_format($initialInvestment, 2),
                'step_up_percentage' => $stepUpPercentage,
                'maturity_amount' => number_format(round($maturityAmount, 2), 2),
                'total_investment' => number_format(round($totalInvestment, 2), 2),
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

        $calculations = StepUpCalculation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('calculators.step-up-history', compact('calculations'));
    }
} 