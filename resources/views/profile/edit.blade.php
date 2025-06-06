<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ __('Profile updated successfully.') }}
                </div>
            @endif

            @if ($user->isJobseeker())
                @include('profile.jobseeker.edit-form', ['user' => $user, 'profile' => $profile])
            @elseif ($user->isCompany())
                @include('profile.company.edit-form', ['user' => $user, 'company' => $company])
            @endif
        </div>
    </div>
</x-app-layout>