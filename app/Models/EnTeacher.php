<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnTeacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'teacher_image',
        'teacher_name',
        'teacher_subject',
        'teacher_description',
        'teacher_color',
        'teacher_country',
    ];
}
