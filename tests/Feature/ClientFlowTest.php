<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_clients_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/clients');
        $response->assertStatus(200);
        $response->assertSee('Meus Clientes');
    }

    public function test_user_can_create_client()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/clients', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'document' => '12345678900',
            'phone' => '123456789',
        ]);

        $response->assertRedirect('/clients');
        $this->assertDatabaseHas('clients', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_client()
    {
        $user = User::factory()->create();
        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@old.com',
        ]);

        $response = $this->actingAs($user)->put("/clients/{$client->id}", [
            'name' => 'Jane Doe',
            'email' => 'jane@new.com',
        ]);

        $response->assertRedirect('/clients');
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Jane Doe',
            'email' => 'jane@new.com',
        ]);
    }

    public function test_user_cannot_access_others_clients()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $client = Client::create([
            'user_id' => $user1->id,
            'name' => 'Client of User 1',
        ]);

        // User 2 tries to edit User 1's client
        $response = $this->actingAs($user2)->get("/clients/{$client->id}/edit");
        $response->assertStatus(403);

        // User 2 tries to update User 1's client
        $response = $this->actingAs($user2)->put("/clients/{$client->id}", ['name' => 'Hacked']);
        $response->assertStatus(403);
    }
}
