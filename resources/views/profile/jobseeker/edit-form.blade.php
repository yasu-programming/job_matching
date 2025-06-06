<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <form method="POST" action="{{ route('jobseeker.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Image -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Image</h3>
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        @if($user->profile_image_url)
                            <img id="profile-image-preview" class="h-24 w-24 rounded-full object-cover" src="{{ $user->profile_image_url }}" alt="{{ $user->full_name }}">
                        @else
                            <div id="profile-image-preview" class="h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden">
                        <label for="profile_image" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Change photo
                        </label>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('profile_image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('first_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('last_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $profile?->birth_date?->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('birth_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $profile?->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $profile?->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $profile?->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            <option value="prefer_not_to_say" {{ old('gender', $profile?->gender) == 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                        </select>
                        @error('gender')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prefecture" class="block text-sm font-medium text-gray-700">Prefecture</label>
                        <input type="text" name="prefecture" id="prefecture" value="{{ old('prefecture', $profile?->prefecture) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('prefecture')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $profile?->city) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('city')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nearest_station" class="block text-sm font-medium text-gray-700">Nearest Station</label>
                        <input type="text" name="nearest_station" id="nearest_station" value="{{ old('nearest_station', $profile?->nearest_station) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('nearest_station')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Biography -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Biography</h3>
                <div>
                    <label for="biography" class="block text-sm font-medium text-gray-700">Tell us about yourself</label>
                    <textarea name="biography" id="biography" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Describe your background, interests, and career goals...">{{ old('biography', $profile?->biography) }}</textarea>
                    @error('biography')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Career Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Career Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-gray-700">Years of Experience</label>
                        <input type="number" name="experience_years" id="experience_years" min="0" max="50" value="{{ old('experience_years', $profile?->experience_years) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('experience_years')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="education_level" class="block text-sm font-medium text-gray-700">Education Level</label>
                        <select name="education_level" id="education_level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Education Level</option>
                            <option value="none" {{ old('education_level', $profile?->education_level) == 'none' ? 'selected' : '' }}>None</option>
                            <option value="high_school" {{ old('education_level', $profile?->education_level) == 'high_school' ? 'selected' : '' }}>High School</option>
                            <option value="vocational" {{ old('education_level', $profile?->education_level) == 'vocational' ? 'selected' : '' }}>Vocational</option>
                            <option value="associate" {{ old('education_level', $profile?->education_level) == 'associate' ? 'selected' : '' }}>Associate Degree</option>
                            <option value="bachelor" {{ old('education_level', $profile?->education_level) == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="master" {{ old('education_level', $profile?->education_level) == 'master' ? 'selected' : '' }}>Master's Degree</option>
                            <option value="doctorate" {{ old('education_level', $profile?->education_level) == 'doctorate' ? 'selected' : '' }}>Doctorate</option>
                        </select>
                        @error('education_level')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="desired_employment_type" class="block text-sm font-medium text-gray-700">Desired Employment Type</label>
                        <select name="desired_employment_type" id="desired_employment_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Employment Type</option>
                            <option value="full_time" {{ old('desired_employment_type', $profile?->desired_employment_type) == 'full_time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part_time" {{ old('desired_employment_type', $profile?->desired_employment_type) == 'part_time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('desired_employment_type', $profile?->desired_employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('desired_employment_type', $profile?->desired_employment_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('desired_employment_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="work_location_preference" class="block text-sm font-medium text-gray-700">Work Location Preference</label>
                        <select name="work_location_preference" id="work_location_preference" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Preference</option>
                            <option value="office" {{ old('work_location_preference', $profile?->work_location_preference) == 'office' ? 'selected' : '' }}>Office</option>
                            <option value="remote" {{ old('work_location_preference', $profile?->work_location_preference) == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('work_location_preference', $profile?->work_location_preference) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="no_preference" {{ old('work_location_preference', $profile?->work_location_preference) == 'no_preference' ? 'selected' : '' }}>No Preference</option>
                        </select>
                        @error('work_location_preference')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="available_start_date" class="block text-sm font-medium text-gray-700">Available Start Date</label>
                        <input type="date" name="available_start_date" id="available_start_date" value="{{ old('available_start_date', $profile?->available_start_date?->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('available_start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Skills</h3>
                <div id="skills-container">
                    @if($profile && $profile->skills)
                        @foreach($profile->skills as $index => $skill)
                            <div class="flex items-center space-x-2 mb-2 skill-input">
                                <input type="text" name="skills[]" value="{{ $skill }}" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a skill">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-skill">Remove</button>
                            </div>
                        @endforeach
                    @endif
                    <div class="flex items-center space-x-2 mb-2 skill-input">
                        <input type="text" name="skills[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a skill">
                        <button type="button" class="text-red-600 hover:text-red-800 remove-skill">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-skill" class="mt-2 text-blue-600 hover:text-blue-800">+ Add Skill</button>
            </div>

            <!-- Certifications -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Certifications</h3>
                <div id="certifications-container">
                    @if($profile && $profile->certifications)
                        @foreach($profile->certifications as $index => $certification)
                            <div class="flex items-center space-x-2 mb-2 certification-input">
                                <input type="text" name="certifications[]" value="{{ $certification }}" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a certification">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-certification">Remove</button>
                            </div>
                        @endforeach
                    @endif
                    <div class="flex items-center space-x-2 mb-2 certification-input">
                        <input type="text" name="certifications[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a certification">
                        <button type="button" class="text-red-600 hover:text-red-800 remove-certification">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-certification" class="mt-2 text-blue-600 hover:text-blue-800">+ Add Certification</button>
            </div>

            <!-- Languages -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Languages</h3>
                <div id="languages-container">
                    @if($profile && $profile->languages)
                        @foreach($profile->languages as $index => $language)
                            <div class="flex items-center space-x-2 mb-2 language-input">
                                <input type="text" name="languages[]" value="{{ $language }}" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a language">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-language">Remove</button>
                            </div>
                        @endforeach
                    @endif
                    <div class="flex items-center space-x-2 mb-2 language-input">
                        <input type="text" name="languages[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a language">
                        <button type="button" class="text-red-600 hover:text-red-800 remove-language">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-language" class="mt-2 text-blue-600 hover:text-blue-800">+ Add Language</button>
            </div>

            <!-- Salary & Availability -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Salary & Availability</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="desired_salary_min" class="block text-sm font-medium text-gray-700">Desired Minimum Salary (¥)</label>
                        <input type="number" name="desired_salary_min" id="desired_salary_min" min="0" value="{{ old('desired_salary_min', $profile?->desired_salary_min) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('desired_salary_min')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="desired_salary_max" class="block text-sm font-medium text-gray-700">Desired Maximum Salary (¥)</label>
                        <input type="number" name="desired_salary_max" id="desired_salary_max" min="0" value="{{ old('desired_salary_max', $profile?->desired_salary_max) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('desired_salary_max')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('profile.show') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview
document.getElementById('profile_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('profile-image-preview');
            preview.innerHTML = `<img class="h-24 w-24 rounded-full object-cover" src="${e.target.result}" alt="Profile preview">`;
        };
        reader.readAsDataURL(file);
    }
});

// Dynamic skill inputs
document.getElementById('add-skill').addEventListener('click', function() {
    const container = document.getElementById('skills-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2 skill-input';
    div.innerHTML = `
        <input type="text" name="skills[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a skill">
        <button type="button" class="text-red-600 hover:text-red-800 remove-skill">Remove</button>
    `;
    container.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-skill')) {
        const skillInputs = document.querySelectorAll('.skill-input');
        if (skillInputs.length > 1) {
            e.target.closest('.skill-input').remove();
        }
    }
});

// Dynamic certification inputs
document.getElementById('add-certification').addEventListener('click', function() {
    const container = document.getElementById('certifications-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2 certification-input';
    div.innerHTML = `
        <input type="text" name="certifications[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a certification">
        <button type="button" class="text-red-600 hover:text-red-800 remove-certification">Remove</button>
    `;
    container.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-certification')) {
        const certificationInputs = document.querySelectorAll('.certification-input');
        if (certificationInputs.length > 1) {
            e.target.closest('.certification-input').remove();
        }
    }
});

// Dynamic language inputs
document.getElementById('add-language').addEventListener('click', function() {
    const container = document.getElementById('languages-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2 language-input';
    div.innerHTML = `
        <input type="text" name="languages[]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter a language">
        <button type="button" class="text-red-600 hover:text-red-800 remove-language">Remove</button>
    `;
    container.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-language')) {
        const languageInputs = document.querySelectorAll('.language-input');
        if (languageInputs.length > 1) {
            e.target.closest('.language-input').remove();
        }
    }
});
</script>