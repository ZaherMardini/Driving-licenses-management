<?php

namespace Database\Seeders;

use App\Models\TestType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $types = [
        ['title' => 'Vision test', 'description' => 'Test the ability to see', 'fees' => 10], 
        ['title' => 'Written test', 'description' => 'Test the understanding of the regulations', 'fees' => 20], 
        ['title' => 'Practical test', 'description' => 'Test in the field', 'fees' => 30], 
      ];
      foreach ($types as $type) {
        TestType::updateOrCreate($type);
      }
    }
}
