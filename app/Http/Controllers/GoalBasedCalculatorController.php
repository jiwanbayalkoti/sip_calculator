<?php

namespace App\Http\Controllers;

use App\Models\GoalBasedCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalBasedCalculatorController extends Controller
{
    public function index()
    {
        $calculations = [];
        if (Auth::check()) {
            $calculations = GoalBasedCalculation::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        return view('calculators.goal-based', compact('calculations'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:10000',
            'time_period' => 'required|integer|min:1|max:50',
            'annual_return_rate' => 'required|numeric|min:1|max:50',
        ]);

        $goalName = $request->goal_name;
        $targetAmount = $request->target_amount;
        $timePeriod = $request->time_period;
        $annualReturnRate = $request->annual_return_rate;

        // Calculate required monthly SIP using PMT formula
        $monthlyRate = $annualReturnRate / 12 / 100;
        $totalMonths = $timePeriod * 12;
        
        // PMT = FV * r / ((1 + r)^n - 1)
        $requiredMonthlySip = $targetAmount * $monthlyRate / (pow(1 + $monthlyRate, $totalMonths) - 1);
        
        $totalInvestment = $requiredMonthlySip * $totalMonths;
        $totalInterest = $targetAmount - $totalInvestment;

        // Generate year-wise breakdown
        $yearlyBreakdown = [];
        $accumulatedAmount = 0;
        for ($year = 1; $year <= $timePeriod; $year++) {
            $yearlyInvestment = $requiredMonthlySip * 12;
            $accumulatedAmount = $accumulatedAmount * (1 + $annualReturnRate / 100) + $yearlyInvestment;
            $yearlyBreakdown[] = [
                'year' => $year,
                'yearly_investment' => round($yearlyInvestment, 2),
                'accumulated_amount' => round($accumulatedAmount, 2),
                'interest_earned' => round($accumulatedAmount - ($requiredMonthlySip * 12 * $year), 2)
            ];
        }

        $calculation = null;
        if (Auth::check()) {
            $calculation = GoalBasedCalculation::create([
                'user_id' => Auth::id(),
                'goal_name' => $goalName,
                'target_amount' => $targetAmount,
                'time_period' => $timePeriod,
                'annual_return_rate' => $annualReturnRate,
                'required_monthly_sip' => round($requiredMonthlySip, 2),
                'total_investment' => round($totalInvestment, 2),
                'total_interest' => round($totalInterest, 2),
            ]);
        }

        return response()->json([
            'success' => true,
            'calculation' => $calculation,
            'result' => [
                'goal_name' => $goalName,
                'target_amount' => number_format($targetAmount, 2),
                'required_monthly_sip' => number_format(round($requiredMonthlySip, 2), 2),
                'total_investment' => number_format(round($totalInvestment, 2), 2),
                'total_interest' => number_format(round($totalInterest, 2), 2),
                'time_period' => $timePeriod,
                'annual_return_rate' => $annualReturnRate,
                'yearly_breakdown' => $yearlyBreakdown
            ]
        ]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $calculations = GoalBasedCalculation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('calculators.goal-based-history', compact('calculations'));
    }
} 