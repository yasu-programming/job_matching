<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ $user->full_name }}!</h3>
                    <p class="text-gray-600 mb-4">User Type: <span class="font-semibold text-green-600">{{ ucfirst($user->user_type) }}</span></p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Job Postings</h4>
                            <p class="text-blue-600 text-sm mt-2">Create and manage job listings</p>
                        </div>
                        
                        <a href="{{ route('profile.show') }}" class="bg-green-50 p-4 rounded-lg hover:bg-green-100 transition-colors duration-200 block">
                            <h4 class="font-semibold text-green-800">Company Profile</h4>
                            <p class="text-green-600 text-sm mt-2">Update your company information</p>
                            @if(Auth::user()->profile_completion < 100)
                                <div class="mt-2">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ Auth::user()->profile_completion }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-600 ml-2">{{ Auth::user()->profile_completion }}%</span>
                                    </div>
                                </div>
                            @endif
                        </a>
                        
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-800">Candidates</h4>
                            <p class="text-purple-600 text-sm mt-2">Review job applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>