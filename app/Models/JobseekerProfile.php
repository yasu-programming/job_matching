<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'prefecture',
        'city',
        'address',
        'nearest_station',
        'biography',
        'experience_years',
        'education_level',
        'desired_salary_min',
        'desired_salary_max',
        'desired_employment_type',
        'available_start_date',
        'skills',
        'certifications',
        'languages',
        'work_location_preference',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'available_start_date' => 'date',
        'skills' => 'array',
        'certifications' => 'array',
        'languages' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
