<?php

namespace App\Domains\Document\Actions;

use App\Domains\Document\Models\Document;
use Illuminate\Support\Facades\DB;

class DeleteDocumentAction
{
    public function handle(Document $document): void
    {
        DB::transaction(function () use ($document) {
            $document->delete();
        });
    }
}
