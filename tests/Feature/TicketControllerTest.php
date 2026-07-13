<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\City;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;
    protected City $fromCity;
    protected City $toCity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->user = User::factory()->create();
        
        $this->fromCity = City::factory()->create();
        $this->toCity = City::factory()->create();
    }

    public function test_guest_cannot_access_tickets_index(): void
    {
        $response = $this->get(route('admin.tickets.index'));
        $response->assertRedirect('/login');
    }

    public function test_non_admin_cannot_access_tickets_index(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.tickets.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_tickets_index(): void
    {
        $ticket = Ticket::factory()->create([
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.tickets.index'));
        $response->assertStatus(200);
        $response->assertSee($this->fromCity->name);
    }

    public function test_admin_can_view_create_ticket_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.tickets.create'));
        $response->assertStatus(200);
    }

    public function test_admin_can_store_ticket(): void
    {
        $data = [
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'departure_date' => now()->addDays(5)->format('Y-m-d'),
            'trip_type' => 'one_way',
            'number_of_adults' => 2,
            'number_of_children' => 1,
            'number_of_babies' => 0,
            'price' => 3500.00,
            'description' => 'Test Ticket'
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.tickets.store'), $data);
        $response->assertRedirect(route('admin.tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'price' => 3500.00,
        ]);
    }

    public function test_admin_can_view_edit_ticket_page(): void
    {
        $ticket = Ticket::factory()->create([
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'trip_type' => 'round_trip',
            'return_date' => now()->addDays(10),
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.tickets.edit', $ticket->id));
        $response->assertStatus(200);
    }

    public function test_admin_can_store_round_trip_ticket(): void
    {
        $data = [
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'departure_date' => now()->addDays(5)->format('Y-m-d'),
            'trip_type' => 'round_trip',
            'return_date' => now()->addDays(7)->format('Y-m-d'),
            'number_of_adults' => 2,
            'number_of_children' => 0,
            'number_of_babies' => 0,
            'price' => 3800.00,
            'description' => 'Round trip test'
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.tickets.store'), $data);
        $response->assertRedirect(route('admin.tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'trip_type' => 'round_trip',
            'price' => 3800.00,
        ]);
    }

    public function test_admin_can_update_ticket(): void
    {
        $ticket = Ticket::factory()->create([
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'price' => 1000
        ]);

        $data = [
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'departure_date' => now()->addDays(10)->format('Y-m-d'),
            'trip_type' => 'one_way',
            'number_of_adults' => 3,
            'number_of_children' => 0,
            'number_of_babies' => 0,
            'price' => 2000.00,
            'description' => 'Updated desc'
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.tickets.update', $ticket->id), $data);
        $response->assertRedirect(route('admin.tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'price' => 2000.00,
        ]);
    }

    public function test_admin_can_delete_ticket(): void
    {
        $ticket = Ticket::factory()->create([
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.tickets.destroy', $ticket->id));
        $response->assertRedirect(route('admin.tickets.index'));

        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }

    public function test_admin_can_toggle_ticket_active_status(): void
    {
        $ticket = Ticket::factory()->create([
            'from_city_id' => $this->fromCity->id,
            'to_city_id' => $this->toCity->id,
            'is_active' => true
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.tickets.toggle', $ticket->id));
        $response->assertRedirect(route('admin.tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'is_active' => false,
        ]);
    }
}
