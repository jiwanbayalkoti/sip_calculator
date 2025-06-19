<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Complete Guide to SIP Investment: Building Wealth Through Systematic Investment Plans',
                'slug' => 'complete-guide-sip-investment',
                'excerpt' => 'Learn everything about Systematic Investment Plans (SIPs) - from basics to advanced strategies for wealth creation.',
                'content' => $this->getSipGuideContent(),
                'category' => 'SIP Investment',
                'tags' => ['SIP', 'Investment', 'Wealth Creation', 'Mutual Funds'],
                'author' => 'Financial Expert',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Understanding Mutual Fund Categories: Equity, Debt, and Hybrid Funds Explained',
                'slug' => 'mutual-fund-categories-explained',
                'excerpt' => 'A comprehensive guide to different types of mutual funds and how to choose the right one for your investment goals.',
                'content' => $this->getMutualFundContent(),
                'category' => 'Mutual Funds',
                'tags' => ['Mutual Funds', 'Equity', 'Debt', 'Hybrid', 'Investment'],
                'author' => 'Investment Advisor',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Tax Planning for Mutual Fund Investments: Maximizing Returns After Tax',
                'slug' => 'tax-planning-mutual-funds',
                'excerpt' => 'Essential tax considerations for mutual fund investors and strategies to optimize your after-tax returns.',
                'content' => $this->getTaxPlanningContent(),
                'category' => 'Tax Planning',
                'tags' => ['Tax', 'Capital Gains', 'ELSS', 'Tax Saving'],
                'author' => 'Tax Consultant',
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }

    private function getSipGuideContent(): string
    {
        return '<h2>What is SIP?</h2>
        <p>A Systematic Investment Plan (SIP) is an investment strategy that allows you to invest a fixed amount regularly in mutual funds. Instead of investing a lump sum, you invest smaller amounts at regular intervals, typically monthly.</p>
        
        <h2>Benefits of SIP</h2>
        <ul>
            <li><strong>Rupee Cost Averaging:</strong> You buy more units when prices are low and fewer when prices are high</li>
            <li><strong>Discipline:</strong> Forces you to save regularly</li>
            <li><strong>Flexibility:</strong> Start with as little as ₹500 per month</li>
            <li><strong>Power of Compounding:</strong> Your returns earn returns over time</li>
        </ul>
        
        <h2>How to Start SIP</h2>
        <ol>
            <li>Choose your investment goal</li>
            <li>Select the right mutual fund</li>
            <li>Decide on the investment amount</li>
            <li>Set up automatic deductions</li>
            <li>Monitor and review periodically</li>
        </ol>
        
        <h2>Example Calculation</h2>
        <p>If you invest ₹10,000 monthly for 10 years at 12% annual return:</p>
        <ul>
            <li>Total Investment: ₹12,00,000</li>
            <li>Expected Returns: ₹8,50,000</li>
            <li>Maturity Amount: ₹20,50,000</li>
        </ul>';
    }

    private function getMutualFundContent(): string
    {
        return '<h2>Types of Mutual Funds</h2>
        
        <h3>Equity Funds</h3>
        <p>Equity funds invest primarily in stocks and are suitable for long-term wealth creation. They offer higher potential returns but come with higher risk.</p>
        <ul>
            <li>Large Cap Funds</li>
            <li>Mid Cap Funds</li>
            <li>Small Cap Funds</li>
            <li>Multi Cap Funds</li>
        </ul>
        
        <h3>Debt Funds</h3>
        <p>Debt funds invest in fixed-income securities like bonds and are suitable for conservative investors seeking stable returns.</p>
        <ul>
            <li>Liquid Funds</li>
            <li>Ultra Short Term Funds</li>
            <li>Short Term Funds</li>
            <li>Long Term Funds</li>
        </ul>
        
        <h3>Hybrid Funds</h3>
        <p>Hybrid funds invest in both equity and debt instruments, offering a balanced approach to risk and returns.</p>
        <ul>
            <li>Balanced Funds</li>
            <li>Conservative Hybrid Funds</li>
            <li>Equity Savings Funds</li>
        </ul>
        
        <h2>How to Choose the Right Fund</h2>
        <ol>
            <li>Assess your risk tolerance</li>
            <li>Define your investment horizon</li>
            <li>Consider your financial goals</li>
            <li>Check fund performance and ratings</li>
            <li>Review expense ratios</li>
        </ol>';
    }

    private function getTaxPlanningContent(): string
    {
        return '<h2>Tax Implications of Mutual Fund Investments</h2>
        
        <h3>Equity Funds</h3>
        <p>For equity funds, the tax treatment depends on the holding period:</p>
        <ul>
            <li><strong>Short Term Capital Gains (STCG):</strong> If sold within 1 year - 15% tax</li>
            <li><strong>Long Term Capital Gains (LTCG):</strong> If held for more than 1 year - 10% tax on gains above ₹1 lakh</li>
        </ul>
        
        <h3>Debt Funds</h3>
        <p>For debt funds, the tax treatment is different:</p>
        <ul>
            <li><strong>STCG:</strong> If sold within 3 years - Added to income and taxed as per slab</li>
            <li><strong>LTCG:</strong> If held for more than 3 years - 20% with indexation benefit</li>
        </ul>
        
        <h2>Tax Saving Options</h2>
        
        <h3>ELSS (Equity Linked Saving Scheme)</h3>
        <p>ELSS funds offer tax deduction under Section 80C up to ₹1.5 lakh per year with a 3-year lock-in period.</p>
        
        <h3>Indexation Benefit</h3>
        <p>For debt funds held for more than 3 years, you can claim indexation benefit to reduce your tax liability.</p>
        
        <h2>Tax Planning Strategies</h2>
        <ol>
            <li>Use ELSS for tax saving</li>
            <li>Hold equity funds for more than 1 year</li>
            <li>Hold debt funds for more than 3 years</li>
            <li>Use indexation for debt funds</li>
            <li>Plan your withdrawals strategically</li>
        </ol>';
    }
} 