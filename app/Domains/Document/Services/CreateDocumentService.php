<?php

namespace App\Domains\Document\Services;

use App\Domains\Document\Models\Document;
use App\Domains\Document\Requests\StoreDocumentRequest;
use App\Domains\Document\Requests\UpdateDocumentRequest;

class CreateDocumentService
{
    /**
     * @param StoreDocumentRequest $request
     * @return Document
     */
    public function store(StoreDocumentRequest $request): Document
    {
        return Document::create($request->validated());
    }

    /**
     * @param Document $document
     * @param UpdateDocumentRequest $request
     * @return Document
     */
    public function update(Document $document, UpdateDocumentRequest $request): Document
    {
        $document->update($request->validated());

        return $document;
    }

    /**
     * @param Document $document
     * @return bool|null
     */
    public function destroy(Document $document): ?bool
    {
        return $document->delete();
    }
}
