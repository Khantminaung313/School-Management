<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{

    protected $fillable = ['name', 'role_id'];

    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'employee_roles_permission');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
