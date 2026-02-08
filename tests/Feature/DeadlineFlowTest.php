<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Deadline;
use App\Models\Process;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class DeadlineFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_deadlines_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/deadlines');
        $response->assertStatus(200);
        $response->assertSee('Meus Prazos');
    }

    public function test_user_can_create_deadline()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/deadlines', [
            'title' => 'Important Meeting',
            'due_date' => Carbon::now()->addDays(2)->format('Y-m-d\TH:i'),
            'status' => 'Pendente',
        ]);

        $response->assertRedirect('/deadlines');
        $this->assertDatabaseHas('deadlines', [
            'title' => 'Important Meeting',
            'user_id' => $user->id,
            'status' => 'Pendente',
        ]);
    }

    public function test_user_can_create_deadline_linked_to_process()
    {
        $user = User::factory()->create();
        $client = Client::create(['user_id' => $user->id, 'name' => 'John']);
        $process = Process::create([
            'user_id' => $user->id,
            'client_id' => $client->id,
            'title' => 'Divorce'
        ]);

        $response = $this->actingAs($user)->post('/deadlines', [
            'title' => 'Filing Docs',
            'process_id' => $process->id,
            'due_date' => Carbon::now()->addDays(5)->format('Y-m-d\TH:i'),
        ]);

        $response->assertRedirect('/deadlines');
        $this->assertDatabaseHas('deadlines', [
            'title' => 'Filing Docs',
            'process_id' => $process->id,
        ]);
    }

    public function test_user_can_update_deadline()
    {
        $user = User::factory()->create();

        $deadline = Deadline::create([
            'user_id' => $user->id,
            'title' => 'Old Task',
            'due_date' => Carbon::now(),
        ]);

        $response = $this->actingAs($user)->put("/deadlines/{$deadline->id}", [
            'title' => 'New Task Name',
            'due_date' => Carbon::now()->addDay()->format('Y-m-d\TH:i'),
            'status' => 'Concluído',
        ]);

        $response->assertRedirect('/deadlines');
        $this->assertDatabaseHas('deadlines', [
            'id' => $deadline->id,
            'title' => 'New Task Name',
            'status' => 'Concluído',
        ]);
    }

    public function test_user_cannot_access_others_deadlines()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $deadline = Deadline::create([
            'user_id' => $user1->id,
            'title' => 'User 1 Task',
            'due_date' => Carbon::now(),
        ]);

        // User 2 tries to edit User 1's deadline
        $response = $this->actingAs($user2)->get("/deadlines/{$deadline->id}/edit");
        $response->assertStatus(403);

        // User 2 tries to update User 1's deadline
        $response = $this->actingAs($user2)->put("/deadlines/{$deadline->id}", ['title' => 'Hacked', 'due_date' => now()]);
        $response->assertStatus(403);
    }
}
