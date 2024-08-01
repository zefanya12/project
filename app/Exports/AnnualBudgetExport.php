<?php

namespace App\Exports;

use App\Models\AnnualBudget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnnualBudgetExport implements FromView
{
    protected $annualBudget;

    public function __construct(AnnualBudget $annualBudget)
    {
        $this->annualBudget = $annualBudget;
    }

    public function view(): View
    {
        return view('exports.annual_budget', [
            'annualBudget' => $this->annualBudget,
            'monthlyBudgets' => $this->annualBudget->monthlyBudgets()->with('expenses')->get(),
        ]);
    }
}
