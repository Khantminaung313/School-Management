<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    public function classes()
    {
        return $this->belongsToMany(ClassName::class, 'class_homework_subject');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'class_homework_subject');
    }
}
