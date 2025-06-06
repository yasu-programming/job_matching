<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_name_kana',
        'industry',
        'company_size',
        'established_year',
        'capital',
        'employee_count',
        'website_url',
        'description',
        'prefecture',
        'city',
        'address',
        'postal_code',
        'phone',
        'logo_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
