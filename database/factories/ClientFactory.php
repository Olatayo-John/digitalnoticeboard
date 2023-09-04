<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_type_id' => fake()->numberBetween($min = 1, $max = 2),
            'name' => fake()->name(),
            'profile_image' => null,
            'email' => fake()->unique()->safeEmail(),
            'mobile' => '1111111111',
            'linkedin' => fake()->domainName(),
            'skype' => fake()->domainName(),
            'slack' => fake()->domainName(),
            'company_name' => fake()->company(),
            'company_country' => fake()->country(),
            'company_state' => fake()->state(),
            'business_since' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'is_active' => '' . fake()->numberBetween($min = 0, $max = 1) . '',
        ];
    }
}
