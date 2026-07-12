<?php

namespace Tests\Feature;

use App\Domains\Expense\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_expense_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $expense = Expense::factory()->create();

        $this->actingAs($user)
            ->get('/expenses')
            ->assertOk()
            ->assertSee('Expenses')
            ->assertSee($expense->description);
    }
}