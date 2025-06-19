<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inflation_adjusted_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('monthly_investment', 15, 2);
            $table->decimal('annual_return_rate', 5, 2);
            $table->decimal('inflation_rate', 5, 2);
            $table->integer('investment_duration');
            $table->decimal('nominal_maturity_amount', 15, 2);
            $table->decimal('real_maturity_amount', 15, 2);
            $table->decimal('total_investment', 15, 2);
            $table->decimal('real_interest', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inflation_adjusted_calculations');
    }
}; 