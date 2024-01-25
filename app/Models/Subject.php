<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function homeworks()
    {
        return $this->belongsTo(Homework::class, 'class_homework_subject');
    }

}
