<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fee',
    ];

    public function homeworks()
    {
        return $this->belongsTo(Homework::class, 'class_homework_subject');
    }

    public function classNames()
    {
        return $this->belongsToMany(ClassName::class, 'classes_subjects')->withPivot('employee_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Employee::class, 'classes_subjects');
    }


}
