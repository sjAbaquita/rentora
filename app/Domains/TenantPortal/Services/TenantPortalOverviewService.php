<?php

namespace App\Domains\TenantPortal\Services;

class TenantPortalOverviewService
{
    /**
     * @return array{
     *     tenantProfile: array{name: string, email: string, phone: string, unit: string, property: string, lease_start: string, lease_end: string},
     *     leaseInfo: array{address: string, unit: string, lease_type: string, start_date: string, end_date: string, monthly_rent: string},
     *     recentInvoices: array<int, array{invoice_id: string, amount: string, due_date: string, status: string, period: string}>,
     *     recentPayments: array<int, array{payment_id: string, amount: string, date: string, method: string, reference: string}>,
     *     activeAnnouncements: array<int, array{title: string, posted_at: string, summary: string}>,
     *     maintenanceRequests: array<int, array{request_id: string, issue: string, submitted_at: string, status: string, priority: string}>,
     * }
     */
    public function overview(): array
    {
        return [
            'tenantProfile' => [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@email.com',
                'phone' => '09171234567',
                'unit' => 'Unit 4B',
                'property' => 'Aurora Residences',
                'lease_start' => '2025-01-15',
                'lease_end' => '2027-01-14',
            ],
            'leaseInfo' => [
                'address' => 'Aurora Residences, Makati City',
                'unit' => 'Unit 4B',
                'lease_type' => '2-year contract',
                'start_date' => '2025-01-15',
                'end_date' => '2027-01-14',
                'monthly_rent' => '₱35,000',
            ],
            'recentInvoices' => [
                [
                    'invoice_id' => 'INV-2026-0156',
                    'amount' => '₱35,000',
                    'due_date' => '2026-07-05',
                    'status' => 'Due soon',
                    'period' => 'June 2026',
                ],
                [
                    'invoice_id' => 'INV-2026-0145',
                    'amount' => '₱35,000',
                    'due_date' => '2026-06-05',
                    'status' => 'Paid',
                    'period' => 'May 2026',
                ],
                [
                    'invoice_id' => 'INV-2026-0134',
                    'amount' => '₱35,000',
                    'due_date' => '2026-05-05',
                    'status' => 'Paid',
                    'period' => 'April 2026',
                ],
            ],
            'recentPayments' => [
                [
                    'payment_id' => 'PAY-2026-0089',
                    'amount' => '₱35,000',
                    'date' => '2026-06-04',
                    'method' => 'GCash',
                    'reference' => 'G123456789',
                ],
                [
                    'payment_id' => 'PAY-2026-0078',
                    'amount' => '₱35,000',
                    'date' => '2026-05-04',
                    'method' => 'Bank transfer',
                    'reference' => 'BT-20260504-001',
                ],
                [
                    'payment_id' => 'PAY-2026-0067',
                    'amount' => '₱35,000',
                    'date' => '2026-04-04',
                    'method' => 'Debit card',
                    'reference' => 'DC-2026-04-001',
                ],
            ],
            'activeAnnouncements' => [
                [
                    'title' => 'June rent reminders',
                    'posted_at' => '2026-06-01',
                    'summary' => 'Reminder to settle monthly rent before the due date.',
                ],
                [
                    'title' => 'Lobby cleaning schedule',
                    'posted_at' => '2026-06-15',
                    'summary' => 'Updated cleaning schedule for shared spaces and hallways.',
                ],
            ],
            'maintenanceRequests' => [
                [
                    'request_id' => 'MNT-2026-0012',
                    'issue' => 'Faucet leak in kitchen',
                    'submitted_at' => '2026-06-18',
                    'status' => 'In progress',
                    'priority' => 'Medium',
                ],
                [
                    'request_id' => 'MNT-2026-0008',
                    'issue' => 'Air conditioning not cooling',
                    'submitted_at' => '2026-06-10',
                    'status' => 'Completed',
                    'priority' => 'High',
                ],
            ],
        ];
    }
}
