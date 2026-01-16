@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Students List</h2>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
            <button type="button" class="btn btn-info" onclick="openImportModal('students')" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;"> Bulk Import</button>
        </div>
    </div>

    @if(isset($error))
        <div class="alert alert-danger">
            <strong>Error:</strong> {{ $error }}
            <br><br>
            <strong>To fix this:</strong>
            <ol>
                <li>Make sure MySQL is running</li>
                <li>Create a database named <code>laravel_crud</code> (or update DB_DATABASE in .env)</li>
                <li>Update your .env file with correct MySQL credentials</li>
                <li>Run: <code>php artisan migrate</code></li>
            </ol>
        </div>
    @endif

    @if($students->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->phone ?? 'N/A' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-primary">View</a>
                                <button type="button" class="btn btn-warning" data-edit-url="{{ route('students.json', $student) }}" data-update-url="{{ route('students.update', $student) }}" data-edit-type="student" onclick="openEditModal(this.dataset.editUrl, this.dataset.editType, this.dataset.updateUrl)">Edit</button>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">Full</a>
                                <button type="button" class="btn btn-danger" onclick="openDeleteModal('deleteForm{{ $student->id }}', '{{ $student->name }}')">Delete</button>
                                <form id="deleteForm{{ $student->id }}" action="{{ route('students.destroy', $student) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $students->render('pagination.custom') }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #999;">
            <h3 style="color: #667eea; margin-bottom: 0.5rem;">No Students Found</h3>
            <p style="margin-bottom: 1.5rem;">Get started by adding your first student to the system.</p>
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add Your First Student</a>
        </div>
    @endif
</div>
@endsection

