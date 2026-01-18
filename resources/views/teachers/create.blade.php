@extends('layouts.app')

@section('title', 'Add New Teacher')

@section('content')
<div class="card">
    <h2>Add New Teacher</h2>
    
    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
            <strong>Note:</strong> Teacher ID will be automatically generated (e.g., TCH0001, TCH0002, etc.)
        </div>

        <div class="form-group">
            <label for="image">Profile Photo</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            <small style="display: block; margin-top: 0.25rem; color: #6c757d;">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
            @error('image')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">Subject/Department *</label>
            <select class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                <option value="">-- Select Subject/Department --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject }}" {{ old('subject') == $subject ? 'selected' : '' }}>{{ $subject }}</option>
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
                    <option value="{{ $qualification }}" {{ old('qualification') == $qualification ? 'selected' : '' }}>{{ $qualification }}</option>
                @endforeach
            </select>
            @error('qualification')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="qualification_image">Qualification Certificate/Image</label>
            <input type="file" class="form-control @error('qualification_image') is-invalid @enderror" id="qualification_image" name="qualification_image" accept="image/*">
            <small style="display: block; margin-top: 0.25rem; color: #6c757d;">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
            @error('qualification_image')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
            @error('address')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hire_date">Hire Date</label>
            <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date" name="hire_date" value="{{ old('hire_date') }}">
            @error('hire_date')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Add Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-primary" style="margin-left: 0.5rem;">Cancel</a>
        </div>
    </form>
</div>
@endsection

