<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-6">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
            <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">新しいパスワードを設定</h2>
        <p class="mt-2 text-sm text-gray-600">アカウントのセキュリティのため、強力なパスワードを設定してください</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" 
                         class="block mt-1 w-full bg-gray-50" 
                         type="email" 
                         name="email" 
                         :value="old('email', $request->email)" 
                         required 
                         autofocus 
                         autocomplete="username"
                         readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('新しいパスワード')" />
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
        <div class="bg-gray-50 p-4 rounded-md">
            <h3 class="text-sm font-medium text-gray-800 mb-2">パスワードの要件:</h3>
            <ul class="text-xs text-gray-600 space-y-1 list-disc list-inside">
                <li>8文字以上の長さ</li>
                <li>英文字（大文字・小文字）を含む</li>
                <li>数字を含む</li>
                <li>特殊文字（@, #, $, %, ^, &, * など）の使用を推奨</li>
                <li>推測されやすい単語は避ける</li>
            </ul>
        </div>

        <!-- Reset Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
                {{ __('パスワードをリセット') }}
            </x-primary-button>

            <!-- Back to Login -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    パスワードを思い出しましたか？
                    <a class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150" 
                       href="{{ route('login') }}">
                        ログイン画面に戻る
                    </a>
                </p>
            </div>
        </div>
    </form>

    <!-- Security Note -->
    <div class="mt-6 p-4 bg-blue-50 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">セキュリティのお知らせ</h3>
                <div class="mt-2 text-xs text-blue-700">
                    <p>パスワードリセット後は、自動的にログインされます。<br>
                    新しいパスワードは安全な場所に保管し、他の人と共有しないでください。</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>