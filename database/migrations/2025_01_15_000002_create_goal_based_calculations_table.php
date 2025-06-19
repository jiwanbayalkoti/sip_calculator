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
        Schema::create('goal_based_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('goal_name');
            $table->decimal('target_amount', 15, 2);
            $table->integer('time_period');
            $table->decimal('annual_return_rate', 5, 2);
            $table->decimal('required_monthly_sip', 15, 2);
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
        Schema::dropIfExists('goal_based_calculations');
    }
}; 