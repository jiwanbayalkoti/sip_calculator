<?php

namespace App\Http\Controllers;

use App\Models\MutualFund;
use Illuminate\Http\Request;

class MutualFundController extends Controller
{
    public function index()
    {
        $categories = ['equity', 'debt', 'hybrid', 'liquid'];
        $selectedCategory = request('category', 'equity');
        
        $funds = MutualFund::active()
            ->byCategory($selectedCategory)
            ->orderBy('five_year_return', 'desc')
            ->paginate(20);

        $topFunds = MutualFund::active()
            ->topPerforming('five_year_return')
            ->limit(5)
            ->get();

        return view('mutual-funds.index', compact('funds', 'categories', 'selectedCategory', 'topFunds'));
    }

    public function compare(Request $request)
    {
        $fundIds = $request->get('funds', []);
        $funds = MutualFund::active()->whereIn('id', $fundIds)->get();

        return view('mutual-funds.compare', compact('funds'));
    }

    public function show(MutualFund $fund)
    {
        $similarFunds = MutualFund::active()
            ->where('category', $fund->category)
            ->where('id', '!=', $fund->id)
            ->limit(5)
            ->get();

        return view('mutual-funds.show', compact('fund', 'similarFunds'));
    }

    public function ranking()
    {
        $categories = ['equity', 'debt', 'hybrid', 'liquid'];
        $periods = ['one_year_return', 'three_year_return', 'five_year_return', 'ten_year_return'];
        
        $selectedCategory = request('category', 'equity');
        $selectedPeriod = request('period', 'five_year_return');

        $rankings = MutualFund::active()
            ->byCategory($selectedCategory)
            ->whereNotNull($selectedPeriod)
            ->orderBy($selectedPeriod, 'desc')
            ->paginate(50);

        return view('mutual-funds.ranking', compact('rankings', 'categories', 'periods', 'selectedCategory', 'selectedPeriod'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $funds = MutualFund::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('fund_house', 'like', "%{$query}%");
            })
            ->orderBy('five_year_return', 'desc')
            ->paginate(20);

        return view('mutual-funds.search', compact('funds', 'query'));
    }
} 