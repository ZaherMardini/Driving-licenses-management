<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => fake()->name(),
          'email' => fake()->email,
          'phone' => fake()->phoneNumber(),
          'national_no' => fake()->numberBetween(10, 100),
          'date_of_birth' => fake()->date(),
          'country_id' => '1',
          'image_path' => '/images/defaults/male.png'
        ];
    }
}
