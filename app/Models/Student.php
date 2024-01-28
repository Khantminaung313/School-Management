<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'family_id', 'name', 'registration_number', 'class_id', 'picture', 'admission_date', 'phone', 'address', 'date_of_birth', 'gender', 'previous_school'];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
