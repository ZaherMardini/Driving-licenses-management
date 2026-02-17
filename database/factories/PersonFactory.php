<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

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
          'gender' => fake()->randomElement(['male', 'female']),
          'image_path' => function(array $attributes){  
              return $attributes['gender'] === 'male' ?
              '/images/defaults/male.png' : '/images/defaults/female.png';
          },
          'national_no' => fake()->numberBetween(10, 100),
          'date_of_birth' => fake()->date('Y-m-d', '2008-01-01'), // min age 18 bug
          'country_id' => Country::inRandomOrder()->value('id'),
        ];
    }
}
