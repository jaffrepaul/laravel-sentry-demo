<?php

namespace Tests\Feature;

use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_form_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('form');
    }

    public function test_can_submit_valid_form()
    {
        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message!'
        ];

        $response = $this->post('/submit', $formData);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Form submitted successfully!');

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message!'
        ]);
    }

    public function test_validates_required_fields()
    {
        $response = $this->post('/submit', []);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('submissions', 0);
    }

    public function test_validates_email_format()
    {
        $formData = [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'message' => 'This is a test message!'
        ];

        $response = $this->post('/submit', $formData);

        $response->assertSessionHasErrors('email');
        $this->assertDatabaseCount('submissions', 0);
    }

    public function test_validates_field_lengths()
    {
        $formData = [
            'name' => str_repeat('a', 256),
            'email' => str_repeat('a', 256) . '@example.com',
            'message' => str_repeat('a', 1001)
        ];

        $response = $this->post('/submit', $formData);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('submissions', 0);
    }
}
