<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\JobseekerDashboardController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobseekerProfileController;
use App\Http\Controllers\CompanyProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Get authenticated user
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication API Routes (for React frontend)
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('login', [LoginController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'destroy']);
    
    // Email verification
    Route::post('email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')->name('verification.send');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
});

// Dashboard API Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();
        return response()->json([
            'user' => $user,
            'dashboard_data' => [
                'user_type' => $user->user_type,
                'stats' => [
                    // Add dashboard stats here
                ]
            ]
        ]);
    });
});

// Jobseeker API Routes
Route::middleware(['auth', 'verified', 'user.type:jobseeker'])->prefix('jobseeker')->group(function () {
    Route::get('/dashboard', [JobseekerDashboardController::class, 'index']);
    Route::put('/profile', [JobseekerProfileController::class, 'update']);
    Route::post('/profile/upload-image', [JobseekerProfileController::class, 'uploadImage']);
});

// Company API Routes
Route::middleware(['auth', 'verified', 'user.type:company'])->prefix('company')->group(function () {
    Route::get('/dashboard', [CompanyDashboardController::class, 'index']);
    Route::put('/profile', [CompanyProfileController::class, 'update']);
    Route::post('/profile/upload-logo', [CompanyProfileController::class, 'uploadLogo']);
});