<?php

namespace App\Domains\Invoice\Actions;

use App\Domains\Invoice\Models\Invoice;
use Illuminate\Support\Facades\DB;

class CreateInvoiceAction
{
    public function handle(array $validatedData): Invoice
    {
        return DB::transaction(function () use ($validatedData) {
            return Invoice::create($validatedData);
        });
    }
}
