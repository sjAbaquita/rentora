<?php

namespace App\Domains\Expense\Services;

use App\Domains\Expense\Models\Expense;
use App\Domains\Expense\Requests\StoreExpenseRequest;
use App\Domains\Expense\Requests\UpdateExpenseRequest;

class CreateExpenseService
{
    /**
     * @param StoreExpenseRequest $request
     * @return Expense
     */
    public function store(StoreExpenseRequest $request): Expense
    {
        return Expense::create($request->validated());
    }

    /**
     * @param Expense $expense
     * @param UpdateExpenseRequest $request
     * @return Expense
     */
    public function update(Expense $expense, UpdateExpenseRequest $request): Expense
    {
        $expense->update($request->validated());

        return $expense;
    }

    /**
     * @param Expense $expense
     * @return bool|null
     */
    public function destroy(Expense $expense): ?bool
    {
        return $expense->delete();
    }
}
