<?php

namespace Tests\Feature;

use App\Domains\Invoice\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_invoice_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $invoice = Invoice::factory()->create();

        $this->actingAs($user)
            ->get('/invoices')
            ->assertOk()
            ->assertSee('Invoices')
            ->assertSee($invoice->invoice_number);
    }
}