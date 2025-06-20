<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Edit Profile') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($user->isJobseeker())
                @include('profile.jobseeker.show-content', ['user' => $user, 'profile' => $profile])
            @elseif ($user->isCompany())
                @include('profile.company.show-content', ['user' => $user, 'company' => $company])
            @endif
        </div>
    </div>
</x-app-layout>