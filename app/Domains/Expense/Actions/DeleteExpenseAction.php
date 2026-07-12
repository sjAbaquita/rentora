<?php

namespace App\Domains\Expense\Actions;

use App\Domains\Expense\Models\Expense;
use Illuminate\Support\Facades\DB;

class DeleteExpenseAction
{
    public function handle(Expense $expense): void
    {
        DB::transaction(function () use ($expense) {
            $expense->delete();
        });
    }
}
