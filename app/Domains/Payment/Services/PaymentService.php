<?php

namespace App\Domains\Payment\Services;

use App\Domains\Payment\Models\Payment;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentService
{
    public function getPayments(int $perPage = 15): LengthAwarePaginator
    {
        return Payment::with(['invoice.lease.unit.property', 'tenant'])
            ->latest('paid_at')
            ->paginate($perPage);
    }

    public function getPaymentById(int $id): ?Payment
    {
        return Payment::with(['invoice.lease.unit.property', 'tenant'])->find($id);
    }

    /**
     * @return array<string, float|int>
     */
    public function getStats(): array
    {
        return [
            'total' => Payment::count(),
            'this_month' => Payment::whereMonth('paid_at', now()->month)
                ->whereYear('paid_at', now()->year)
                ->sum('amount'),
            'total_collected' => (float) Payment::sum('amount'),
        ];
    }
}
