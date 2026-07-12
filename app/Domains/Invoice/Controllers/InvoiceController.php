<?php

namespace App\Domains\Invoice\Controllers;

use App\Domains\Invoice\Actions\CreateInvoiceAction;
use App\Domains\Invoice\Actions\DeleteInvoiceAction;
use App\Domains\Invoice\Actions\UpdateInvoiceAction;
use App\Domains\Invoice\Models\Invoice;
use App\Domains\Invoice\Requests\StoreInvoiceRequest;
use App\Domains\Invoice\Requests\UpdateInvoiceRequest;
use App\Domains\Invoice\Services\InvoiceService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class InvoiceController extends Controller
{
    public function __construct(
        private readonly InvoiceService $invoiceService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Invoice::class);

        return Inertia::render('invoices/Index', [
            'invoices' => $this->invoiceService->getInvoices(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Invoice::class);

        return Inertia::render('invoices/Create');
    }

    public function store(StoreInvoiceRequest $request, CreateInvoiceAction $action): RedirectResponse
    {
        $this->authorize('create', Invoice::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Invoice created.')]);

        return to_route('invoices.index');
    }

    public function edit(Invoice $invoice): Response
    {
        $this->authorize('update', $invoice);

        return Inertia::render('invoices/Edit', [
            'invoice' => $invoice,
        ]);
    }

    public function update(Invoice $invoice, UpdateInvoiceRequest $request, UpdateInvoiceAction $action): RedirectResponse
    {
        $this->authorize('update', $invoice);

        $action->handle($invoice, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Invoice updated.')]);

        return to_route('invoices.index');
    }

    public function destroy(Invoice $invoice, DeleteInvoiceAction $action): RedirectResponse
    {
        $this->authorize('delete', $invoice);

        $action->handle($invoice);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Invoice deleted.')]);

        return to_route('invoices.index');
    }
}
