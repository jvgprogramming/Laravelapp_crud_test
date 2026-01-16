<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
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

        // Ensure test user exists (avoid duplicate unique constraint errors)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User']
        );

        // Create 10 students using factory
        Student::factory()->count(10)->create();
    }
}
