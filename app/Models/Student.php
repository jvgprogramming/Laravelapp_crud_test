<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'phone',
        'course',
        'address',
        'date_of_birth',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
