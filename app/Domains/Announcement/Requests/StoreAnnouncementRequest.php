<?php

namespace App\Domains\Announcement\Requests;

use App\Domains\Announcement\Enums\AnnouncementPriority;
use App\Domains\Announcement\Enums\AnnouncementStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Announcement\Models\Announcement::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'priority' => ['required', 'string', Rule::enum(AnnouncementPriority::class)],
            'status' => ['required', 'string', Rule::enum(AnnouncementStatus::class)],
            'publish_at' => 'nullable|date',
            'audience' => 'nullable|string|max:100',
        ];
    }
}
