<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobseekerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isJobseeker();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Basic user information
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            // Profile information
            'birth_date' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            'prefecture' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'nearest_station' => ['nullable', 'string', 'max:100'],
            'biography' => ['nullable', 'string', 'max:1000'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:50'],
            'education_level' => ['nullable', 'in:none,high_school,vocational,associate,bachelor,master,doctorate'],
            'desired_salary_min' => ['nullable', 'integer', 'min:0'],
            'desired_salary_max' => ['nullable', 'integer', 'min:0'],
            'desired_employment_type' => ['nullable', 'in:full_time,part_time,contract,freelance'],
            'available_start_date' => ['nullable', 'date', 'after_or_equal:today'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['string', 'max:100'],
            'certifications' => ['nullable', 'array'],
            'certifications.*' => ['string', 'max:100'],
            'languages' => ['nullable', 'array'],
            'languages.*' => ['string', 'max:100'],
            'work_location_preference' => ['nullable', 'in:office,remote,hybrid,no_preference'],
        ];
    }
}
