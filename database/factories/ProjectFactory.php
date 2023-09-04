<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->catchPhrase(),
            'client_id' => fake()->numberBetween($min = 1, $max = 5),
            'priority' => fake()->numberBetween($min = 1, $max = 3),
            'status' => fake()->numberBetween($min = 1, $max = 6),
            'start_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'due_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'objective' => fake()->paragraph(),
            'url' => fake()->url(),
            'type' => fake()->numberBetween($min = 1, $max = 2),
            'notes' => fake()->paragraph(),
            'remarks' => fake()->paragraph(),
            'credentials' => fake()->paragraph(),
            'created_by' => fake()->numberBetween($min = 1, $max = 11),
        ];
    }
}
