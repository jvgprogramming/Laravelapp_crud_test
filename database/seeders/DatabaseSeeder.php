<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
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
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed Students from CSV
        $this->seedStudentsFromCSV();

        // Seed Teachers from CSV
        $this->seedTeachersFromCSV();
    }

    /**
     * Seed students from CSV file
     */
    private function seedStudentsFromCSV(): void
    {
        $csvPath = public_path('students_sample.csv');
        
        if (!file_exists($csvPath)) {
            $this->command->warn("Students CSV file not found at: {$csvPath}");
            return;
        }

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file); // Skip header row

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 7) {
                Student::create([
                    'student_id' => $row[0],
                    'name' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[3],
                    'course' => $row[4],
                    'address' => $row[5],
                    'date_of_birth' => $row[6],
                ]);
            }
        }

        fclose($file);
        $this->command->info('Students seeded successfully from CSV.');
    }

    /**
     * Seed teachers from CSV file
     */
    private function seedTeachersFromCSV(): void
    {
        $csvPath = public_path('teachers_sample.csv');
        
        if (!file_exists($csvPath)) {
            $this->command->warn("Teachers CSV file not found at: {$csvPath}");
            return;
        }

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file); // Skip header row

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 8) {
                Teacher::create([
                    'teacher_id' => $row[0],
                    'name' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[3],
                    'subject' => $row[4],
                    'qualification' => $row[5],
                    'address' => $row[6],
                    'hire_date' => $row[7],
                ]);
            }
        }

        fclose($file);
        $this->command->info('Teachers seeded successfully from CSV.');
    }
}
