@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="card">
    <h2>Edit Teacher</h2>
    
    <form action="{{ route('teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Teacher ID</label>
            <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 4px; border: 1px solid #ddd; color: #6c757d;">
                {{ $teacher->teacher_id }}
                <small style="display: block; margin-top: 0.25rem; color: #6c757d;">(Teacher ID cannot be changed)</small>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
            @error('name')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
            @error('email')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}">
            @error('phone')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">Subject/Department *</label>
            <select class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                <option value="">-- Select Subject/Department --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject }}" {{ old('subject', $teacher->subject) == $subject ? 'selected' : '' }}>{{ $subject }}</option>
                @endforeach
            </select>
            @error('subject')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="qualification">Qualification/Degree</label>
            <select class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification">
                <option value="">-- Select Qualification/Degree --</option>
                @foreach($qualifications as $qualification)
                    <option value="{{ $qualification }}" {{ old('qualification', $teacher->qualification) == $qualification ? 'selected' : '' }}>{{ $qualification }}</option>
                @endforeach
            </select>
            @error('qualification')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="qualification_image">Qualification Certificate/Image</label>
            @if($teacher->qualification_image)
                <div style="margin-bottom: 0.5rem;">
                    <strong>Current Image:</strong><br>
                    <img src="{{ Storage::url($teacher->qualification_image) }}" alt="Qualification Certificate" 
                         style="max-width: 300px; max-height: 300px; border: 2px solid #ddd; border-radius: 12px; margin-top: 0.5rem; cursor: pointer; transition: transform 0.3s ease;"
                         onclick="openImageModal('{{ Storage::url($teacher->qualification_image) }}')"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'">
                    <br>
                    <button type="button" class="btn btn-info" style="margin-top: 0.5rem; font-size: 0.875rem;" onclick="openImageModal('{{ Storage::url($teacher->qualification_image) }}')">🔍 View Full Size</button>
                </div>
            @endif
            <input type="file" class="form-control @error('qualification_image') is-invalid @enderror" id="qualification_image" name="qualification_image" accept="image/*">
            <small style="display: block; margin-top: 0.25rem; color: #6c757d;">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB). Leave empty to keep current image.</small>
            @error('qualification_image')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $teacher->address) }}</textarea>
            @error('address')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hire_date">Hire Date</label>
            <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date" name="hire_date" value="{{ old('hire_date', $teacher->hire_date ? $teacher->hire_date->format('Y-m-d') : '') }}">
            @error('hire_date')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Update Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-primary" style="margin-left: 0.5rem;">Cancel</a>
        </div>
    </form>
</div>
@endsection

