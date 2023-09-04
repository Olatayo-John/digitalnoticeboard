<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'project_id' => fake()->numberBetween($min = 1, $max = 20),
            'assigned_to' => fake()->numberBetween($min = 1, $max = 11),
            'assigned_by' => fake()->numberBetween($min = 1, $max = 11),
            'start_date_time' => fake()->dateTime($max = 'now', $timezone = null),
            'end_date_time' => fake()->dateTime($max = 'now', $timezone = null),
            'priority' => fake()->numberBetween($min = 1, $max = 3),
            'status' => fake()->numberBetween($min = 1, $max = 6),
            'description' => fake()->paragraph(),
            'remarks' => fake()->paragraph(),
            'notes' => fake()->paragraph(),
            'billable' => '' . fake()->numberBetween($min = 0, $max = 1).'',
            'file' => null,
            'created_by' => fake()->numberBetween($min = 1, $max = 11),
        ];
    }
}
