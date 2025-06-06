<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class JobseekerDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'user.type:jobseeker']);
    }

    /**
     * Show the jobseeker dashboard.
     */
    public function index(Request $request): View
    {
        return view('jobseeker.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
