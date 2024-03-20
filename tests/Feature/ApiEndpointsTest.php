<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{


    public function test_user_can_get_list_of_orders(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/orders');


        $response->assertStatus(200);
    }

    public function test_user_can_get_details_of_order(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/order/15');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_get_orders(): void
    {
        $response = $this->getJson('/api/v1/orders');

        $response->assertStatus(401);
    }

    public function test_unauthenticated_user_cannot_get_details_of_order(): void
    {
        $response = $this->getJson('/api/v1/order/15');

        $response->assertStatus(401);
    }
}
