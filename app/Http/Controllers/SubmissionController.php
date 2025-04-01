<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Sentry\Breadcrumbs\Breadcrumb;

class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService
    ) {}

    public function store(SubmissionRequest $request): RedirectResponse
    {
        // Add breadcrumb for form submission context
        \Sentry\addBreadcrumb(
            type: 'info',
            category: 'started',
            level: 'info',
            message: 'this is a message',
      );

        // Process form submission
        $this->submissionService->storeSubmission($request->validated());

        // Return success response
        return back()->with('success', 'Form submitted successfully!');
    }
}