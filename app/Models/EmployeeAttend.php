<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmployeeAttend extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "date",
        "status",
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // protected function date(): Attribute
    // {
    //     return Attribute::make(
    //         set: Carbon::now()->toDateString(),
    //     );
    // }
    public function setDateAttribute($value)
    {
        // Modify the value (e.g., convert to uppercase)
        $this->attributes['date'] = Carbon::now()->toDateString();
    }
}
