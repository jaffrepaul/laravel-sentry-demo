<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Sentry\State\HubInterface;
use Sentry\Tracing\TransactionContext;

class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService,
        private readonly HubInterface $hub
    ) {}

    public function store(SubmissionRequest $request): RedirectResponse
    {
        // Create a new transaction context for Sentry
        $context = new TransactionContext();
        $context->setName('Form Submission');
        $context->setOp('http.server'); // Labels this as an HTTP request

        // Start a new Sentry transaction
        $transaction = $this->hub->startTransaction($context);
        $this->hub->setSpan($transaction); // Set as the active span

        try {
            // Process form submission
            $this->submissionService->storeSubmission($request->validated());

            // Return success response
            return back()->with('success', 'Form submitted successfully!');
        } finally {
            $transaction->finish(); // Always finish the transaction
        }
    }
}