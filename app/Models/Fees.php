<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    public function class()
    {
        return $this->belongsTo(ClassName::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
