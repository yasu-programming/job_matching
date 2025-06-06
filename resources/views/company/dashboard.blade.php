<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <svg class="w-6 h-6 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"></path>
                </svg>
                {{ __('企業ダッシュボード') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                企業アカウント
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $user->full_name }} さん、お疲れ様です！</h3>
                            <p class="text-green-100 mb-4">優秀な人材の採用をサポートします</p>
                            
                            @if(Auth::user()->profile_completion < 100)
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 max-w-md">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium">企業プロフィール完成度</span>
                                        <span class="text-sm font-bold">{{ Auth::user()->profile_completion }}%</span>
                                    </div>
                                    <div class="w-full bg-white/30 rounded-full h-2">
                                        <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: {{ Auth::user()->profile_completion }}%"></div>
                                    </div>
                                    <p class="text-xs text-green-100 mt-2">企業情報を充実させて、より多くの人材にアピールしましょう</p>
                                </div>
                            @endif
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">求人投稿</h4>
                                <p class="text-sm text-gray-600">新しい求人を投稿</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">求人管理</h4>
                                <p class="text-sm text-gray-600">投稿済み求人を管理</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-200">
                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">候補者管理</h4>
                                <p class="text-sm text-gray-600">応募者の確認・管理</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.show') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors duration-200">
                                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">企業情報</h4>
                                <p class="text-sm text-gray-600">会社プロフィール編集</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Recent Activity -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">最近のアクティビティ</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">システムにようこそ！最初の求人を投稿してみましょう</p>
                                        <p class="text-xs text-gray-500 mt-1">開始</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">企業アカウントが正常に作成されました</p>
                                        <p class="text-xs text-gray-500 mt-1">今日</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    すべてのアクティビティを見る →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Start Guide -->
                    <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">🚀 スタートガイド</h3>
                            <p class="text-sm text-gray-600 mb-4">効果的な採用活動を始めるための手順</p>
                            
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">1</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">企業プロフィールを充実させる</p>
                                        <p class="text-xs text-gray-500">会社の魅力を求職者にアピールしましょう</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">2</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500">最初の求人を投稿する</p>
                                        <p class="text-xs text-gray-400">詳細な職務内容と求める人材像を記載しましょう</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">3</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500">候補者を積極的にスカウト</p>
                                        <p class="text-xs text-gray-400">条件に合う人材を見つけて直接アプローチ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats & Quick Info -->
                <div class="space-y-6">
                    <!-- Profile Completion -->
                    @if(Auth::user()->profile_completion < 100)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">企業プロフィール完成度</h3>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-gray-900">{{ Auth::user()->profile_completion }}%</span>
                                        <span class="text-sm text-gray-500">完成まであと{{ 100 - Auth::user()->profile_completion }}%</span>
                                    </div>
                                    
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-3 rounded-full transition-all duration-300" style="width: {{ Auth::user()->profile_completion }}%"></div>
                                    </div>
                                    
                                    <a href="{{ route('profile.show') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-500">
                                        企業情報を充実させる
                                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">採用統計</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">投稿中の求人</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">応募者数</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">面接予定</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">今月の採用</span>
                                    <span class="text-lg font-semibold text-green-600">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help & Tips -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">💡 採用のコツ</h3>
                            <p class="text-sm text-gray-700 mb-4">効果的な採用活動のヒントをご紹介します</p>
                            
                            <ul class="text-xs text-gray-600 space-y-2">
                                <li>• 魅力的な求人タイトルを作成しましょう</li>
                                <li>• 会社の文化や働く環境を詳しく紹介しましょう</li>
                                <li>• 応募者への迅速な対応を心がけましょう</li>
                            </ul>
                            
                            <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500 mt-4">
                                もっと見る
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>