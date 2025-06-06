<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'user.type:company']);
    }

    /**
     * Show the company dashboard.
     */
    public function index(Request $request): View
    {
        return view('company.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
