<?php

namespace App\Domains\Document\Services;

use App\Domains\Document\Models\Document;
use Illuminate\Pagination\LengthAwarePaginator;

class DocumentService
{
    public function getDocuments(int $perPage = 15): LengthAwarePaginator
    {
        return Document::with(['property', 'tenant'])->latest()->paginate($perPage);
    }

    public function getDocumentById(int $id): ?Document
    {
        return Document::with(['property', 'tenant'])->find($id);
    }
}
