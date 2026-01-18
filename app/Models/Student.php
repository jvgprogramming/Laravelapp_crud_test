<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'phone',
        'course',
        'address',
        'date_of_birth',
        'image',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
