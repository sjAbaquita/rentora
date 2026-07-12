<?php

namespace App\Domains\Expense\Controllers;

use App\Domains\Expense\Actions\CreateExpenseAction;
use App\Domains\Expense\Actions\DeleteExpenseAction;
use App\Domains\Expense\Actions\UpdateExpenseAction;
use App\Domains\Expense\Models\Expense;
use App\Domains\Expense\Requests\StoreExpenseRequest;
use App\Domains\Expense\Requests\UpdateExpenseRequest;
use App\Domains\Expense\Services\ExpenseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ExpenseController extends Controller
{
    public function __construct(
        private readonly ExpenseService $expenseService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Expense::class);

        return Inertia::render('expenses/Index', [
            'expenses' => $this->expenseService->getExpenses(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Expense::class);

        return Inertia::render('expenses/Create');
    }

    public function store(StoreExpenseRequest $request, CreateExpenseAction $action): RedirectResponse
    {
        $this->authorize('create', Expense::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Expense created.')]);

        return to_route('expenses.index');
    }

    public function edit(Expense $exp): Response
    {
        $this->authorize('update', $exp);

        return Inertia::render('expenses/Edit', [
            'expense' => $exp,
        ]);
    }

    public function update(Expense $exp, UpdateExpenseRequest $request, UpdateExpenseAction $action): RedirectResponse
    {
        $this->authorize('update', $exp);

        $action->handle($exp, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Expense updated.')]);

        return to_route('expenses.index');
    }

    public function destroy(Expense $exp, DeleteExpenseAction $action): RedirectResponse
    {
        $this->authorize('delete', $exp);

        $action->handle($exp);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Expense deleted.')]);

        return to_route('expenses.index');
    }
}
