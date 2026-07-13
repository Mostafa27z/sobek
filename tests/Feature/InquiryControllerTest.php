<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InquiryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->user = User::factory()->create();
    }

    public function test_inquiry_create_page_renders(): void
    {
        $response = $this->get(route('inquiry.create'));
        $response->assertStatus(200);
    }

    public function test_can_submit_inquiry(): void
    {
        $data = [
            'full_name' => 'John Doe',
            'phone_number' => '+201012345678',
            'email' => 'john@example.com',
            'from_city' => 'Cairo',
            'to_city' => 'Riyadh',
            'desired_date' => now()->addDays(7)->format('Y-m-d'),
            'number_of_adults' => 2,
            'number_of_children' => 0,
            'number_of_babies' => 0,
            'message' => 'I would like to book a flight with luggage included.'
        ];

        $response = $this->post(route('inquiry.store'), $data);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('inquiries', [
            'full_name' => 'John Doe',
            'phone_number' => '+201012345678',
            'status' => 'pending'
        ]);
    }

    public function test_guest_cannot_access_inquiries_admin(): void
    {
        $response = $this->get(route('admin.inquiries.index'));
        $response->assertRedirect('/login');
    }

    public function test_non_admin_cannot_access_inquiries_admin(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.inquiries.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_inquiries_admin(): void
    {
        $inquiry = Inquiry::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->get(route('admin.inquiries.index'));
        $response->assertStatus(200);
        $response->assertSee($inquiry->full_name);
    }

    public function test_admin_can_mark_inquiry_as_read(): void
    {
        $inquiry = Inquiry::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->post(route('admin.inquiries.read', $inquiry->id));
        $response->assertStatus(302);

        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'status' => 'read',
        ]);
    }
}
