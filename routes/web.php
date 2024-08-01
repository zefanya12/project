<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\BudgetController;

Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');
Route::get('/budgets/create-annual', [BudgetController::class, 'createAnnualBudget'])->name('budgets.create_annual');
Route::post('/budgets/store-annual', [BudgetController::class, 'storeAnnualBudget'])->name('budgets.store_annual');
Route::get('/budgets/{annualBudgetId}/create-monthly', [BudgetController::class, 'createMonthlyBudget'])->name('budgets.create_monthly');
Route::post('/budgets/{annualBudgetId}/store-monthly', [BudgetController::class, 'storeMonthlyBudget'])->name('budgets.store_monthly');
Route::get('/budgets/{monthlyBudgetId}/create-expense', [BudgetController::class, 'createExpense'])->name('expenses.create');
Route::post('/budgets/{monthlyBudgetId}/store-expense', [BudgetController::class, 'storeExpense'])->name('expenses.store');
Route::get('/budgets/{annualBudgetId}', [BudgetController::class, 'showAnnualBudget'])->name('budgets.show_annual');
Route::post('/budgets/{annualBudgetId}/create-monthly', [BudgetController::class, 'storeMonthlyBudget'])->name('budgets.store_monthly');
Route::delete('/budgets/{annualBudgetId}/delete-monthly/{monthlyBudgetId}', [BudgetController::class, 'destroyMonthlyBudget'])->name('budgets.destroy_monthly');
Route::delete('/budgets/{annualBudgetId}', [BudgetController::class, 'destroyAnnualBudget'])->name('budgets.destroy_annual');
Route::get('/budgets/{annualBudgetId}/edit', [BudgetController::class, 'editAnnualBudget'])->name('budgets.edit_annual');
Route::put('/budgets/{annualBudgetId}', [BudgetController::class, 'updateAnnualBudget'])->name('budgets.update_annual');
Route::post('/budgets', [BudgetController::class, 'storeAnnualBudget'])->name('budgets.store_annual');
Route::put('/budgets/{annualBudgetId}', [BudgetController::class, 'updateAnnualBudget'])->name('budgets.update_annual');
Route::post('/budgets/{annualBudgetId}/monthly', [BudgetController::class, 'storeMonthlyBudget'])->name('budgets.store_monthly');
Route::put('/budgets/{annualBudgetId}/monthly/{monthlyBudgetId}', [BudgetController::class, 'updateMonthlyBudget'])->name('budgets.update_monthly');
Route::get('/budgets/{annualBudgetId}/monthly/{monthlyBudgetId}/edit', [BudgetController::class, 'editMonthlyBudget'])
    ->name('budgets.edit_monthly');
Route::get('budgets/export/{id}', [BudgetController::class, 'exportAnnualBudget'])->name('budgets.export');
    