<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'teacher_id',
        'name',
        'email',
        'phone',
        'subject',
        'qualification',
        'qualification_image',
        'address',
        'hire_date',
        'image',
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];
}
