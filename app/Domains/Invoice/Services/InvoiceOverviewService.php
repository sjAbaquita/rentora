<?php

namespace App\Domains\Invoice\Services;

use App\Domains\Invoice\Enums\InvoiceStatus;

class InvoiceOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     statuses: array<int, array{value: string, label: string}>,
     *     invoices: array<int, array{
     *         invoice_number: string,
     *         tenant_name: string,
     *         property_name: string,
     *         unit_name: string,
     *         billing_period: string,
     *         due_date: string,
     *         amount_due: string,
     *         late_fee: string,
     *         status: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Open invoices',
                    'value' => '27',
                    'detail' => 'Pending, partial, and overdue invoices',
                ],
                [
                    'label' => 'Collected this month',
                    'value' => 'PHP 1.86M',
                    'detail' => 'Total paid invoices for the current cycle',
                ],
                [
                    'label' => 'Late fees',
                    'value' => 'PHP 42K',
                    'detail' => 'Fees awaiting settlement or posting',
                ],
                [
                    'label' => 'Paid invoices',
                    'value' => '184',
                    'detail' => 'Invoices settled in the current period',
                ],
            ],
            'statuses' => InvoiceStatus::options(),
            'invoices' => [
                [
                    'invoice_number' => 'INV-2026-0014',
                    'tenant_name' => 'Maria Santos',
                    'property_name' => 'Aurora Residences',
                    'unit_name' => 'A-1203',
                    'billing_period' => 'June 2026',
                    'due_date' => '2026-06-10',
                    'amount_due' => '18,500.00',
                    'late_fee' => '0.00',
                    'status' => InvoiceStatus::Paid->label(),
                ],
                [
                    'invoice_number' => 'INV-2026-0015',
                    'tenant_name' => 'John dela Cruz',
                    'property_name' => 'North Gate Building',
                    'unit_name' => 'B-2101',
                    'billing_period' => 'June 2026',
                    'due_date' => '2026-06-12',
                    'amount_due' => '24,000.00',
                    'late_fee' => '0.00',
                    'status' => InvoiceStatus::Partial->label(),
                ],
                [
                    'invoice_number' => 'INV-2026-0016',
                    'tenant_name' => 'Angela Reyes',
                    'property_name' => 'Campus Stay',
                    'unit_name' => 'R-05',
                    'billing_period' => 'June 2026',
                    'due_date' => '2026-06-08',
                    'amount_due' => '9,800.00',
                    'late_fee' => '490.00',
                    'status' => InvoiceStatus::Overdue->label(),
                ],
                [
                    'invoice_number' => 'INV-2026-0017',
                    'tenant_name' => 'Miguel Tan',
                    'property_name' => 'Harbor House',
                    'unit_name' => 'H-02',
                    'billing_period' => 'June 2026',
                    'due_date' => '2026-06-15',
                    'amount_due' => '12,500.00',
                    'late_fee' => '0.00',
                    'status' => InvoiceStatus::Pending->label(),
                ],
            ],
            'nextSteps' => [
                'Generate monthly invoices automatically from lease records.',
                'Add invoice item lines for rent, late fees, and adjustments.',
                'Attach payments to invoices and recalculate balances.',
                'Export invoice PDFs and receipts for the tenant portal.',
            ],
        ];
    }
}