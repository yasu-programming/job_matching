#!/bin/bash

# 開発環境テストスクリプト
# 開発環境が適切にセットアップされているかテストします

echo "🧪 Job Matching開発環境をテストしています..."

ERRORS=0

# テスト1: .envファイルの存在確認
echo -n "✓ .envファイルをチェックしています... "
if [ -f .env ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - .envファイルが見つかりません"
    ERRORS=$((ERRORS + 1))
fi

# テスト2: node_modulesの存在確認
echo -n "✓ Node.js依存関係をチェックしています... "
if [ -d node_modules ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - node_modulesが見つかりません。'npm install'を実行してください"
    ERRORS=$((ERRORS + 1))
fi

# テスト3: フロントエンドビルドテスト
echo -n "✓ フロントエンドビルドをテストしています... "
if npm run build > /dev/null 2>&1; then
    echo "✅ PASS"
else
    echo "❌ FAIL - フロントエンドビルドが失敗しました"
    ERRORS=$((ERRORS + 1))
fi

# テスト4: ビルドファイルの作成確認
echo -n "✓ ビルド出力をチェックしています... "
if [ -f public/build/manifest.json ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - ビルドマニフェストが見つかりません"
    ERRORS=$((ERRORS + 1))
fi

# テスト5: VS Code設定の確認
echo -n "✓ VS Code設定をチェックしています... "
if [ -f .vscode/settings.json ] && [ -f .vscode/extensions.json ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - VS Code設定が不完全です"
    ERRORS=$((ERRORS + 1))
fi

# テスト6: コードフォーマット設定の確認
echo -n "✓ コードフォーマット設定をチェックしています... "
if [ -f pint.json ] && [ -f .prettierrc ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - コードフォーマット設定が不完全です"
    ERRORS=$((ERRORS + 1))
fi

# テスト7: SQLiteデータベースディレクトリの存在確認
echo -n "✓ データベースディレクトリをチェックしています... "
if [ -d database ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - データベースディレクトリが見つかりません"
    ERRORS=$((ERRORS + 1))
fi

echo ""
if [ $ERRORS -eq 0 ]; then
    echo "🎉 すべてのテストが成功しました！開発環境の準備が整いました。"
    echo ""
    echo "次のステップ:"
    echo "1. PHP依存関係のインストール: composer install"
    echo "2. アプリケーションキーの生成: ./vendor/bin/sail artisan key:generate"
    echo "3. データベースのセットアップ: ./vendor/bin/sail artisan migrate"
    echo "4. 開発開始: composer run dev"
    exit 0
else
    echo "❌ $ERRORS 個のテストが失敗しました。上記の問題を修正してください。"
    exit 1
fi