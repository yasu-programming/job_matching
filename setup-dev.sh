#!/bin/bash

# 開発環境セットアップスクリプト
# Job Matchingアプリケーションの開発環境をセットアップします

echo "🚀 Job Matching開発環境をセットアップしています..."

# .envファイルが存在するかチェック、存在しない場合は.env.exampleからコピー
if [ ! -f .env ]; then
    echo "📋 .env.exampleから.envファイルを作成しています..."
    cp .env.example .env
else
    echo "✅ .envファイルは既に存在します"
fi

# PHP依存関係のインストール
echo "📦 PHP依存関係をインストールしています..."
if command -v composer &> /dev/null; then
    composer install
else
    echo "❌ Composerが見つかりません。最初にComposerをインストールしてください。"
    exit 1
fi

# Node.js依存関係のインストール
echo "📦 Node.js依存関係をインストールしています..."
if command -v npm &> /dev/null; then
    npm install
else
    echo "❌ npmが見つかりません。最初にNode.jsとnpmをインストールしてください。"
    exit 1
fi

# アプリケーションキーの生成
echo "🔑 アプリケーションキーを生成しています..."
./vendor/bin/sail artisan key:generate

# SQLiteデータベースが存在しない場合は作成
echo "🗄️  データベースをセットアップしています..."
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

# マイグレーションの実行
echo "🔄 データベースマイグレーションを実行しています..."
./vendor/bin/sail artisan migrate

# フロントエンドアセットのビルド
echo "🎨 フロントエンドアセットをビルドしています..."
npm run build

echo "✅ 開発環境のセットアップが完了しました！"
echo ""
echo "開発サーバーを起動するには:"
echo "  composer run dev"
echo ""
echo "または各サービスを個別に実行:"
echo "  ./vendor/bin/sail artisan serve       # バックエンドサーバー"
echo "  npm run dev            # フロントエンド開発サーバー"
echo "  ./vendor/bin/sail artisan queue:work # キューワーカー（オプション）"