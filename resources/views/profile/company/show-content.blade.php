@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <!-- Profile Header -->
        <div class="flex items-center space-x-6 mb-8">
            <div class="flex-shrink-0">
                @if($company && $company->logo_url)
                    <img class="h-24 w-24 rounded-lg object-cover" src="{{ Storage::url($company->logo_url) }}" alt="{{ $company->company_name }}">
                @else
                    <div class="h-24 w-24 rounded-lg bg-gray-300 flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10 9 11 1.92-.33 3.73-.96 5.35-1.85C18.44 24.11 20.28 22 22 19.5V7l-10-5zM12 4.18L20 8.09v10.1c-1.44 2.25-3.12 4.04-5 5.31-1.88-1.27-3.56-3.06-5-5.31V8.09L12 4.18z"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $company?->company_name ?? 'Company Name' }}</h1>
                <p class="text-gray-600">{{ ucfirst($user->user_type) }}</p>
                <p class="text-gray-600">Contact: {{ $user->full_name }}</p>
                @if($user->phone)
                    <p class="text-gray-600">{{ $user->phone }}</p>
                @endif
                <p class="text-gray-600">{{ $user->email }}</p>
                
                <!-- Profile Completion -->
                <div class="mt-2">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-2">Profile completion:</span>
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $user->profile_completion }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 ml-2">{{ $user->profile_completion }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Information</h3>
                <dl class="space-y-2">
                    @if($company && $company->company_name_kana)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Company Name (Kana)</dt>
                            <dd class="text-sm text-gray-900">{{ $company->company_name_kana }}</dd>
                        </div>
                    @endif
                    @if($company && $company->industry)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Industry</dt>
                            <dd class="text-sm text-gray-900">{{ $company->industry }}</dd>
                        </div>
                    @endif
                    @if($company && $company->company_size)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Company Size</dt>
                            <dd class="text-sm text-gray-900">{{ $company->company_size }} employees</dd>
                        </div>
                    @endif
                    @if($company && $company->established_year)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Established</dt>
                            <dd class="text-sm text-gray-900">{{ $company->established_year }}</dd>
                        </div>
                    @endif
                    @if($company && $company->capital)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Capital</dt>
                            <dd class="text-sm text-gray-900">{{ $company->capital }}</dd>
                        </div>
                    @endif
                    @if($company && $company->employee_count)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Employee Count</dt>
                            <dd class="text-sm text-gray-900">{{ number_format($company->employee_count) }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                <dl class="space-y-2">
                    @if($company && $company->website_url)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Website</dt>
                            <dd class="text-sm text-blue-600">
                                <a href="{{ $company->website_url }}" target="_blank" class="hover:underline">{{ $company->website_url }}</a>
                            </dd>
                        </div>
                    @endif
                    @if($company && $company->phone)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Phone</dt>
                            <dd class="text-sm text-gray-900">{{ $company->phone }}</dd>
                        </div>
                    @endif
                    @if($company && $company->postal_code)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Postal Code</dt>
                            <dd class="text-sm text-gray-900">{{ $company->postal_code }}</dd>
                        </div>
                    @endif
                    @if($company && ($company->prefecture || $company->city))
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Location</dt>
                            <dd class="text-sm text-gray-900">
                                @if($company->city && $company->prefecture)
                                    {{ $company->city }}, {{ $company->prefecture }}
                                @elseif($company->city)
                                    {{ $company->city }}
                                @else
                                    {{ $company->prefecture }}
                                @endif
                            </dd>
                        </div>
                    @endif
                    @if($company && $company->address)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Address</dt>
                            <dd class="text-sm text-gray-900">{{ $company->address }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Company Description -->
        @if($company && $company->description)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Description</h3>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $company->description }}</p>
                </div>
            </div>
        @endif

        @if(!$company || !$company->company_name)
            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mt-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            Complete your company profile
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Please complete your company profile to attract the best candidates.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>