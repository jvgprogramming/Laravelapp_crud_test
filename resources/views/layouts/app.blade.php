<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'School Management') - {{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        nav {
            display: flex;
            gap: 0.5rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }
        nav a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
        }
        .btn-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            color: white;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #f45c43 0%, #eb3349 100%);
        }
        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .btn-warning:hover {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        }
        /* Pagination styles to match app buttons */
        .pagination {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            padding: 0;
            margin: 1rem 0;
            justify-content: flex-end;
        }
        .pagination li {
            display: inline-block;
        }
        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            text-decoration: none;
            color: #667eea;
            background: #fff;
            border: 1px solid rgba(102,126,234,0.15);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .pagination li a:hover {
            background: linear-gradient(135deg, #eef2ff 0%, #f5f7ff 100%);
            transform: translateY(-2px);
        }
        .pagination li.active span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
        }
        .pagination li.disabled span {
            opacity: 0.5;
            cursor: default;
        }
        .btn-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }
        .form-control {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        select.form-control {
            background-color: white;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 2.5rem;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/csvg%3e");
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 1.25rem;
            padding-left: 0.875rem;
        }
        select.form-control option {
            padding: 0.5rem;
            background-color: white;
            color: #333;
        }
        select.form-control option:hover {
            background-color: #667eea;
            color: white;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .table th,
        .table td {
            padding: 1.2rem;
            text-align: left;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
        }
        .table tbody tr:last-child {
            border-bottom: none;
        }
        .alert {
            padding: 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            animation: slideDown 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 2px solid #c3e6cb;
        }
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 2px solid #f5c6cb;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .actions .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        .text-right {
            text-align: right;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: white;
            border-radius: 16px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease;
            position: relative;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }
        .modal-header h3 {
            color: #667eea;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .close {
            color: #aaa;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            line-height: 1;
        }
        .close:hover {
            color: #667eea;
            transform: rotate(90deg);
        }
        .modal-body {
            margin-bottom: 1.5rem;
        }
        .modal-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        .modal-image {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .image-modal-content {
            max-width: 90vw;
            max-height: 90vh;
            text-align: center;
        }
        .image-modal-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            header .container {
                flex-direction: column;
                gap: 1rem;
            }
            nav {
                flex-wrap: wrap;
                justify-content: center;
            }
            .table {
                font-size: 0.875rem;
            }
            .table th,
            .table td {
                padding: 0.75rem;
            }
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>School Management System</h1>
            <nav>
                <a href="{{ route('students.index') }}">Students</a>
                <a href="{{ route('teachers.index') }}">Teachers</a>
                <a href="{{ route('students.create') }}">Add Student</a>
                <a href="{{ route('teachers.create') }}">Add Teacher</a>
            </nav>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul style="margin-top: 0.5rem; margin-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Delete</h3>
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('deleteModal')">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Image View Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content image-modal-content">
            <div class="modal-header">
                <h3>Qualification Certificate</h3>
                <span class="close" onclick="closeModal('imageModal')">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Qualification Certificate" class="modal-image">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('imageModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Edit Form Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h3 id="editModalTitle">Edit Record</h3>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body" id="editFormContainer">
                    <!-- Form fields will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Import/Upload Modal -->
    <div id="importModal" class="modal">
        <div class="modal-content" style="max-width: 550px;">
            <div class="modal-header">
                <h3>Bulk Import Records</h3>
                <span class="close" onclick="closeModal('importModal')">&times;</span>
            </div>
            <form id="importForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0ff 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; border-left: 4px solid #667eea;">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem; font-size: 0.95rem;">CSV Format Required</h4>
                        <p style="font-size: 0.9rem; color: #555; margin: 0;">
                            <strong>Students:</strong> student_id, name, email, phone, course, address, date_of_birth<br>
                            <strong>Teachers:</strong> teacher_id, name, email, phone, subject, qualification, address, hire_date
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="importFile" style="display: flex; align-items: center; gap: 0.5rem;">
                            <span>Select CSV File</span>
                        </label>
                        <input type="file" class="form-control" id="importFile" name="file" accept=".csv" required>
                        <small style="color: #999; display: block; margin-top: 0.5rem;">Maximum file size: 5MB</small>
                    </div>

                    <div class="form-group">
                        <label for="importType">Select Type to Import</label>
                        <select class="form-control" id="importType" name="import_type" required onchange="updateImportTitle()">
                            <option value="">-- Choose --</option>
                            <option value="students">Students</option>
                            <option value="teachers">Teachers</option>
                        </select>
                    </div>

                    <div style="background: #fff3cd; padding: 1rem; border-radius: 8px; border-left: 4px solid #ffc107;">
                        <p style="margin: 0; font-size: 0.9rem; color: #856404;">
                            <strong>Note:</strong> Duplicate emails will be skipped. Make sure your CSV file contains the correct columns.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal('importModal')">Cancel</button>
                    <button type="submit" class="btn btn-success">Import Records</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Modal -->
    <div id="notificationModal" class="modal">
        <div class="modal-content" style="max-width: 450px;">
            <div class="modal-header">
                <h3 id="notificationTitle">Success</h3>
                <span class="close" onclick="closeModal('notificationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div style="display: flex; align-items: flex-start; gap: 1rem;">
                    <span id="notificationIcon" style="font-size: 2rem;">✓</span>
                    <p id="notificationMessage" style="margin: 0; flex: 1;"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="closeModal('notificationModal')">Okay</button>
            </div>
        </div>
    </div>

    <script>
        // ==================== DELETE MODAL ====================
        function openDeleteModal(formId, itemName) {
            const form = document.getElementById(formId);
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = form.action;
            const modalBody = document.querySelector('#deleteModal .modal-body p');
            modalBody.textContent = `Are you sure you want to delete "${itemName}"? This action cannot be undone.`;
            document.getElementById('deleteModal').classList.add('show');
        }

        // ==================== IMAGE MODAL ====================
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.add('show');
        }

        // ==================== EDIT MODAL ====================
        function openEditModal(editUrl, studentType = 'student', updateUrl = null) {
            // Store the update URL globally for the form submission handler
            window.editUpdateUrl = updateUrl || editUrl.replace('/json', '');
            
            // Fetch student/teacher data via AJAX
            fetch(editUrl)
                .then(response => response.json())
                .then(data => {
                    // Set modal title
                    const title = studentType === 'student' ? `Edit Student - ${data.name}` : `Edit Teacher - ${data.name}`;
                    document.getElementById('editModalTitle').textContent = title;

                    // Helper to format dates to YYYY-MM-DD for <input type="date">
                    const formatDateForInput = (d) => {
                        if (!d) return '';
                        // handle ISO (2025-12-01T00:00:00) or space-separated (2025-12-01 00:00:00)
                        try {
                            return d.split('T')[0].split(' ')[0];
                        } catch (e) {
                            return '';
                        }
                    };

                    // Build form based on type
                    let formContent = '';
                    
                    if (studentType === 'student') {
                        const dobVal = formatDateForInput(data.date_of_birth);
                        // Build course options dropdown
                        let courseOptions = '<option value="">-- Select Course --</option>';
                        if (data.courses) {
                            data.courses.forEach(course => {
                                const selected = course === data.course ? 'selected' : '';
                                courseOptions += `<option value="${course}" ${selected}>${course}</option>`;
                            });
                        }

                        formContent = `
                            <div class="form-group">
                                <label>Student ID</label>
                                <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e0e0e0; color: #6c757d;">
                                    ${data.student_id} <small style="display: block; margin-top: 0.25rem;">(Cannot be changed)</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editName">Full Name *</label>
                                <input type="text" class="form-control" id="editName" name="name" value="${data.name}" required>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email *</label>
                                <input type="email" class="form-control" id="editEmail" name="email" value="${data.email}" required>
                            </div>
                            <div class="form-group">
                                <label for="editPhone">Phone</label>
                                <input type="text" class="form-control" id="editPhone" name="phone" value="${data.phone || ''}">
                            </div>
                            <div class="form-group">
                                <label for="editCourse">Course *</label>
                                <select class="form-control" id="editCourse" name="course" required>
                                    ${courseOptions}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editAddress">Address</label>
                                <textarea class="form-control" id="editAddress" name="address" rows="2">${data.address || ''}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editDOB">Date of Birth</label>
                                <input type="date" class="form-control" id="editDOB" name="date_of_birth" value="${dobVal}">
                            </div>
                        `;
                    } else {
                        // Build subject and qualification dropdowns for teachers
                        let subjectOptions = '<option value="">-- Select Subject --</option>';
                        if (data.subjects) {
                            data.subjects.forEach(subject => {
                                const selected = subject === data.subject ? 'selected' : '';
                                subjectOptions += `<option value="${subject}" ${selected}>${subject}</option>`;
                            });
                        }

                        let qualOptions = '<option value="">-- Select Qualification --</option>';
                        if (data.qualifications) {
                            data.qualifications.forEach(qual => {
                                const selected = qual === data.qualification ? 'selected' : '';
                                qualOptions += `<option value="${qual}" ${selected}>${qual}</option>`;
                            });
                        }

                        formContent = `
                            <div class="form-group">
                                <label>Teacher ID</label>
                                <div style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e0e0e0; color: #6c757d;">
                                    ${data.teacher_id} <small style="display: block; margin-top: 0.25rem;">(Cannot be changed)</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editName">Full Name *</label>
                                <input type="text" class="form-control" id="editName" name="name" value="${data.name}" required>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email *</label>
                                <input type="email" class="form-control" id="editEmail" name="email" value="${data.email}" required>
                            </div>
                            <div class="form-group">
                                <label for="editPhone">Phone</label>
                                <input type="text" class="form-control" id="editPhone" name="phone" value="${data.phone || ''}">
                            </div>
                            <div class="form-group">
                                <label for="editSubject">Subject *</label>
                                <select class="form-control" id="editSubject" name="subject" required>
                                    ${subjectOptions}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editQualification">Qualification</label>
                                <select class="form-control" id="editQualification" name="qualification">
                                    ${qualOptions}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editHireDate">Hire Date</label>
                                <input type="date" class="form-control" id="editHireDate" name="hire_date" value="${data.hire_date || ''}">
                            </div>
                            <div class="form-group">
                                <label for="editAddress">Address</label>
                                <textarea class="form-control" id="editAddress" name="address" rows="2">${data.address || ''}</textarea>
                            </div>
                        `;
                    }

                    document.getElementById('editFormContainer').innerHTML = formContent;
                    document.getElementById('editForm').action = editUrl;
                    document.getElementById('editModal').classList.add('show');
                })
                .catch(error => {
                    showNotification('Error loading record. Please try again.', 'error');
                    console.error('Error:', error);
                });
        }

        // Handle edit form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const action = window.editUpdateUrl || this.action;
            
            // Add _method field for Laravel to recognize it as PUT
            formData.append('_method', 'PUT');
            
            fetch(action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok || response.status === 200) {
                    closeModal('editModal');
                    showNotification('Record updated successfully!', 'success');
                    // Reload page after 2 seconds
                    setTimeout(() => location.reload(), 2000);
                } else if (response.status === 422) {
                    return response.json().then(data => {
                        const errors = Object.values(data.errors).flat().join(', ');
                        throw new Error(errors || 'Validation failed');
                    });
                } else {
                    throw new Error('Update failed: ' + response.statusText);
                }
            })
            .catch(error => {
                showNotification('Error: ' + error.message, 'error');
                console.error('Error:', error);
            });
        });

        // ==================== IMPORT MODAL ====================
        function openImportModal(resourceType) {
            document.getElementById('importType').value = resourceType;
            document.getElementById('importForm').action = `/bulk-import`;
            document.getElementById('importModal').classList.add('show');
        }

        function updateImportTitle() {
            const type = document.getElementById('importType').value;
            const baseTitle = type === 'students' ? 'Bulk Import Students' : type === 'teachers' ? 'Bulk Import Teachers' : 'Bulk Import Records';
            // Title already set, this is for any additional logic
        }

        // Handle import form submission
        document.getElementById('importForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const importType = formData.get('import_type');
            
            fetch(`/${importType}/import`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('importModal');
                    document.getElementById('importForm').reset();
                    showNotification(data.message, 'success');
                    // Reload page after 2 seconds
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showNotification(data.message || 'Import failed', 'error');
                }
            })
            .catch(error => {
                showNotification('An error occurred during import. Please try again.', 'error');
                console.error('Error:', error);
            });
        });

        // ==================== NOTIFICATION MODAL ====================
        function showNotification(message, type = 'success') {
            const icons = {
                'success': '✓',
                'error': '✕',
                'warning': '⚠',
                'info': 'ℹ'
            };
            
            const colors = {
                'success': '#11998e',
                'error': '#eb3349',
                'warning': '#f5576c',
                'info': '#4facfe'
            };

            document.getElementById('notificationIcon').textContent = icons[type] || '✓';
            document.getElementById('notificationIcon').style.color = colors[type] || colors['success'];
            document.getElementById('notificationMessage').textContent = message;
            document.getElementById('notificationTitle').textContent = type.charAt(0).toUpperCase() + type.slice(1);
            document.getElementById('notificationModal').classList.add('show');

            // Auto-close after 5 seconds
            setTimeout(() => closeModal('notificationModal'), 5000);
        }

        // ==================== CLOSE MODAL ====================
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.classList.remove('show');
                }
            });
        }

        // Auto-hide success messages after 5 seconds (keep for backward compatibility)
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
