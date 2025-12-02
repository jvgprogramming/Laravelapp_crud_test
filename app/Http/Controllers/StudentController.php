<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Get list of available courses
     */
    private function getCourses()
    {
        return [
            'Computer Science',
            'Information Technology',
            'Software Engineering',
            'Computer Engineering',
            'Data Science',
            'Cybersecurity',
            'Business Administration',
            'Accounting',
            'Finance',
            'Marketing',
            'Management',
            'Economics',
            'Engineering',
            'Mechanical Engineering',
            'Electrical Engineering',
            'Civil Engineering',
            'Chemical Engineering',
            'Biomedical Engineering',
            'Medicine',
            'Nursing',
            'Pharmacy',
            'Dentistry',
            'Psychology',
            'Education',
            'English Literature',
            'History',
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'Environmental Science',
            'Law',
            'Architecture',
            'Art & Design',
            'Music',
            'Journalism',
            'Communication',
            'Social Work',
            'Public Health',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = Student::latest()->paginate(10);
            return view('students.index', compact('students'));
        } catch (\Exception $e) {
            return view('students.index', ['students' => collect([]), 'error' => 'Database connection error. Please check your .env file and ensure MySQL is running.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = $this->getCourses();
        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'course' => 'required|string|max:255',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        // Auto-generate student_id (format: STU0001, STU0002, etc.)
        $lastStudent = Student::orderBy('id', 'desc')->first();
        if ($lastStudent && preg_match('/STU(\d+)/', $lastStudent->student_id, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
        } else {
            $nextNumber = 1;
        }
        $studentId = 'STU' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $data = $request->all();
        $data['student_id'] = $studentId;

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully with ID: ' . $studentId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = $this->getCourses();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'course' => 'required|string|max:255',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        // Don't allow student_id to be changed
        $data = $request->all();
        unset($data['student_id']); // Remove student_id from update data

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    /**
     * Get student data in JSON format for modal editing
     */
    public function getJson(Student $student)
    {
        return response()->json([
            'id' => $student->id,
            'student_id' => $student->student_id,
            'name' => $student->name,
            'email' => $student->email,
            'phone' => $student->phone,
            'course' => $student->course,
            'address' => $student->address,
            'date_of_birth' => $student->date_of_birth,
            'courses' => $this->getCourses(),
        ]);
    }

    /**
     * Import students from CSV file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:5120',
        ]);

        try {
            $file = $request->file('file');
            $path = $file->getRealPath();
            $csv = array_map('str_getcsv', file($path));
            $header = array_shift($csv); // Get header row

            $imported = 0;
            $skipped = 0;
            $errors = [];

            foreach ($csv as $index => $row) {
                if (empty(array_filter($row))) {
                    continue; // Skip empty rows
                }

                try {
                    // Map CSV data to student fields
                    $data = [
                        'student_id' => $row[0] ?? null,
                        'name' => $row[1] ?? null,
                        'email' => $row[2] ?? null,
                        'phone' => $row[3] ?? null,
                        'course' => $row[4] ?? null,
                        'address' => $row[5] ?? null,
                        'date_of_birth' => isset($row[6]) && !empty($row[6]) ? $row[6] : null,
                    ];

                    // Check if required fields are present
                    if (!$data['name'] || !$data['email'] || !$data['course']) {
                        $skipped++;
                        $errors[] = "Row " . ($index + 2) . ": Missing required fields (name, email, course)";
                        continue;
                    }

                    // Check if email already exists
                    if (Student::where('email', $data['email'])->exists()) {
                        $skipped++;
                        $errors[] = "Row " . ($index + 2) . ": Email '{$data['email']}' already exists";
                        continue;
                    }

                    // Auto-generate student_id if not provided
                    if (!$data['student_id'] || empty($data['student_id'])) {
                        $lastStudent = Student::orderBy('id', 'desc')->first();
                        if ($lastStudent && preg_match('/STU(\d+)/', $lastStudent->student_id, $matches)) {
                            $nextNumber = (int) $matches[1] + 1;
                        } else {
                            $nextNumber = 1;
                        }
                        $data['student_id'] = 'STU' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                    }

                    Student::create($data);
                    $imported++;

                } catch (\Exception $e) {
                    $skipped++;
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            $message = "Import completed! Imported: $imported, Skipped: $skipped";
            if (!empty($errors)) {
                $message .= " (" . count($errors) . " errors)";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'imported' => $imported,
                'skipped' => $skipped,
                'errors' => array_slice($errors, 0, 5), // Return first 5 errors
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Import failed: ' . $e->getMessage(),
            ], 400);
        }
    }
}
