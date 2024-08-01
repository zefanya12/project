<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualBudgetsTable extends Migration
{
    public function up()
    {
        Schema::create('annual_budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('annual_budgets');
    }
}
