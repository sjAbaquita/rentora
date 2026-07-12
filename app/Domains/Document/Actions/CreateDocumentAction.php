<?php

namespace App\Domains\Document\Actions;

use App\Domains\Document\Models\Document;
use Illuminate\Support\Facades\DB;

class CreateDocumentAction
{
    public function handle(array $validatedData): Document
    {
        return DB::transaction(function () use ($validatedData) {
            return Document::create($validatedData);
        });
    }
}
