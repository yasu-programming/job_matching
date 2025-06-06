<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <!-- Profile Header -->
        <div class="flex items-center space-x-6 mb-8">
            <div class="flex-shrink-0">
                @if($user->profile_image_url)
                    <img class="h-24 w-24 rounded-full object-cover" src="{{ $user->profile_image_url }}" alt="{{ $user->full_name }}">
                @else
                    <div class="h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->full_name }}</h1>
                <p class="text-gray-600">{{ ucfirst($user->user_type) }}</p>
                @if($user->phone)
                    <p class="text-gray-600">{{ $user->phone }}</p>
                @endif
                <p class="text-gray-600">{{ $user->email }}</p>
                
                <!-- Profile Completion -->
                <div class="mt-2">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-2">Profile completion:</span>
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $user->profile_completion }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 ml-2">{{ $user->profile_completion }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <dl class="space-y-2">
                    @if($profile && $profile->birth_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Birth Date</dt>
                            <dd class="text-sm text-gray-900">{{ $profile->birth_date->format('Y-m-d') }}</dd>
                        </div>
                    @endif
                    @if($profile && $profile->gender)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Gender</dt>
                            <dd class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $profile->gender)) }}</dd>
                        </div>
                    @endif
                    @if($profile && $profile->prefecture)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Location</dt>
                            <dd class="text-sm text-gray-900">{{ $profile->city }}, {{ $profile->prefecture }}</dd>
                        </div>
                    @endif
                    @if($profile && $profile->nearest_station)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Nearest Station</dt>
                            <dd class="text-sm text-gray-900">{{ $profile->nearest_station }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Career Information</h3>
                <dl class="space-y-2">
                    @if($profile && $profile->experience_years !== null)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Experience</dt>
                            <dd class="text-sm text-gray-900">{{ $profile->experience_years }} years</dd>
                        </div>
                    @endif
                    @if($profile && $profile->education_level)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Education Level</dt>
                            <dd class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $profile->education_level)) }}</dd>
                        </div>
                    @endif
                    @if($profile && $profile->desired_employment_type)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Desired Employment Type</dt>
                            <dd class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $profile->desired_employment_type)) }}</dd>
                        </div>
                    @endif
                    @if($profile && $profile->work_location_preference)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Work Location Preference</dt>
                            <dd class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $profile->work_location_preference)) }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Biography -->
        @if($profile && $profile->biography)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Biography</h3>
                <p class="text-gray-700 leading-relaxed">{{ $profile->biography }}</p>
            </div>
        @endif

        <!-- Skills -->
        @if($profile && $profile->skills)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Skills</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($profile->skills as $skill)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Certifications -->
        @if($profile && $profile->certifications)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Certifications</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($profile->certifications as $certification)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ $certification }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Languages -->
        @if($profile && $profile->languages)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Languages</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($profile->languages as $language)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            {{ $language }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Salary & Availability -->
        @if($profile && ($profile->desired_salary_min || $profile->desired_salary_max || $profile->available_start_date))
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Salary & Availability</h3>
                <dl class="space-y-2">
                    @if($profile->desired_salary_min || $profile->desired_salary_max)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Desired Salary Range</dt>
                            <dd class="text-sm text-gray-900">
                                @if($profile->desired_salary_min && $profile->desired_salary_max)
                                    ¥{{ number_format($profile->desired_salary_min) }} - ¥{{ number_format($profile->desired_salary_max) }}
                                @elseif($profile->desired_salary_min)
                                    ¥{{ number_format($profile->desired_salary_min) }}+
                                @else
                                    Up to ¥{{ number_format($profile->desired_salary_max) }}
                                @endif
                            </dd>
                        </div>
                    @endif
                    @if($profile->available_start_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-600">Available Start Date</dt>
                            <dd class="text-sm text-gray-900">{{ $profile->available_start_date->format('Y-m-d') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        @endif
    </div>
</div>