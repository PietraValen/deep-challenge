<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Process>
 */
class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->numerify('#######-##.####.#.##.####'), // CNJ format
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'court' => fake()->randomElement(['TJSP', 'TRT-2', 'JEC', 'STJ']),
            'status' => fake()->randomElement(['Em Andamento', 'Concluído', 'Arquivado']),
            'value' => fake()->randomFloat(2, 1000, 100000),
            'user_id' => \App\Models\User::factory(),
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
