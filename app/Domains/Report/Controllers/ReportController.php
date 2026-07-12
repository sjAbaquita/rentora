<?php

namespace App\Domains\Report\Controllers;

use App\Domains\Report\Services\ReportOverviewService;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportOverviewService $reportOverviewService,
    ) {
    }

    /**
     * Show the report overview.
     */
    public function index(): Response
    {
        $this->authorize('viewAny', \App\Domains\Report\Services\ReportOverviewService::class);

        return Inertia::render('report/Index', $this->reportOverviewService->overview());
    }
}