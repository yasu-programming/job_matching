<footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-3">
                <div class="flex items-center">
                    <x-application-logo class="h-8 w-8 fill-current text-white" />
                    <span class="ml-2 text-lg font-bold">{{ config('app.name', 'Job Matching') }}</span>
                </div>
                <p class="text-gray-300 text-sm">
                    あなたにぴったりの仕事を見つけるお手伝いをします
                </p>
            </div>

            <!-- For Job Seekers -->
            <div class="space-y-3">
                <h3 class="text-lg font-semibold">求職者向け</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition duration-150">求人検索</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">プロフィール作成</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">応募履歴</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">キャリア相談</a></li>
                </ul>
            </div>

            <!-- For Companies -->
            <div class="space-y-3">
                <h3 class="text-lg font-semibold">企業向け</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition duration-150">求人投稿</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">候補者検索</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">応募管理</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">企業プロフィール</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-3">
                <h3 class="text-lg font-semibold">サポート</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition duration-150">よくある質問</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">お問い合わせ</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">利用規約</a></li>
                    <li><a href="#" class="hover:text-white transition duration-150">プライバシーポリシー</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col sm:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Job Matching') }}. All rights reserved.
            </p>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>