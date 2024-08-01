<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'annual_budget_id',
        'account_code',
        'account_name',
        'amount',
    ];

    public function annualBudget()
    {
        return $this->belongsTo(AnnualBudget::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
