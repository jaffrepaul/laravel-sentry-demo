<?php

namespace Tests\Unit;

use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    private SubmissionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SubmissionService();
    }

    public function test_can_store_submission()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ];

        $submission = $this->service->storeSubmission($data);

        $this->assertInstanceOf(Submission::class, $submission);
        $this->assertEquals('John Doe', $submission->name);
        $this->assertEquals('john@example.com', $submission->email);
        $this->assertEquals('Test message', $submission->message);
    }

    public function test_submission_has_timestamps()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ];

        $submission = $this->service->storeSubmission($data);

        $this->assertNotNull($submission->created_at);
        $this->assertNotNull($submission->updated_at);
    }

    public function test_submission_has_id()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ];

        $submission = $this->service->storeSubmission($data);

        $this->assertNotNull($submission->id);
        $this->assertIsInt($submission->id);
    }

    public function test_submission_data_is_persisted()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ];

        $submission = $this->service->storeSubmission($data);

        $this->assertDatabaseHas('submissions', [
            'id' => $submission->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ]);
    }
}
