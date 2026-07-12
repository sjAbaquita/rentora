<?php

namespace App\Domains\Invoice\Actions;

use App\Domains\Invoice\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DeleteInvoiceAction
{
    public function handle(Invoice $invoice): void
    {
        DB::transaction(function () use ($invoice) {
            $invoice->delete();
        });
    }
}
