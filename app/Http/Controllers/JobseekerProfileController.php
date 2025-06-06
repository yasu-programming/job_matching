<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobseekerProfile;
use App\Http\Requests\UpdateJobseekerProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class JobseekerProfileController extends Controller
{
    /**
     * Update the jobseeker's profile information.
     */
    public function update(UpdateJobseekerProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        
        $validated = $request->validated();
        
        // Split validation data
        $userFields = ['first_name', 'last_name', 'phone', 'profile_image'];
        $userValidated = array_intersect_key($validated, array_flip($userFields));
        $profileValidated = array_diff_key($validated, array_flip($userFields));

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $userValidated['profile_image'] = $imagePath;
            
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
        }

        // Update user information
        $user->update(array_filter($userValidated));

        // Create or update jobseeker profile
        $profile = $user->jobseekerProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileValidated
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Upload profile image via AJAX
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $user->update(['profile_image' => $imagePath]);
            
            return response()->json([
                'success' => true,
                'image_url' => Storage::url($imagePath)
            ]);
        }

        return response()->json(['success' => false], 400);
    }
}