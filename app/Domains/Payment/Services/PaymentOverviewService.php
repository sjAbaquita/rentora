<?php

namespace App\Domains\Payment\Services;

use App\Domains\Payment\Enums\PaymentMethod;

class PaymentOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     methods: array<int, array{value: string, label: string}>,
     *     payments: array<int, array{
     *         reference_number: string,
     *         invoice_number: string,
     *         tenant_name: string,
     *         property_name: string,
     *         method: string,
     *         paid_at: string,
     *         amount: string,
     *         proof_status: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Payments posted',
                    'value' => '184',
                    'detail' => 'Captured against invoices this month',
                ],
                [
                    'label' => 'Cash total',
                    'value' => 'PHP 1.08M',
                    'detail' => 'Offline payments received by staff',
                ],
                [
                    'label' => 'Online total',
                    'value' => 'PHP 782K',
                    'detail' => 'Bank transfer and gateway payments',
                ],
                [
                    'label' => 'Pending proofs',
                    'value' => '11',
                    'detail' => 'Uploads awaiting review and approval',
                ],
            ],
            'methods' => PaymentMethod::options(),
            'payments' => [
                [
                    'reference_number' => 'PAY-2026-0081',
                    'invoice_number' => 'INV-2026-0014',
                    'tenant_name' => 'Maria Santos',
                    'property_name' => 'Aurora Residences',
                    'method' => PaymentMethod::Cash->label(),
                    'paid_at' => '2026-06-10 09:45',
                    'amount' => '18,500.00',
                    'proof_status' => 'Verified',
                ],
                [
                    'reference_number' => 'PAY-2026-0082',
                    'invoice_number' => 'INV-2026-0015',
                    'tenant_name' => 'John dela Cruz',
                    'property_name' => 'North Gate Building',
                    'method' => PaymentMethod::BankTransfer->label(),
                    'paid_at' => '2026-06-12 14:20',
                    'amount' => '12,000.00',
                    'proof_status' => 'Verified',
                ],
                [
                    'reference_number' => 'PAY-2026-0083',
                    'invoice_number' => 'INV-2026-0016',
                    'tenant_name' => 'Angela Reyes',
                    'property_name' => 'Campus Stay',
                    'method' => PaymentMethod::GCash->label(),
                    'paid_at' => '2026-06-08 18:10',
                    'amount' => '4,000.00',
                    'proof_status' => 'Pending review',
                ],
                [
                    'reference_number' => 'PAY-2026-0084',
                    'invoice_number' => 'INV-2026-0017',
                    'tenant_name' => 'Miguel Tan',
                    'property_name' => 'Harbor House',
                    'method' => PaymentMethod::Maya->label(),
                    'paid_at' => '2026-06-15 11:05',
                    'amount' => '12,500.00',
                    'proof_status' => 'Verified',
                ],
            ],
            'nextSteps' => [
                'Record payments against invoices and update balances automatically.',
                'Support proof-of-payment uploads and verification workflows.',
                'Add payment create, edit, and refund actions.',
                'Integrate future online gateways using the same payment abstraction layer.',
            ],
        ];
    }
}