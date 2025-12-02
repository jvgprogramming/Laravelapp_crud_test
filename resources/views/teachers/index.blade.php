@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Teachers List</h2>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add New Teacher</a>
            <button type="button" class="btn btn-info" onclick="openImportModal('teachers')" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;"> Bulk Import</button>
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

    @if($teachers->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Teacher ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->teacher_id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->subject }}</td>
                        <td>{{ $teacher->phone ?? 'N/A' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-primary">View</a>
                                <button type="button" class="btn btn-warning" data-edit-url="{{ route('teachers.json', $teacher) }}" data-update-url="{{ route('teachers.update', $teacher) }}" data-edit-type="teacher" onclick="openEditModal(this.dataset.editUrl, this.dataset.editType, this.dataset.updateUrl)">Edit</button>
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">Full</a>
                                <button type="button" class="btn btn-danger" onclick="openDeleteModal('deleteForm{{ $teacher->id }}', '{{ $teacher->name }}')">Delete</button>
                                <form id="deleteForm{{ $teacher->id }}" action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $teachers->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #999;">
            <h3 style="color: #667eea; margin-bottom: 0.5rem;">No Teachers Found</h3>
            <p style="margin-bottom: 1.5rem;">Get started by adding your first teacher to the system.</p>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Your First Teacher</a>
        </div>
    @endif
</div>
@endsection

