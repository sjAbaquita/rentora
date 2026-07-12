<?php

namespace App\Domains\Expense\Actions;

use App\Domains\Expense\Models\Expense;
use Illuminate\Support\Facades\DB;

class CreateExpenseAction
{
    public function handle(array $validatedData): Expense
    {
        return DB::transaction(function () use ($validatedData) {
            return Expense::create($validatedData);
        });
    }
}
