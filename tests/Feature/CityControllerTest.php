<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityControllerTest extends TestCase
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

    public function test_guest_cannot_access_cities_index(): void
    {
        $response = $this->get(route('admin.cities.index'));
        $response->assertRedirect('/login');
    }

    public function test_non_admin_cannot_access_cities_index(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.cities.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_cities_index(): void
    {
        $city = City::factory()->create();
        
        $response = $this->actingAs($this->admin)->get(route('admin.cities.index'));
        $response->assertStatus(200);
        $response->assertSee($city->name);
    }

    public function test_admin_can_view_create_city_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.cities.create'));
        $response->assertStatus(200);
    }

    public function test_admin_can_store_city(): void
    {
        $data = [
            'name' => 'مطار الإسكندرية الدولي',
            'city' => 'الإسكندرية',
            'country' => 'مصر',
            'iata' => 'ALY',
            'can_be_from' => 1,
            'can_be_to' => 1,
            'description' => 'Beautiful city'
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.cities.store'), $data);
        $response->assertRedirect(route('admin.cities.index'));
        
        $this->assertDatabaseHas('cities', [
            'name' => 'مطار الإسكندرية الدولي',
            'city' => 'الإسكندرية',
            'country' => 'مصر',
            'iata' => 'ALY',
            'can_be_from' => true,
            'can_be_to' => true,
        ]);
    }

    public function test_admin_can_view_edit_city_page(): void
    {
        $city = City::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.cities.edit', $city->id));
        $response->assertStatus(200);
        $response->assertSee($city->name);
    }

    public function test_admin_can_update_city(): void
    {
        $city = City::factory()->create(['name' => 'Old Name']);

        $data = [
            'name' => 'New Name',
            'city' => 'New City',
            'country' => 'New Country',
            'iata' => 'NEW',
            'can_be_from' => 1,
            'description' => 'Updated desc'
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.cities.update', $city->id), $data);
        $response->assertRedirect(route('admin.cities.index'));

        $this->assertDatabaseHas('cities', [
            'id' => $city->id,
            'name' => 'New Name',
            'city' => 'New City',
            'country' => 'New Country',
            'iata' => 'NEW',
            'can_be_from' => true,
            'can_be_to' => false,
        ]);
    }

    public function test_admin_can_delete_city(): void
    {
        $city = City::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.cities.destroy', $city->id));
        $response->assertRedirect(route('admin.cities.index'));

        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }
}
