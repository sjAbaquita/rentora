<?php

namespace App\Domains\Invoice\Actions;

use App\Domains\Invoice\Models\Invoice;
use Illuminate\Support\Facades\DB;

class UpdateInvoiceAction
{
    public function handle(Invoice $invoice, array $validatedData): Invoice
    {
        return DB::transaction(function () use ($invoice, $validatedData) {
            $invoice->update($validatedData);
            $invoice->refresh()->reconcile();

            return $invoice;
        });
    }
}
