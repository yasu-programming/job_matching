<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">ログイン</h2>
        <p class="mt-2 text-sm text-gray-600">アカウントにログインしてください</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" 
                         class="block mt-1 w-full" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autofocus 
                         autocomplete="username"
                         placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('パスワード')" />
            <x-text-input id="password" 
                         class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required 
                         autocomplete="current-password"
                         placeholder="パスワードを入力してください" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                       name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('ログイン状態を保持') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-500 font-medium transition duration-150" 
                   href="{{ route('password.request') }}">
                    {{ __('パスワードを忘れた方') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                {{ __('ログイン') }}
            </x-primary-button>

            <!-- Register Link -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    アカウントをお持ちでない方は
                    <a class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150" 
                       href="{{ route('register') }}">
                        こちらから新規登録
                    </a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>