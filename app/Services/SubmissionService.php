<?php

namespace App\Services;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionService
{
    public function storeSubmission(array $data): Submission
    {
        return Submission::create($data);
    }
}
