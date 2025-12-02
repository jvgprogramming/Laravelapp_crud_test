# Quick Reference Guide - Modals

## Visual Overview

### Layout of Modals in Your App

```
┌─────────────────────────────────────────────────┐
│         Your Application Header                  │
│  [Students List] [Teachers List] [Add] [Bulk📥] │
└─────────────────────────────────────────────────┘
                          │
            ┌─────────────┼─────────────┐
            │             │             │
    Click Button    Click Button   Click Button
    "View"          "⚡ Edit"      "📥 Bulk"
            │             │             │
            ▼             ▼             ▼
        ┌──────┐    ┌──────────┐   ┌──────────┐
        │Show  │    │Edit Form │   │  Import  │
        │Modal │    │ Modal    │   │  Modal   │
        └──────┘    └──────────┘   └──────────┘
                          │              │
                     Save Changes    Upload CSV
                          │              │
                          ▼              ▼
            ┌──────────────────────────────────┐
            │  Notification Modal ✓            │
            │  Success! Record Updated         │
            │  [Auto-closes in 5 seconds]      │
            └──────────────────────────────────┘
```

---

## Button Locations

### On Students/Teachers List Page

```
┌────────────────────────────────────────────────────┐
│ Students List              [Add New Student]        │
│                            [📥 Bulk Import]        │
├────────────────────────────────────────────────────┤
│ ID  | Name         | Email        | Course | Actions
├────────────────────────────────────────────────────┤
│ 1   | John Doe     | john@ex.com   | CS     | [View]
│     │              │              │        | [⚡Edit]
│     │              │              │        | [✏️Full]
│     │              │              │        | [Delete]
├────────────────────────────────────────────────────┤
│ 2   | Jane Smith   | jane@ex.com   | IT     | [View]
│     │              │              │        | [⚡Edit]
│     │              │              │        | [✏️Full]
│     │              │              │        | [Delete]
└────────────────────────────────────────────────────┘

Legend:
  [View]      = Opens show/detail page
  [⚡Edit]    = Opens Edit Form Modal (quick edit)
  [✏️Full]    = Opens full edit page
  [Delete]    = Opens Delete Confirmation Modal
```

---

## Modal Details

### 1️⃣ Edit Form Modal

```
┌─────────────────────────────────┐
│  Edit Student - John Doe    [×] │
├─────────────────────────────────┤
│                                 │
│  Student ID: STU0001            │
│  (Cannot be changed)            │
│                                 │
│  Full Name*:    [John Doe____]  │
│  Email*:        [john@ex.com_]  │
│  Phone:         [1234567890__]  │
│  Course*:       [Computer Sci_] │
│  Address:       [123 Main St__]  │
│  Date of Birth: [2000-01-15__]   │
│                                 │
├─────────────────────────────────┤
│  [Cancel]     [Save Changes]    │
└─────────────────────────────────┘
```

### 2️⃣ Import Modal

```
┌─────────────────────────────────┐
│  Bulk Import Records        [×] │
├─────────────────────────────────┤
│                                 │
│  📋 CSV Format Required         │
│  Students: student_id, name,    │
│  email, phone, course...        │
│                                 │
│  Select CSV File:   [Browse__] │
│  Max size: 5MB                  │
│                                 │
│  Select Type to Import:         │
│  [- Choose -▼]                  │
│  - Students                     │
│  - Teachers                     │
│                                 │
│  ⚠️ Note: Duplicates skipped    │
│                                 │
├─────────────────────────────────┤
│  [Cancel]     [Import Records]  │
└─────────────────────────────────┘
```

### 3️⃣ Notification Modal

```
┌──────────────────────────────────┐
│  Success                     [×] │
├──────────────────────────────────┤
│                                  │
│  ✓ Student updated successfully! │
│                                  │
│     (Auto-closes in 5 seconds)   │
│                                  │
├──────────────────────────────────┤
│          [Okay]                  │
└──────────────────────────────────┘
```

---

## JavaScript Functions Reference

