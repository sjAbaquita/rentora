<?php

namespace App\Domains\Lease\Services;

class LeaseOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     leases: array<int, array{
     *         tenant_name: string,
     *         property_name: string,
     *         unit_name: string,
     *         start_date: string,
     *         end_date: string,
     *         monthly_rent: string,
     *         security_deposit: string,
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
                    'label' => 'Active leases',
                    'value' => '58',
                    'detail' => 'Lease agreements currently in force',
                ],
                [
                    'label' => 'Ending soon',
                    'value' => '9',
                    'detail' => 'Need renewal review this month',
                ],
                [
                    'label' => 'Deposits held',
                    'value' => 'PHP 1.42M',
                    'detail' => 'Security deposits tracked across active leases',
                ],
                [
                    'label' => 'Avg term',
                    'value' => '12 mo',
                    'detail' => 'Standard lease duration across the portfolio',
                ],
            ],
            'leases' => [
                [
                    'tenant_name' => 'Maria Santos',
                    'property_name' => 'Aurora Residences',
                    'unit_name' => 'A-1203',
                    'start_date' => '2025-01-15',
                    'end_date' => '2026-01-14',
                    'monthly_rent' => '18,500.00',
                    'security_deposit' => '18,500.00',
                    'status' => 'Active',
                ],
                [
                    'tenant_name' => 'John dela Cruz',
                    'property_name' => 'North Gate Building',
                    'unit_name' => 'B-2101',
                    'start_date' => '2025-04-01',
                    'end_date' => '2026-03-31',
                    'monthly_rent' => '24,000.00',
                    'security_deposit' => '24,000.00',
                    'status' => 'Active',
                ],
                [
                    'tenant_name' => 'Angela Reyes',
                    'property_name' => 'Campus Stay',
                    'unit_name' => 'R-05',
                    'start_date' => '2024-09-01',
                    'end_date' => '2025-08-31',
                    'monthly_rent' => '9,800.00',
                    'security_deposit' => '9,800.00',
                    'status' => 'For renewal',
                ],
                [
                    'tenant_name' => 'Miguel Tan',
                    'property_name' => 'Harbor House',
                    'unit_name' => 'H-02',
                    'start_date' => '2024-02-01',
                    'end_date' => '2025-01-31',
                    'monthly_rent' => '12,500.00',
                    'security_deposit' => '12,500.00',
                    'status' => 'Expired',
                ],
            ],
            'nextSteps' => [
                'Add lease create, edit, and terminate flows.',
                'Attach lease dates to invoice generation and payment schedules.',
                'Validate lease overlaps against unit availability.',
                'Expose active lease summaries in the tenant portal.',
            ],
        ];
    }
}