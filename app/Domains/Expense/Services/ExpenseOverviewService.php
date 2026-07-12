<?php

namespace App\Domains\Expense\Services;

use App\Domains\Expense\Enums\ExpenseCategory;

class ExpenseOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     categories: array<int, array{value: string, label: string}>,
     *     expenses: array<int, array{
     *         expense_date: string,
     *         category: string,
     *         description: string,
     *         property_name: string,
     *         amount: string,
     *         reference_number: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Monthly expenses',
                    'value' => 'PHP 286K',
                    'detail' => 'Costs booked in the current month',
                ],
                [
                    'label' => 'Utilities',
                    'value' => 'PHP 124K',
                    'detail' => 'Electricity, water, and internet',
                ],
                [
                    'label' => 'Repairs',
                    'value' => 'PHP 91K',
                    'detail' => 'Unit and property repair expenses',
                ],
                [
                    'label' => 'Pending receipts',
                    'value' => '5',
                    'detail' => 'Expenses awaiting supporting documents',
                ],
            ],
            'categories' => ExpenseCategory::options(),
            'expenses' => [
                [
                    'expense_date' => '2026-06-03',
                    'category' => ExpenseCategory::Utilities->label(),
                    'description' => 'Electricity for common areas',
                    'property_name' => 'Aurora Residences',
                    'amount' => '42,800.00',
                    'reference_number' => 'EXP-2026-0008',
                ],
                [
                    'expense_date' => '2026-06-07',
                    'category' => ExpenseCategory::Repairs->label(),
                    'description' => 'Aircon compressor replacement',
                    'property_name' => 'North Gate Building',
                    'amount' => '18,500.00',
                    'reference_number' => 'EXP-2026-0009',
                ],
                [
                    'expense_date' => '2026-06-11',
                    'category' => ExpenseCategory::Supplies->label(),
                    'description' => 'Cleaning supplies and consumables',
                    'property_name' => 'Campus Stay',
                    'amount' => '6,300.00',
                    'reference_number' => 'EXP-2026-0010',
                ],
                [
                    'expense_date' => '2026-06-15',
                    'category' => ExpenseCategory::Administration->label(),
                    'description' => 'Office and filing expenses',
                    'property_name' => 'Portfolio-wide',
                    'amount' => '12,750.00',
                    'reference_number' => 'EXP-2026-0011',
                ],
            ],
            'nextSteps' => [
                'Add expense create, edit, and delete flows.',
                'Attach receipts and supporting documents to each expense.',
                'Aggregate monthly totals for the reports module.',
                'Track categories and compare budgeted vs actual spend.'
            ],
        ];
    }
}