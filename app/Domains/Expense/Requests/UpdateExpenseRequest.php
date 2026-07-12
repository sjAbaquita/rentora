<?php

namespace App\Domains\Expense\Requests;

use App\Domains\Expense\Enums\ExpenseCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $expense = $this->route('expense');

        return $expense && $this->user()?->can('update', $expense);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'sometimes|required|exists:properties,id',
            'category' => ['sometimes', 'required', 'string', Rule::enum(ExpenseCategory::class)],
            'amount' => 'sometimes|required|numeric|min:0',
            'expense_date' => 'sometimes|required|date',
            'description' => 'nullable|string|max:1000',
            'reference_number' => 'nullable|string|max:100',
        ];
    }
}
