<?php

namespace App\Domains\Invoice\Services;

use App\Domains\Invoice\Models\Invoice;
use App\Domains\Invoice\Requests\StoreInvoiceRequest;
use App\Domains\Invoice\Requests\UpdateInvoiceRequest;

class CreateInvoiceService
{
    /**
     * @param StoreInvoiceRequest $request
     * @return Invoice
     */
    public function store(StoreInvoiceRequest $request): Invoice
    {
        return Invoice::create($request->validated());
    }

    /**
     * @param Invoice $invoice
     * @param UpdateInvoiceRequest $request
     * @return Invoice
     */
    public function update(Invoice $invoice, UpdateInvoiceRequest $request): Invoice
    {
        $invoice->update($request->validated());

        return $invoice;
    }

    /**
     * @param Invoice $invoice
     * @return bool|null
     */
    public function destroy(Invoice $invoice): ?bool
    {
        return $invoice->delete();
    }
}
