@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
<div class="card">
    <h2>Teacher Details</h2>
    
    <div class="form-group">
        <label>ID</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->id }}</div>
    </div>

    <div class="form-group">
        <label>Teacher ID</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->teacher_id }}</div>
    </div>

    <div class="form-group">
        <label>Full Name</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->name }}</div>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->email }}</div>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->phone ?? 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Subject/Department</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->subject }}</div>
    </div>

    <div class="form-group">
        <label>Qualification/Degree</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->qualification ?? 'N/A' }}</div>
    </div>

    @if($teacher->qualification_image)
    <div class="form-group">
        <label>Qualification Certificate/Image</label>
        <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 12px; text-align: center;">
            <img src="{{ Storage::url($teacher->qualification_image) }}" alt="Qualification Certificate" 
                 style="max-width: 300px; max-height: 300px; border: 2px solid #ddd; border-radius: 12px; cursor: pointer; transition: transform 0.3s ease;"
                 onclick="openImageModal('{{ Storage::url($teacher->qualification_image) }}')"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'">
            <br><br>
            <button type="button" class="btn btn-info" onclick="openImageModal('{{ Storage::url($teacher->qualification_image) }}')">View Full Size</button>
        </div>
    </div>
    @endif

    <div class="form-group">
        <label>Address</label>
        <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 4px; min-height: 60px;">{{ $teacher->address ?? 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Hire Date</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->hire_date ? $teacher->hire_date->format('F d, Y') : 'N/A' }}</div>
    </div>

    <div class="form-group">
        <label>Created At</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->created_at->format('M d, Y H:i') }}</div>
    </div>

    <div class="form-group">
        <label>Updated At</label>
        <div style="padding: 0.875rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 8px; border: 2px solid #e0e0e0;">{{ $teacher->updated_at->format('M d, Y H:i') }}</div>
    </div>

    <div class="form-group">
        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('teachers.index') }}" class="btn btn-primary" style="margin-left: 0.5rem;">Back to List</a>
        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display: inline; margin-left: 0.5rem;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
        </form>
    </div>
</div>
@endsection

