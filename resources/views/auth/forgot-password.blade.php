<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">パスワードをお忘れですか？</h2>
        <p class="mt-2 text-sm text-gray-600">ご登録のメールアドレスに、パスワードリセット用のリンクをお送りします</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                         placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-500">アカウント登録時に使用したメールアドレスを入力してください</p>
        </div>

        <!-- Send Reset Link Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
                {{ __('パスワードリセットリンクを送信') }}
            </x-primary-button>

            <!-- Back to Login -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    思い出しましたか？
                    <a class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150" 
                       href="{{ route('login') }}">
                        ログイン画面に戻る
                    </a>
                </p>
            </div>
        </div>
    </form>

    <!-- Help Section -->
    <div class="mt-6 p-4 bg-blue-50 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">ヒント</h3>
                <div class="mt-2 text-xs text-blue-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>メールが届かない場合は、迷惑メールフォルダもご確認ください</li>
                        <li>リンクの有効期限は24時間です</li>
                        <li>問題が解決しない場合は、サポートまでお問い合わせください</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>