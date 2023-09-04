<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'profile_image' => null,
            'resume' => null,
            'gender' => null,
            'dob' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'permanent_address' => fake()->address(),
            'current_address' => fake()->address(),
            'contact_mobile' => '1111111111',
            'emp_code' => 'GSD'.fake()->unique()->numberBetween($min = 1, $max = 100),
            'qualification' => null,
            'designation' => fake()->numberBetween($min = 1, $max = 23),
            'reporting_manager' => fake()->numberBetween($min = 1, $max = 10),
            'ctc' => null,
            'personal_linkedin' => fake()->domainName(),
            'personal_skype' => fake()->domainName(),
            'personal_slack' => fake()->domainName(),
            'personal_github' => fake()->domainName(),
            'official_linkedin' => fake()->domainName(),
            'official_skype' => fake()->domainName(),
            'official_slack' => fake()->domainName(),
            'official_github' => fake()->domainName(),
            'official_email' => fake()->unique()->safeEmail(),
            'joining_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'leaving_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'fandf_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'blood_group' => fake()->numberBetween($min = 1, $max = 12),
            'contact_one_name' => fake()->unique()->name(),
            'contact_one_mobile' => '2222222222',
            'contact_one_relationship' => 'Mother',
            'contact_two_name' => fake()->unique()->name(),
            'contact_two_mobile' => '3333333333',
            'contact_two_relationship' => 'Father',
            'is_active' => ''.fake()->numberBetween($min = 0, $max = 1).'',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
            'time_zone' => 'Asia/Kolkata',
            'time_offset' => '+05:30'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
