<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Process;
use App\Models\Deadline;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a specific test user
        $user = User::factory()->create([
            'name' => 'Dr. Advogado',
            'email' => 'advogado@example.com',
            'password' => bcrypt('password'), // Ensure you have a known password
        ]);

        // Create 10 clients for this user
        $clients = Client::factory(10)
            ->for($user)
            ->create();

        // For each client, create processes
        $clients->each(function ($client) use ($user) {
            $processes = Process::factory(rand(1, 3))
                ->for($user)
                ->for($client)
                ->create();

            // For each process, create deadlines
            $processes->each(function ($process) use ($user) {
                Deadline::factory(rand(1, 4))
                    ->for($user)
                    ->for($process)
                    ->create();
            });
        });

        // Also create some standalone deadlines (not linked to a process)
        Deadline::factory(5)
            ->for($user)
            ->create([
                'process_id' => null,
            ]);
    }
}
