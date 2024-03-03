<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{

    protected $fillable = ['employee_id', 'month', 'date_of_receive', 'bonus', 'deduction', 'paid'];

    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
