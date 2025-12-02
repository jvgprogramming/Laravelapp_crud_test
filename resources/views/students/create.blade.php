@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="card">
    <h2>Add New Student</h2>
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
            <strong>Note:</strong> Student ID will be automatically generated (e.g., STU0001, STU0002, etc.)
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
            <label for="course">Course/Major *</label>
            <select class="form-control @error('course') is-invalid @enderror" id="course" name="course" required>
                <option value="">-- Select Course/Major --</option>
                @foreach($courses as $course)
                    <option value="{{ $course }}" {{ old('course') == $course ? 'selected' : '' }}>{{ $course }}</option>
                @endforeach
            </select>
            @error('course')
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
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <div style="color: #e74c3c; margin-top: 0.25rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Add Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-primary" style="margin-left: 0.5rem;">Cancel</a>
        </div>
    </form>
</div>
@endsection

