<?php

namespace App\Domains\Document\Requests;

use App\Domains\Document\Enums\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $document = $this->route('document');

        return $document && $this->user()?->can('update', $document);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'sometimes|required|exists:properties,id',
            'tenant_id' => 'sometimes|nullable|exists:tenants,id',
            'title' => 'sometimes|required|string|max:255',
            'document_type' => ['sometimes', 'required', 'string', Rule::enum(DocumentType::class)],
            'file_path' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'uploaded_at' => 'sometimes|nullable|date',
        ];
    }
}
