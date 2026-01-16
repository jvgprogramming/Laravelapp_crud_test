<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = [
            'Computer Science', 'Information Technology', 'Software Engineering', 'Computer Engineering', 'Data Science', 'Cybersecurity', 'Business Administration', 'Accounting', 'Finance', 'Marketing',
        ];

        return [
            'student_id' => 'STU' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'course' => $this->faker->randomElement($courses),
            'address' => fake()->optional()->address(),
            'date_of_birth' => fake()->optional()->date('Y-m-d', '2005-01-01'),
        ];
    }
}
