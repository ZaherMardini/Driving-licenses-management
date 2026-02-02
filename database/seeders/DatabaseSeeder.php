<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
          'name' => 'Test User',
          'email' => 'test@example.com',
          'person_id' => '1'
        ]);
        Country::factory()->create([
          'name' => 'Syria',
        ]);
        Country::factory()->create([
          'name' => 'Turkey',
        ]);
        Country::factory()->create([
          'name' => 'UK',
        ]);
        $this->call(PersonSeeder::class);
    }
}
