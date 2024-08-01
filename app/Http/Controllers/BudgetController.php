<?php

namespace App\Http\Controllers;

use App\Models\AnnualBudget;
use App\Exports\AnnualBudgetExport;
use App\Models\MonthlyBudget;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BudgetController extends Controller
{
    public function exportAnnualBudget($id)
    {
        $annualBudget = AnnualBudget::findOrFail($id);
        return Excel::download(new AnnualBudgetExport($annualBudget), 'annual_budget.xlsx');
    }
    public function index()
    {
        $annualBudgets = AnnualBudget::with('monthlyBudgets.expenses')->get();
        foreach ($annualBudgets as $annualBudget) {
            $annualBudget->totalExpenses = $annualBudget->monthlyBudgets->sum(function ($monthlyBudget) {
                return $monthlyBudget->expenses->sum('item_cost');
            });
        }

        return view('budgets.index', compact('annualBudgets'));
    }

    public function createAnnualBudget()
    {
        return view('budgets.create_annual');
    }

    public function storeAnnualBudget(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:annual_budgets,year',
            'amount' => 'required|numeric'
        ]);
    
        AnnualBudget::create($request->all());
    
        return redirect()->route('budgets.index')->with('success', 'Annual budget created successfully.');
    }
    
    public function updateAnnualBudget(Request $request, $annualBudgetId)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'year' => 'required|integer|unique:annual_budgets,year,' . $annualBudgetId,
        ]);
    
        $annualBudget = AnnualBudget::findOrFail($annualBudgetId);
        $annualBudget->update($request->all());
    
        return redirect()->route('budgets.index')->with('success', 'Annual budget updated successfully.');
    }
    
    public function createMonthlyBudget($annualBudgetId)
    {
        $annualBudget = AnnualBudget::findOrFail($annualBudgetId);
    
        return view('budgets.create_monthly', compact('annualBudgetId'));
    }
    
    public function editMonthlyBudget($annualBudgetId, $monthlyBudgetId)
    {
        $monthlyBudget = MonthlyBudget::findOrFail($monthlyBudgetId);
    
        return view('budgets.edit_monthly', compact('annualBudgetId', 'monthlyBudget'));
    }

    public function storeMonthlyBudget(Request $request, $annualBudgetId)
    {
        $request->validate([
            'account_code' => 'required|string|unique:monthly_budgets,account_code,NULL,id,annual_budget_id,' . $annualBudgetId,
            'account_name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $monthlyBudget = new MonthlyBudget($request->all());
        $monthlyBudget->annual_budget_id = $annualBudgetId;
        $monthlyBudget->save();

        return redirect()->route('budgets.show_annual', $annualBudgetId)->with('success', 'Monthly budget created successfully.');
    }

    public function updateMonthlyBudget(Request $request, $annualBudgetId, $monthlyBudgetId)
    {
        $request->validate([
            'account_code' => 'required|string|unique:monthly_budgets,account_code,' . $monthlyBudgetId . ',id,annual_budget_id,' . $annualBudgetId,
            'account_name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $monthlyBudget = MonthlyBudget::findOrFail($monthlyBudgetId);
        $monthlyBudget->update($request->all());

        return redirect()->route('budgets.show_annual', $annualBudgetId)->with('success', 'Monthly budget updated successfully.');
    }

    public function createExpense($monthlyBudgetId)
    {
        $monthlyBudget = MonthlyBudget::findOrFail($monthlyBudgetId);
        return view('expenses.create', compact('monthlyBudget'));
    }

    public function storeExpense(Request $request, $monthlyBudgetId)
    {
        $request->validate([
            'item_name' => 'required|string',
            'item_cost' => 'required|numeric'
        ]);

        $monthlyBudget = MonthlyBudget::findOrFail($monthlyBudgetId);
        $monthlyBudget->expenses()->create($request->all());

        return redirect()->route('budgets.show_annual', $monthlyBudget->annual_budget_id);
    }

    public function showAnnualBudget($annualBudgetId)
    {
        $annualBudget = AnnualBudget::with('monthlyBudgets.expenses')->findOrFail($annualBudgetId);
        return view('budgets.show_annual', compact('annualBudget'));
    }

    public function destroyMonthlyBudget($annualBudgetId, $monthlyBudgetId)
    {
        $monthlyBudget = MonthlyBudget::findOrFail($monthlyBudgetId);
        $monthlyBudget->delete();

        return redirect()->route('budgets.show_annual', $annualBudgetId)->with('success', 'Monthly budget deleted successfully.');
    }

    public function destroyAnnualBudget($annualBudgetId)
    {
        $annualBudget = AnnualBudget::findOrFail($annualBudgetId);
        $annualBudget->monthlyBudgets()->delete(); // Delete all associated monthly budgets first
        $annualBudget->delete();

        return redirect()->route('budgets.index')->with('success', 'Annual budget deleted successfully.');
    }

    public function editAnnualBudget($annualBudgetId)
    {
        $annualBudget = AnnualBudget::findOrFail($annualBudgetId);
        return view('budgets.edit_annual', compact('annualBudget'));
    }
    
}
