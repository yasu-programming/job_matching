<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(): View
    {
        $user = Auth::user();
        
        if ($user->isJobseeker()) {
            $profile = $user->jobseekerProfile;
            return view('profile.jobseeker.show', compact('user', 'profile'));
        } elseif ($user->isCompany()) {
            $company = $user->company;
            return view('profile.company.show', compact('user', 'company'));
        }
        
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit(): View
    {
        $user = Auth::user();
        
        if ($user->isJobseeker()) {
            $profile = $user->jobseekerProfile;
            return view('profile.jobseeker.edit', compact('user', 'profile'));
        } elseif ($user->isCompany()) {
            $company = $user->company;
            return view('profile.company.edit', compact('user', 'company'));
        }
        
        return view('profile.edit', compact('user'));
    }
}