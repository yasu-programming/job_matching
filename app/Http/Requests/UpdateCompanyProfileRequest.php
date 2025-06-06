<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isCompany();
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

            // Company information
            'company_name' => ['required', 'string', 'max:255'],
            'company_name_kana' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:100'],
            'company_size' => ['nullable', 'in:1-10,11-50,51-100,101-500,501-1000,1001+'],
            'established_year' => ['nullable', 'integer', 'min:1800', 'max:' . date('Y')],
            'capital' => ['nullable', 'string', 'max:100'],
            'employee_count' => ['nullable', 'integer', 'min:1'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'prefecture' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
