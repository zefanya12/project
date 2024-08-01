<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyBudgetsTable extends Migration
{
    public function up()
    {
        Schema::create('monthly_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annual_budget_id')->constrained()->onDelete('cascade');
            $table->string('account_code');
            $table->string('account_name');
            $table->string('amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monthly_budgets');
    }
}
