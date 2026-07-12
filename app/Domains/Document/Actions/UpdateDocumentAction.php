<?php

namespace App\Domains\Document\Actions;

use App\Domains\Document\Models\Document;
use Illuminate\Support\Facades\DB;

class UpdateDocumentAction
{
    public function handle(Document $document, array $validatedData): Document
    {
        return DB::transaction(function () use ($document, $validatedData) {
            $document->update($validatedData);
            return $document->refresh();
        });
    }
}
