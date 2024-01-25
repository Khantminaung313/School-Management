<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function salaryRecord()
    {
        return $this->hasOne(Salary::class);
    }

    //for teacher
    public function ownClasses()
    {
        return $this->hasMany(ClassName::class);
    }

    public function classess()
    {
        return $this->belongsToMany(ClassName::class, 'classes_subjects');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'classes_subjects');
    }

}
