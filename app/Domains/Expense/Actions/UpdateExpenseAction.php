<?php

namespace App\Domains\Expense\Actions;

use App\Domains\Expense\Models\Expense;
use Illuminate\Support\Facades\DB;

class UpdateExpenseAction
{
    public function handle(Expense $expense, array $validatedData): Expense
    {
        return DB::transaction(function () use ($expense, $validatedData) {
            $expense->update($validatedData);
            return $expense->refresh();
        });
    }
}
