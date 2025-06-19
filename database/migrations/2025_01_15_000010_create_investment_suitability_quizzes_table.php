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
        Schema::create('investment_suitability_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('risk_profile'); // conservative, moderate, aggressive
            $table->string('investment_goal'); // retirement, education, house, emergency
            $table->integer('investment_horizon'); // years
            $table->decimal('monthly_income', 15, 2);
            $table->decimal('monthly_expenses', 15, 2);
            $table->decimal('existing_investments', 15, 2)->default(0);
            $table->json('quiz_answers');
            $table->json('recommendations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_suitability_quizzes');
    }
}; 