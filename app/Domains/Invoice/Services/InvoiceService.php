<?php

namespace App\Domains\Invoice\Services;

use App\Domains\Invoice\Enums\InvoiceStatus;
use App\Domains\Invoice\Models\Invoice;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function getInvoices(int $perPage = 15): LengthAwarePaginator
    {
        return Invoice::with(['lease.unit.property', 'lease.tenant'])
            ->latest('due_date')
            ->paginate($perPage);
    }

    public function getInvoiceById(int $id): ?Invoice
    {
        return Invoice::with(['lease.unit.property', 'lease.tenant', 'payments'])->find($id);
    }

    /**
     * @return array<string, float|int>
     */
    public function getStats(): array
    {
        return [
            'total' => Invoice::count(),
            'pending' => Invoice::where('status', InvoiceStatus::Pending)->count(),
            'overdue' => Invoice::where('status', InvoiceStatus::Overdue)->count(),
            'paid' => Invoice::where('status', InvoiceStatus::Paid)->count(),
            'total_outstanding' => (float) Invoice::whereIn('status', [InvoiceStatus::Pending, InvoiceStatus::Overdue, InvoiceStatus::Partial])
                ->sum('amount_due'),
        ];
    }

    public function markOverdueInvoices(): int
    {
        return Invoice::whereIn('status', [InvoiceStatus::Pending, InvoiceStatus::Partial])
            ->where('due_date', '<', today())
            ->update(['status' => InvoiceStatus::Overdue]);
    }
}
