<?php

namespace App\Domains\Announcement\Requests;

use App\Domains\Announcement\Enums\AnnouncementPriority;
use App\Domains\Announcement\Enums\AnnouncementStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        $announcement = $this->route('announcement');

        return $announcement && $this->user()?->can('update', $announcement);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'sometimes|required|exists:properties,id',
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string|max:5000',
            'priority' => ['sometimes', 'required', 'string', Rule::enum(AnnouncementPriority::class)],
            'status' => ['sometimes', 'required', 'string', Rule::enum(AnnouncementStatus::class)],
            'publish_at' => 'nullable|date',
            'audience' => 'nullable|string|max:100',
        ];
    }
}
