<?php

namespace App\Domains\Report\Services;

class ReportOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     reportTypes: array<int, string>,
     *     exportFormats: array<int, string>,
     *     reports: array<int, array{
     *         title: string,
     *         scope: string,
     *         period: string,
     *         status: string,
     *         detail: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Income snapshots',
                    'value' => '18',
                    'detail' => 'Monthly and quarterly income views',
                ],
                [
                    'label' => 'Occupancy checks',
                    'value' => '9',
                    'detail' => 'Unit utilization and vacancy signals',
                ],
                [
                    'label' => 'Collection runs',
                    'value' => '24',
                    'detail' => 'Payment performance by period',
                ],
                [
                    'label' => 'Exports',
                    'value' => 'PDF / XLS / CSV',
                    'detail' => 'Shared across owner and finance workflows',
                ],
            ],
            'reportTypes' => [
                'Income reports',
                'Occupancy reports',
                'Collection reports',
            ],
            'exportFormats' => [
                'PDF',
                'Excel',
                'CSV',
            ],
            'reports' => [
                [
                    'title' => 'June income report',
                    'scope' => 'All properties',
                    'period' => '2026-06',
                    'status' => 'Ready',
                    'detail' => 'Summarizes rent, fees, and other recurring income.',
                ],
                [
                    'title' => 'Occupancy report - North cluster',
                    'scope' => 'North cluster',
                    'period' => '2026-Q2',
                    'status' => 'Draft',
                    'detail' => 'Tracks occupied, vacant, and reserved units.',
                ],
                [
                    'title' => 'Collection report - month to date',
                    'scope' => 'Active leases',
                    'period' => '2026-06',
                    'status' => 'Ready',
                    'detail' => 'Shows collected versus outstanding balances.',
                ],
                [
                    'title' => 'Collections aging summary',
                    'scope' => 'All tenants',
                    'period' => '2026-06',
                    'status' => 'Queued',
                    'detail' => 'Highlights overdue and partially paid invoices.',
                ],
            ],
            'nextSteps' => [
                'Connect the report cards to live financial and occupancy aggregates.',
                'Add parameterized filtering by property, date range, and report type.',
                'Implement PDF, Excel, and CSV export jobs.',
                'Persist generated report runs for audit and sharing.',
            ],
        ];
    }
}