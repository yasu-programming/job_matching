<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-6">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
            <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">メール認証が必要です</h2>
        <p class="mt-2 text-sm text-gray-600">アカウントを有効化するために、メールアドレスの認証をお願いします</p>
    </div>

    <!-- Verification Status -->
    @if (session('status') == 'verification-link-sent')
        <x-alert type="success" dismissible class="mb-6">
            新しい認証リンクを {{ Auth::user()->email }} 宛にお送りしました。
        </x-alert>
    @endif

    <!-- Instructions -->
    <div class="mb-6 p-4 bg-gray-50 rounded-md">
        <h3 class="text-sm font-medium text-gray-800 mb-2">次の手順に従ってください：</h3>
        <ol class="text-sm text-gray-600 space-y-1 list-decimal list-inside">
            <li>{{ Auth::user()->email }} 宛にお送りした認証メールをご確認ください</li>
            <li>メール内の「アカウントを認証する」リンクをクリックしてください</li>
            <li>認証完了後、自動的にダッシュボードに移動します</li>
        </ol>
    </div>

    <!-- Action Buttons -->
    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            
            <x-primary-button class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
                {{ __('認証メールを再送信') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            
            <x-secondary-button type="submit" class="w-full justify-center py-3 text-base">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                </svg>
                {{ __('ログアウト') }}
            </x-secondary-button>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-6 p-4 bg-yellow-50 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">メールが届かない場合</h3>
                <div class="mt-2 text-xs text-yellow-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>迷惑メールフォルダをご確認ください</li>
                        <li>メールアドレスが正しく入力されているかご確認ください</li>
                        <li>数分待ってから再度確認してください</li>
                        <li>問題が続く場合は、上記ボタンから再送信を行ってください</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>