<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'status',
        'phone',
        'avatar_url',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is a jobseeker
     */
    public function isJobseeker(): bool
    {
        return $this->user_type === 'jobseeker';
    }

    /**
     * Check if user is a company
     */
    public function isCompany(): bool
    {
        return $this->user_type === 'company';
    }

    /**
     * Get the user's full name
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Get the user's profile image URL
     */
    public function getProfileImageUrlAttribute(): ?string
    {
        if ($this->profile_image) {
            return Storage::url($this->profile_image);
        }
        return null;
    }

    /**
     * Calculate profile completion percentage
     */
    public function getProfileCompletionAttribute(): int
    {
        if ($this->isJobseeker()) {
            return $this->calculateJobseekerProfileCompletion();
        } elseif ($this->isCompany()) {
            return $this->calculateCompanyProfileCompletion();
        }
        return 0;
    }

    /**
     * Calculate jobseeker profile completion
     */
    private function calculateJobseekerProfileCompletion(): int
    {
        $completed = 0;
        $total = 0;

        // Basic user info
        $fields = ['first_name', 'last_name', 'email', 'phone'];
        foreach ($fields as $field) {
            $total++;
            if (!empty($this->$field)) {
                $completed++;
            }
        }

        // Profile image
        $total++;
        if ($this->profile_image) {
            $completed++;
        }

        // Jobseeker profile fields
        if ($this->jobseekerProfile) {
            $profileFields = [
                'birth_date', 'biography', 'experience_years', 
                'education_level', 'desired_employment_type', 
                'skills', 'work_location_preference'
            ];
            foreach ($profileFields as $field) {
                $total++;
                if (!empty($this->jobseekerProfile->$field)) {
                    $completed++;
                }
            }
        } else {
            $total += 7; // Add fields even if profile doesn't exist
        }

        return $total > 0 ? (int) round(($completed / $total) * 100) : 0;
    }

    /**
     * Calculate company profile completion
     */
    private function calculateCompanyProfileCompletion(): int
    {
        $completed = 0;
        $total = 0;

        // Basic user info
        $fields = ['first_name', 'last_name', 'email', 'phone'];
        foreach ($fields as $field) {
            $total++;
            if (!empty($this->$field)) {
                $completed++;
            }
        }

        // Company profile fields
        if ($this->company) {
            $companyFields = [
                'company_name', 'industry', 'company_size', 
                'description', 'website_url', 'logo_url'
            ];
            foreach ($companyFields as $field) {
                $total++;
                if (!empty($this->company->$field)) {
                    $completed++;
                }
            }
        } else {
            $total += 6; // Add fields even if company doesn't exist
        }

        return $total > 0 ? (int) round(($completed / $total) * 100) : 0;
    }

    /**
     * Get the jobseeker profile
     */
    public function jobseekerProfile()
    {
        return $this->hasOne(JobseekerProfile::class);
    }

    /**
     * Get the company profile
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
