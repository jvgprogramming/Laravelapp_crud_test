<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Get list of available subjects/departments
     */
    private function getSubjects(): array
    {
        return [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'Computer Science',
            'Information Technology',
            'Software Engineering',
            'Data Science',
            'Cybersecurity',
            'Business Administration',
            'Accounting',
            'Finance',
            'Marketing',
            'Management',
            'Economics',
            'Mechanical Engineering',
            'Electrical Engineering',
            'Civil Engineering',
            'Chemical Engineering',
            'Biomedical Engineering',
            'English Literature',
            'History',
            'Geography',
            'Political Science',
            'Psychology',
            'Sociology',
            'Education',
            'Physical Education',
            'Art & Design',
            'Music',
            'Drama',
            'Foreign Languages',
            'Philosophy',
            'Religious Studies',
            'Environmental Science',
            'Health Sciences',
            'Nursing',
            'Public Health',
        ];
    }

    /**
     * Get list of available qualifications/degrees
     */
    private function getQualifications(): array
    {
        return [
            'Bachelor of Education (B.Ed.)',
            'Bachelor of Science (B.Sc.)',
            'Bachelor of Arts (B.A.)',
            'Bachelor of Engineering (B.Eng.)',
            'Bachelor of Technology (B.Tech.)',
            'Master of Education (M.Ed.)',
            'Master of Science (M.Sc.)',
            'Master of Arts (M.A.)',
            'Master of Engineering (M.Eng.)',
            'Master of Business Administration (MBA)',
            'Doctor of Philosophy (Ph.D.)',
            'Doctor of Education (Ed.D.)',
            'Doctor of Business Administration (DBA)',
            'Postgraduate Diploma in Education (PGDE)',
            'Teaching Credential / License',
            'Certified Professional Teacher',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->get('search', '');
            
            $query = Teacher::query();
            
            // Apply search filter if search term is provided
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('teacher_id', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            }
            
            $teachers = $query->latest()->paginate(10)->appends($request->query());
            return view('teachers.index', compact('teachers', 'search'));
        } catch (\Exception $e) {
            return view('teachers.index', ['teachers' => collect([]), 'error' => 'Database connection error. Please check your .env file and ensure MySQL is running.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = $this->getSubjects();
        $qualifications = $this->getQualifications();
        return view('teachers.create', compact('subjects', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'qualification_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Auto-generate teacher_id (format: TCH0001, TCH0002, etc.)
        $lastTeacher = Teacher::orderBy('id', 'desc')->first();
        if ($lastTeacher && preg_match('/TCH(\d+)/', $lastTeacher->teacher_id, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
        } else {
            $nextNumber = 1;
        }
        $teacherId = 'TCH' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $data = $request->all();
        $data['teacher_id'] = $teacherId;

        // Handle qualification image upload
        if ($request->hasFile('qualification_image')) {
            $image = $request->file('qualification_image');
            $imageName = time() . '_' . $teacherId . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('qualifications', $imageName, 'public');
            $data['qualification_image'] = $imagePath;
        }

        // Handle profile image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('teachers', $imageName, 'public');
            $data['image'] = 'teachers/' . $imageName;
        }

        Teacher::create($data);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully with ID: ' . $teacherId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $subjects = $this->getSubjects();
        $qualifications = $this->getQualifications();
        return view('teachers.edit', compact('teacher', 'subjects', 'qualifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'qualification_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Don't allow teacher_id to be changed
        $data = $request->all();
        unset($data['teacher_id']); // Remove teacher_id from update data

        // Handle qualification image upload
        if ($request->hasFile('qualification_image')) {
            // Delete old image if exists
            if ($teacher->qualification_image && Storage::disk('public')->exists($teacher->qualification_image)) {
                Storage::disk('public')->delete($teacher->qualification_image);
            }
            
            $image = $request->file('qualification_image');
            $imageName = time() . '_' . $teacher->teacher_id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('qualifications', $imageName, 'public');
            $data['qualification_image'] = $imagePath;
        }

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teacher->image && Storage::disk('public')->exists($teacher->image)) {
                Storage::disk('public')->delete($teacher->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('teachers', $imageName, 'public');
            $data['image'] = 'teachers/' . $imageName;
        }

        $teacher->update($data);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // Delete qualification image if exists
        if ($teacher->qualification_image && Storage::disk('public')->exists($teacher->qualification_image)) {
            Storage::disk('public')->delete($teacher->qualification_image);
        }

        // Delete profile image if exists
        if ($teacher->image && Storage::disk('public')->exists($teacher->image)) {
            Storage::disk('public')->delete($teacher->image);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    /**
     * Get teacher data in JSON format for modal editing
     */
    public function getJson(Teacher $teacher)
    {
        return response()->json([
            'id' => $teacher->id,
            'teacher_id' => $teacher->teacher_id,
            'name' => $teacher->name,
            'email' => $teacher->email,
            'phone' => $teacher->phone,
            'subject' => $teacher->subject,
            'qualification' => $teacher->qualification,
            'address' => $teacher->address,
            'hire_date' => $teacher->hire_date,
            'subjects' => $this->getSubjects(),
            'qualifications' => $this->getQualifications(),
        ]);
    }

    /**
     * Import teachers from CSV file
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
                    // Map CSV data to teacher fields
                    $data = [
                        'teacher_id' => $row[0] ?? null,
                        'name' => $row[1] ?? null,
                        'email' => $row[2] ?? null,
                        'phone' => $row[3] ?? null,
                        'subject' => $row[4] ?? null,
                        'qualification' => $row[5] ?? null,
                        'address' => $row[6] ?? null,
                        'hire_date' => isset($row[7]) && !empty($row[7]) ? $row[7] : null,
                    ];

                    // Check if required fields are present
                    if (!$data['name'] || !$data['email'] || !$data['subject']) {
                        $skipped++;
                        $errors[] = "Row " . ($index + 2) . ": Missing required fields (name, email, subject)";
                        continue;
                    }

                    // Check if email already exists
                    if (Teacher::where('email', $data['email'])->exists()) {
                        $skipped++;
                        $errors[] = "Row " . ($index + 2) . ": Email '{$data['email']}' already exists";
                        continue;
                    }

                    // Auto-generate teacher_id if not provided
                    if (!$data['teacher_id'] || empty($data['teacher_id'])) {
                        $lastTeacher = Teacher::orderBy('id', 'desc')->first();
                        if ($lastTeacher && preg_match('/TCH(\d+)/', $lastTeacher->teacher_id, $matches)) {
                            $nextNumber = (int) $matches[1] + 1;
                        } else {
                            $nextNumber = 1;
                        }
                        $data['teacher_id'] = 'TCH' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                    }

                    Teacher::create($data);
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
