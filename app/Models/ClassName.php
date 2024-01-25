<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    use HasFactory;

    public function classTeacher()
    {
        return $this->belongsTo(Employee::class);
    }


    // class_subject_teacher
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'classes_subjects');
    }

    public function teachers()
    {
        return $this->belongsToMany(Employee::class, 'classes_subjects');
    }

    // class_subject_homework

    public function homeworks()
    {
        return $this->belongsToMany(Homework::class, 'class_homework_subject');
    }
}
