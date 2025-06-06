<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobseeker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ $user->full_name }}!</h3>
                    <p class="text-gray-600 mb-4">User Type: <span class="font-semibold text-blue-600">{{ ucfirst($user->user_type) }}</span></p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Job Search</h4>
                            <p class="text-blue-600 text-sm mt-2">Find your perfect job match</p>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800">Profile</h4>
                            <p class="text-green-600 text-sm mt-2">Update your skills and experience</p>
                        </div>
                        
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-800">Applications</h4>
                            <p class="text-purple-600 text-sm mt-2">Track your job applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>