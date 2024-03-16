<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmployeeAttend extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'status_p_a', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeFilterByMonthYear($query, $month, $year){
        $query->when($month ?? false, function($query, $month){
            $query->whereMonth("date", $month);
        }); 
        $query->when($year ?? false, function($query, $year){
            $query->whereYear("date", $year);
        }); 
    }
}
