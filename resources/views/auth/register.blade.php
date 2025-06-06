<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">新規登録</h2>
        <p class="mt-2 text-sm text-gray-600">無料でアカウントを作成しましょう</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- User Type Selection -->
        <div>
            <x-input-label for="user_type" :value="__('アカウントタイプ')" />
            <select id="user_type" 
                    name="user_type" 
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                    required>
                <option value="">{{ __('選択してください') }}</option>
                <option value="jobseeker" {{ old('user_type') == 'jobseeker' ? 'selected' : '' }}>
                    🔍 {{ __('求職者 - 仕事を探している方') }}
                </option>
                <option value="company" {{ old('user_type') == 'company' ? 'selected' : '' }}>
                    🏢 {{ __('企業 - 人材を募集している企業') }}
                </option>
            </select>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Name Fields -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('姓')" />
                <x-text-input id="first_name" 
                             class="block mt-1 w-full" 
                             type="text" 
                             name="first_name" 
                             :value="old('first_name')" 
                             required 
                             autofocus 
                             autocomplete="given-name"
                             placeholder="田中" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="last_name" :value="__('名')" />
                <x-text-input id="last_name" 
                             class="block mt-1 w-full" 
                             type="text" 
                             name="last_name" 
                             :value="old('last_name')" 
                             required 
                             autocomplete="family-name"
                             placeholder="太郎" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" 
                         class="block mt-1 w-full" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autocomplete="username"
                         placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('電話番号（任意）')" />
            <x-text-input id="phone" 
                         class="block mt-1 w-full" 
                         type="text" 
                         name="phone" 
                         :value="old('phone')" 
                         autocomplete="tel"
                         placeholder="090-1234-5678" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-500">連絡先として使用されます（任意）</p>
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('パスワード')" />
                <x-text-input id="password" 
                             class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required 
                             autocomplete="new-password"
                             placeholder="8文字以上" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
                <x-text-input id="password_confirmation" 
                             class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" 
                             required 
                             autocomplete="new-password"
                             placeholder="もう一度入力" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Password Requirements -->
        <div class="bg-gray-50 p-3 rounded-md">
            <p class="text-xs text-gray-600 mb-1">パスワードの要件:</p>
            <ul class="text-xs text-gray-500 space-y-1">
                <li>• 8文字以上</li>
                <li>• 英数字を含む</li>
                <li>• セキュリティのため記号の使用を推奨</li>
            </ul>
        </div>

        <!-- Register Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                {{ __('アカウントを作成') }}
            </x-primary-button>

            <!-- Login Link -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    すでにアカウントをお持ちの方は
                    <a class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150" 
                       href="{{ route('login') }}">
                        こちらからログイン
                    </a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>