### Show Notification
```javascript
showNotification(message, type)
// Types: 'success', 'error', 'warning', 'info'

// Examples:
showNotification('Student saved!', 'success');
showNotification('Email already exists', 'error');
showNotification('Please verify', 'warning');
showNotification('Processing...', 'info');
```

### Open Edit Modal
```javascript
openEditModal(editUrl, type)
// type: 'student' or 'teacher'

// Example:
openEditModal('/students/1/json', 'student');
```

### Open Import Modal
```javascript
openImportModal(resourceType)
// resourceType: 'students' or 'teachers'

// Example:
openImportModal('students');
```

### Close Any Modal
```javascript
closeModal(modalId)
// modalId: 'editModal', 'importModal', 'deleteModal', etc.

// Example:
closeModal('editModal');
```

---

## Color Scheme

### Theme Colors

```
Primary Gradient:  #667eea → #764ba2 (Purple)
Success:          #11998e → #38ef7d (Green)
Error:            #eb3349 → #f45c43 (Red)
Warning:          #f093fb → #f5576c (Pink)
Info:             #4facfe → #00f2fe (Blue)
```

### How Colors Are Used

- **Modals**: All use primary gradient
- **Success Button**: Green gradient
- **Danger Button**: Red gradient
- **Warning Button**: Pink gradient
- **Info/Import Button**: Blue gradient
- **Text**: #667eea for headings, #555 for body

---

## Keyboard Shortcuts

| Key | Action |
|-----|--------|
| `Esc` | Close modal |
| `Enter` | Submit form (in modal) |
| `Tab` | Navigate form fields |

---

## CSV Import Format

### Students CSV Template

```
student_id,name,email,phone,course,address,date_of_birth
STU0001,John Doe,john@example.com,1234567890,Computer Science,123 Main St,2000-01-15
STU0002,Jane Smith,jane@example.com,0987654321,IT,456 Oak Ave,2001-05-20
```

### Teachers CSV Template

```
teacher_id,name,email,phone,subject,qualification,address,hire_date
TCH0001,Dr. Alice,alice@example.com,1234567890,Mathematics,Ph.D.,123 Lane,2015-01-10
TCH0002,Mr. Bob,bob@example.com,0987654321,Physics,M.Sc.,456 Way,2018-06-15
```

---

## Import Success Response

```json
{
  "success": true,
  "message": "Import completed! Imported: 5, Skipped: 0 (0 errors)",
  "imported": 5,
  "skipped": 0,
  "errors": []
}
```

## Import Error Response

```json
{
  "success": false,
  "message": "Import failed: File validation error",
  "errors": [
    "Row 2: Missing required fields",
    "Row 3: Email already exists",
    "Row 4: Invalid date format"
  ]
}
```

---

## File Size Guide

| File Type | Approx Rows | File Size |
|-----------|-------------|-----------|
| Small CSV | 100 rows | 5 KB |
| Medium CSV | 500 rows | 25 KB |
| Large CSV | 1000 rows | 50 KB |
| Max Import | 10,000 rows | 500 KB |

---

## Troubleshooting Checklist

- [ ] Modal doesn't open?
  - Check browser console for errors
  - Verify JavaScript is enabled
  - Refresh page

- [ ] Edit modal shows empty?
  - Check network tab in DevTools
  - Verify `/students/{id}/json` returns data
  - Check server logs

- [ ] Import fails?
  - Check CSV format matches template
  - Verify no duplicate emails
  - Check file size < 5MB
  - Download sample CSV and test

- [ ] Notification doesn't show?
  - Check for JavaScript errors
  - Verify showNotification function is called
  - Check modal div IDs match

---

## Production Checklist

- [ ] Test Edit Modal with multiple records
- [ ] Test Import with large CSV files
- [ ] Verify all success/error messages show
- [ ] Test on mobile devices
- [ ] Test in all browsers (Chrome, Firefox, Safari)
- [ ] Check database for correct data after import
- [ ] Verify no broken links
- [ ] Test CSRF protection
- [ ] Clear browser cache
- [ ] Test with slow network (DevTools throttling)

---

**Version**: 1.0  
**Last Updated**: December 2, 2025  
**Status**: Production Ready ✅
