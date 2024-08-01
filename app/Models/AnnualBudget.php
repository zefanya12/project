<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualBudget extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'amount'];

    public function monthlyBudgets()
    {
        return $this->hasMany(MonthlyBudget::class);
    }
}
