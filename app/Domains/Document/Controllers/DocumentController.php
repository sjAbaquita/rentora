<?php

namespace App\Domains\Document\Controllers;

use App\Domains\Document\Actions\CreateDocumentAction;
use App\Domains\Document\Actions\DeleteDocumentAction;
use App\Domains\Document\Actions\UpdateDocumentAction;
use App\Domains\Document\Models\Document;
use App\Domains\Document\Requests\StoreDocumentRequest;
use App\Domains\Document\Requests\UpdateDocumentRequest;
use App\Domains\Document\Services\DocumentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function __construct(
        private readonly DocumentService $documentService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Document::class);

        return Inertia::render('documents/Index', [
            'documents' => $this->documentService->getDocuments(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Document::class);

        return Inertia::render('documents/Create');
    }

    public function store(StoreDocumentRequest $request, CreateDocumentAction $action): RedirectResponse
    {
        $this->authorize('create', Document::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Document created.')]);

        return to_route('documents.index');
    }

    public function edit(Document $document): Response
    {
        $this->authorize('update', $document);

        return Inertia::render('documents/Edit', [
            'document' => $document,
        ]);
    }

    public function update(Document $document, UpdateDocumentRequest $request, UpdateDocumentAction $action): RedirectResponse
    {
        $this->authorize('update', $document);

        $action->handle($document, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Document updated.')]);

        return to_route('documents.index');
    }

    public function destroy(Document $document, DeleteDocumentAction $action): RedirectResponse
    {
        $this->authorize('delete', $document);

        $action->handle($document);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Document deleted.')]);

        return to_route('documents.index');
    }
}
