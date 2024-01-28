<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['father_name', 'mother_name', 'student_id', 'father_info', 'mother_info'];

    public function students() : HasMany
    {
        return $this->hasMany(Student::class);
    }

}
