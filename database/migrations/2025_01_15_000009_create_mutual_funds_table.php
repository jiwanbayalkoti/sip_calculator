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
        Schema::create('mutual_funds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fund_house');
            $table->string('category'); // equity, debt, hybrid, liquid
            $table->string('sub_category')->nullable();
            $table->decimal('nav', 10, 4);
            $table->decimal('expense_ratio', 5, 2);
            $table->decimal('one_year_return', 5, 2)->nullable();
            $table->decimal('three_year_return', 5, 2)->nullable();
            $table->decimal('five_year_return', 5, 2)->nullable();
            $table->decimal('ten_year_return', 5, 2)->nullable();
            $table->decimal('min_investment', 10, 2);
            $table->decimal('min_sip', 10, 2);
            $table->string('rating')->nullable(); // 1-5 stars
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutual_funds');
    }
}; 