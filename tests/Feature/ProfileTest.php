<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\JobseekerProfile;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_jobseeker_can_view_profile_page(): void
    {
        $user = User::factory()->create([
            'user_type' => 'jobseeker',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($user->full_name);
    }

    public function test_company_can_view_profile_page(): void
    {
        $user = User::factory()->create([
            'user_type' => 'company',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($user->full_name);
    }

    public function test_jobseeker_can_edit_profile(): void
    {
        $user = User::factory()->create([
            'user_type' => 'jobseeker',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/profile/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Profile');
    }

    public function test_jobseeker_can_update_profile(): void
    {
        $user = User::factory()->create([
            'user_type' => 'jobseeker',
            'email_verified_at' => now(),
        ]);

        $profileData = [
            'first_name' => 'Updated',
            'last_name' => 'Name',
            'phone' => '090-1234-5678',
            'biography' => 'Updated biography',
            'experience_years' => 5,
            'skills' => ['PHP', 'Laravel'],
        ];

        $response = $this->actingAs($user)
            ->put('/jobseeker/profile', $profileData);

        $response->assertRedirect('/profile/edit');
        $response->assertSessionHas('status', 'profile-updated');

        $user->refresh();
        $this->assertEquals('Updated', $user->first_name);
        $this->assertEquals('Name', $user->last_name);
        $this->assertEquals('090-1234-5678', $user->phone);

        $this->assertDatabaseHas('jobseeker_profiles', [
            'user_id' => $user->id,
            'biography' => 'Updated biography',
            'experience_years' => 5,
        ]);
    }

    public function test_company_can_update_profile(): void
    {
        $user = User::factory()->create([
            'user_type' => 'company',
            'email_verified_at' => now(),
        ]);

        $profileData = [
            'first_name' => 'Updated',
            'last_name' => 'Contact',
            'company_name' => 'Test Company Inc.',
            'industry' => 'Technology',
            'description' => 'A test company description',
        ];

        $response = $this->actingAs($user)
            ->put('/company/profile', $profileData);

        $response->assertRedirect('/profile/edit');
        $response->assertSessionHas('status', 'profile-updated');

        $user->refresh();
        $this->assertEquals('Updated', $user->first_name);
        $this->assertEquals('Contact', $user->last_name);

        $this->assertDatabaseHas('companies', [
            'user_id' => $user->id,
            'company_name' => 'Test Company Inc.',
            'industry' => 'Technology',
            'description' => 'A test company description',
        ]);
    }

    public function test_profile_completion_calculation(): void
    {
        $user = User::factory()->create([
            'user_type' => 'jobseeker',
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'phone' => '090-1234-5678',
        ]);

        // Initial completion should be low
        $this->assertGreaterThan(0, $user->profile_completion);

        // Create a profile to increase completion
        JobseekerProfile::create([
            'user_id' => $user->id,
            'biography' => 'Test biography',
            'experience_years' => 3,
            'education_level' => 'bachelor',
            'desired_employment_type' => 'full_time',
            'skills' => ['PHP', 'Laravel'],
            'work_location_preference' => 'hybrid',
        ]);

        $user->refresh();
        $this->assertGreaterThan(50, $user->profile_completion);
    }

    public function test_unauthorized_user_cannot_access_profile(): void
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');

        $response = $this->get('/profile/edit');
        $response->assertRedirect('/login');
    }
}
