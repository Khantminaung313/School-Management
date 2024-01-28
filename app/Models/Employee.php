<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'employee_type_id', 'join_date', 'salary', 'father_name', 'gender', 'date_of_birth', 'education'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee_type()
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
