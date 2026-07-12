<?php

namespace App\Domains\Expense\Services;

use App\Domains\Expense\Models\Expense;
use Illuminate\Pagination\LengthAwarePaginator;

class ExpenseService
{
    public function getExpenses(int $perPage = 15): LengthAwarePaginator
    {
        return Expense::with('property')->latest('expense_date')->paginate($perPage);
    }

    public function getExpenseById(int $id): ?Expense
    {
        return Expense::with('property')->find($id);
    }

    /**
     * @return array<string, float|int>
     */
    public function getStats(): array
    {
        return [
            'total' => Expense::count(),
            'this_month' => Expense::whereMonth('expense_date', now()->month)
                ->whereYear('expense_date', now()->year)
                ->sum('amount'),
            'total_amount' => (float) Expense::sum('amount'),
        ];
    }
}
