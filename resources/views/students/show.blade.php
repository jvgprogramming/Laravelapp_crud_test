@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="card">
    <h2>Student Details</h2>
    
    @if($student->image)
        <div class="form-group">
            <label>Profile Photo</label>
            <div style="margin: 0.5rem 0;">
                <img src="{{ Storage::url($student->image) }}" alt="{{ $student->name }}" 
                     style="max-width: 300px; max-height: 300px; border: 2px solid #ddd; border-radius: 12px; object-fit: cover; cursor: pointer;"
                     onclick="openImageModal('{{ Storage::url($student->image) }}')" title="Click to view full size">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label>ID</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->id }}</div>
    </div>

    <div class="form-group">
        <label>Student ID</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->student_id }}</div>
    </div>

    <div class="form-group">
        <label>Full Name</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->name }}</div>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->email }}</div>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->phone ?? 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Course/Major</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->course }}</div>
    </div>

    <div class="form-group">
        <label>Address</label>
        <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 4px; min-height: 60px;">{{ $student->address ?? 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Date of Birth</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->date_of_birth ? $student->date_of_birth->format('F d, Y') : 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Created At</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->created_at->format('M d, Y H:i') }}</div>
    </div>

    <div class="form-group">
        <label>Updated At</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $student->updated_at->format('M d, Y H:i') }}</div>
    </div>

    <div class="form-group">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('students.index') }}" class="btn btn-primary" style="margin-left: 0.5rem;">Back to List</a>
        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline; margin-left: 0.5rem;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
        </form>
    </div>
</div>
@endsection

