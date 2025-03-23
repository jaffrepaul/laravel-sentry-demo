<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;

class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService
    ) {}

    public function store(SubmissionRequest $request): RedirectResponse
    {
        $this->submissionService->storeSubmission($request->validated());

        return back()->with('success', 'Form submitted successfully!');
    }
}
