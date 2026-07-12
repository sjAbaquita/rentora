<?php

namespace App\Domains\Tenant\Services;

class TenantOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     tenants: array<int, array{
     *         name: string,
     *         property_name: string,
     *         unit_name: string,
     *         lease_status: string,
     *         balance: string,
     *         phone: string,
     *         email: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Active tenants',
                    'value' => '61',
                    'detail' => 'Across the live property portfolio',
                ],
                [
                    'label' => 'Active leases',
                    'value' => '58',
                    'detail' => 'Currently billed and monitored',
                ],
                [
                    'label' => 'Past due',
                    'value' => '6',
                    'detail' => 'Requires follow-up from owners or staff',
                ],
                [
                    'label' => 'Portal users',
                    'value' => '61',
                    'detail' => 'Tenants with tenant portal access',
                ],
            ],
            'tenants' => [
                [
                    'name' => 'Maria Santos',
                    'property_name' => 'Aurora Residences',
                    'unit_name' => 'A-1203',
                    'lease_status' => 'Active',
                    'balance' => '0.00',
                    'phone' => '+63 917 555 0142',
                    'email' => 'maria.santos@example.test',
                ],
                [
                    'name' => 'John dela Cruz',
                    'property_name' => 'North Gate Building',
                    'unit_name' => 'B-2101',
                    'lease_status' => 'Active',
                    'balance' => '1,250.00',
                    'phone' => '+63 917 555 0284',
                    'email' => 'john.delacruz@example.test',
                ],
                [
                    'name' => 'Angela Reyes',
                    'property_name' => 'Campus Stay',
                    'unit_name' => 'R-05',
                    'lease_status' => 'For renewal',
                    'balance' => '0.00',
                    'phone' => '+63 917 555 0395',
                    'email' => 'angela.reyes@example.test',
                ],
                [
                    'name' => 'Miguel Tan',
                    'property_name' => 'Harbor House',
                    'unit_name' => 'H-02',
                    'lease_status' => 'Past due',
                    'balance' => '4,800.00',
                    'phone' => '+63 917 555 0471',
                    'email' => 'miguel.tan@example.test',
                ],
            ],
            'nextSteps' => [
                'Persist tenant profiles with emergency contacts and documents.',
                'Link tenants to leases, invoices, and payment history.',
                'Add tenant portal actions for invoices, receipts, and maintenance requests.',
                'Surface tenant lifecycle events through notifications and reports.',
            ],
        ];
    }
}