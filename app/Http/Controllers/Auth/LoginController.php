<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user type
        $user = Auth::user();
        return $this->redirectBasedOnUserType($user);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect user based on their type
     */
    private function redirectBasedOnUserType(User $user): RedirectResponse
    {
        if ($user->isJobseeker()) {
            return redirect()->intended(route('jobseeker.dashboard'));
        } elseif ($user->isCompany()) {
            return redirect()->intended(route('company.dashboard'));
        }
        
        return redirect()->intended(route('dashboard'));
    }
}
