<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_id',
        'fees',
    ];

    public function classTeacher()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


    // class_subject_teacher
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'classes_subjects')->withPivot('employee_id');
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
