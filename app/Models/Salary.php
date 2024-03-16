<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id", 
        "month", 
        "year",
        "date_of_receive",
        "basic_salary",
        "bonus",
        "allowances",
        "deduction",
        "paid",
        "is_received"
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeFilterByMonthYear($query, $month, $year){
    
            $query->where("month", $month)
                ->where("year", $year);
    }
}
