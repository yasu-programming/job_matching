@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Company Logo -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Logo</h3>
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        @if($company && $company->logo_url)
                            <img id="logo-preview" class="h-24 w-24 rounded-lg object-cover" src="{{ Storage::url($company->logo_url) }}" alt="{{ $company->company_name }}">
                        @else
                            <div id="logo-preview" class="h-24 w-24 rounded-lg bg-gray-300 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7v10c0 5.55 3.84 10 9 11 1.92-.33 3.73-.96 5.35-1.85C18.44 24.11 20.28 22 22 19.5V7l-10-5zM12 4.18L20 8.09v10.1c-1.44 2.25-3.12 4.04-5 5.31-1.88-1.27-3.56-3.06-5-5.31V8.09L12 4.18z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="company_logo" id="company_logo" accept="image/*" class="hidden">
                        <label for="company_logo" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Change logo
                        </label>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('company_logo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Person Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Person Information</h3>
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
                </div>
            </div>

            <!-- Company Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name *</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $company?->company_name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('company_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_name_kana" class="block text-sm font-medium text-gray-700">Company Name (Kana)</label>
                        <input type="text" name="company_name_kana" id="company_name_kana" value="{{ old('company_name_kana', $company?->company_name_kana) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('company_name_kana')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                        <input type="text" name="industry" id="industry" value="{{ old('industry', $company?->industry) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., Technology, Finance, Healthcare">
                        @error('industry')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_size" class="block text-sm font-medium text-gray-700">Company Size</label>
                        <select name="company_size" id="company_size" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Company Size</option>
                            <option value="1-10" {{ old('company_size', $company?->company_size) == '1-10' ? 'selected' : '' }}>1-10 employees</option>
                            <option value="11-50" {{ old('company_size', $company?->company_size) == '11-50' ? 'selected' : '' }}>11-50 employees</option>
                            <option value="51-100" {{ old('company_size', $company?->company_size) == '51-100' ? 'selected' : '' }}>51-100 employees</option>
                            <option value="101-500" {{ old('company_size', $company?->company_size) == '101-500' ? 'selected' : '' }}>101-500 employees</option>
                            <option value="501-1000" {{ old('company_size', $company?->company_size) == '501-1000' ? 'selected' : '' }}>501-1000 employees</option>
                            <option value="1001+" {{ old('company_size', $company?->company_size) == '1001+' ? 'selected' : '' }}>1001+ employees</option>
                        </select>
                        @error('company_size')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="established_year" class="block text-sm font-medium text-gray-700">Established Year</label>
                        <input type="number" name="established_year" id="established_year" min="1800" max="{{ date('Y') }}" value="{{ old('established_year', $company?->established_year) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('established_year')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="capital" class="block text-sm font-medium text-gray-700">Capital</label>
                        <input type="text" name="capital" id="capital" value="{{ old('capital', $company?->capital) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., ¥10,000,000">
                        @error('capital')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="employee_count" class="block text-sm font-medium text-gray-700">Employee Count</label>
                        <input type="number" name="employee_count" id="employee_count" min="1" value="{{ old('employee_count', $company?->employee_count) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('employee_count')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="website_url" class="block text-sm font-medium text-gray-700">Website URL</label>
                        <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $company?->website_url) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="https://www.example.com">
                        @error('website_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Company Description -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Description</h3>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Tell us about your company</label>
                    <textarea name="description" id="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Describe your company's mission, values, culture, and what makes it a great place to work...">{{ old('description', $company?->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $company?->postal_code) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('postal_code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prefecture" class="block text-sm font-medium text-gray-700">Prefecture</label>
                        <input type="text" name="prefecture" id="prefecture" value="{{ old('prefecture', $company?->prefecture) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('prefecture')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $company?->city) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('city')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $company?->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('address')
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
// Logo preview
document.getElementById('company_logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logo-preview');
            preview.innerHTML = `<img class="h-24 w-24 rounded-lg object-cover" src="${e.target.result}" alt="Logo preview">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>