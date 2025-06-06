<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\UpdateCompanyProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CompanyProfileController extends Controller
{
    /**
     * Update the company's profile information.
     */
    public function update(UpdateCompanyProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        
        $validated = $request->validated();
        
        // Split validation data
        $userFields = ['first_name', 'last_name', 'phone'];
        $userValidated = array_intersect_key($validated, array_flip($userFields));
        $companyValidated = array_diff_key($validated, array_flip($userFields));

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('company-logos', 'public');
            $companyValidated['logo_url'] = $logoPath;
            
            // Delete old logo if exists
            $company = $user->company;
            if ($company && $company->logo_url) {
                Storage::disk('public')->delete($company->logo_url);
            }
        }

        // Update user information
        $user->update(array_filter($userValidated));

        // Create or update company profile
        $company = $user->company()->updateOrCreate(
            ['user_id' => $user->id],
            $companyValidated
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Upload company logo via AJAX
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'company_logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();
        $company = $user->company;
        
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($company && $company->logo_url) {
                Storage::disk('public')->delete($company->logo_url);
            }
            
            $logoPath = $request->file('company_logo')->store('company-logos', 'public');
            
            if ($company) {
                $company->update(['logo_url' => $logoPath]);
            } else {
                $user->company()->create(['logo_url' => $logoPath]);
            }
            
            return response()->json([
                'success' => true,
                'logo_url' => Storage::url($logoPath)
            ]);
        }

        return response()->json(['success' => false], 400);
    }
}