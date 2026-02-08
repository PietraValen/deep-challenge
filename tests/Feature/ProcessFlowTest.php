<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Process;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_processes_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/processes');
        $response->assertStatus(200);
        $response->assertSee('Meus Processos');
    }

    public function test_user_can_create_process()
    {
        $user = User::factory()->create();
        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
        ]);

        $response = $this->actingAs($user)->post('/processes', [
            'client_id' => $client->id,
            'title' => 'Ação de Cobrança',
            'status' => 'Em Andamento',
            'court' => '1ª Vara Cível',
            'value' => '1.500,00',
        ]);

        $response->assertRedirect('/processes');
        $this->assertDatabaseHas('processes', [
            'title' => 'Ação de Cobrança',
            'client_id' => $client->id,
            'value' => 1500.00,
        ]);
    }

    public function test_user_can_update_process()
    {
        $user = User::factory()->create();
        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
        ]);

        $process = Process::create([
            'user_id' => $user->id,
            'client_id' => $client->id,
            'title' => 'Old Title',
            'status' => 'Em Andamento',
        ]);

        $response = $this->actingAs($user)->put("/processes/{$process->id}", [
            'client_id' => $client->id,
            'title' => 'New Title',
            'status' => 'Concluído',
        ]);

        $response->assertRedirect('/processes');
        $this->assertDatabaseHas('processes', [
            'id' => $process->id,
            'title' => 'New Title',
            'status' => 'Concluído',
        ]);
    }

    public function test_user_cannot_access_others_processes()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $client = Client::create(['user_id' => $user1->id, 'name' => 'Client 1']);

        $process = Process::create([
            'user_id' => $user1->id,
            'client_id' => $client->id,
            'title' => 'Process of User 1',
        ]);

        // User 2 tries to edit User 1's process
        $response = $this->actingAs($user2)->get("/processes/{$process->id}/edit");
        $response->assertStatus(403);

        // User 2 tries to update User 1's process
        $response = $this->actingAs($user2)->put("/processes/{$process->id}", ['title' => 'Hacked']);
        $response->assertStatus(403);
    }
}
