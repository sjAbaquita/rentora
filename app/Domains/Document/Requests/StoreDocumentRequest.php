<?php

namespace App\Domains\Document\Requests;

use App\Domains\Document\Enums\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Document\Models\Document::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'title' => 'required|string|max:255',
            'document_type' => ['required', 'string', Rule::enum(DocumentType::class)],
            'file_path' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'uploaded_at' => 'nullable|date',
        ];
    }
}
