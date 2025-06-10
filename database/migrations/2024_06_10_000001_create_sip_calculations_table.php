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
        Schema::create('sip_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('monthly_investment', 10, 2);
            $table->decimal('annual_return_rate', 5, 2);
            $table->integer('investment_duration');
            $table->decimal('maturity_amount', 15, 2);
            $table->decimal('total_investment', 15, 2);
            $table->decimal('total_interest', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sip_calculations');
    }
}; 