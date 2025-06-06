# 開発環境セットアップガイド

## 概要
このドキュメントでは、Job Matchingアプリケーションの開発環境のセットアップ手順を説明します。

## 必要な環境
- PHP 8.2以上
- Composer
- Node.js 18以上
- npm
- SQLite（デフォルト）またはMySQL/PostgreSQL

## セットアップ手順

### 1. 自動セットアップ（推奨）
```bash
./setup-dev.sh
```

### 2. 手動セットアップ

#### 2.1 リポジトリのクローン
```bash
git clone <repository-url>
cd job_matching
```

#### 2.2 環境設定ファイルの作成
```bash
cp .env.example .env
```

#### 2.3 依存関係のインストール
```bash
# PHP依存関係
composer install

# Node.js依存関係
npm install
```

#### 2.4 アプリケーションキーの生成
```bash
./vendor/bin/sail artisan key:generate
```

#### 2.5 データベースのセットアップ
```bash
# SQLiteデータベースファイルの作成
touch database/database.sqlite

# マイグレーション実行
./vendor/bin/sail artisan migrate

# シーダー実行（オプション）
./vendor/bin/sail artisan db:seed
```

#### 2.6 フロントエンドアセットのビルド
```bash
npm run build
```

## 開発サーバーの起動

### 方法1: 統合開発サーバー（推奨）
```bash
composer run dev
```
これにより以下が同時に起動されます：
- Laravel開発サーバー (http://localhost:8000)
- Viteフロントエンド開発サーバー
- キューワーカー
- ログ監視

### 方法2: 個別起動
```bash
# バックエンドサーバー
./vendor/bin/sail artisan serve

# フロントエンド開発サーバー（別ターミナル）
npm run dev

# キューワーカー（別ターミナル、必要に応じて）
./vendor/bin/sail artisan queue:work
```

## 設定の詳細

### 環境設定（.env）
開発環境用に最適化された主要設定：

```env
APP_NAME="Job Matching"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# 日本語対応
APP_LOCALE=ja
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=ja_JP

# パフォーマンス最適化
BCRYPT_ROUNDS=10

# ログ設定
LOG_CHANNEL=stack
LOG_LEVEL=debug

# メール設定（開発用）
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@job-matching.local"
```

### データベース設定
デフォルトでSQLiteを使用。MySQL/PostgreSQLを使用する場合は`.env`を編集：

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_matching
DB_USERNAME=root
DB_PASSWORD=
```

## IDE設定

### VS Code
プロジェクト内の`.vscode/`フォルダに以下の設定を配置済み：
- `settings.json`: エディタ設定
- `extensions.json`: 推奨拡張機能
- `launch.json`: デバッグ設定

推奨拡張機能：
- PHP Intelephense
- Laravel Blade
- Tailwind CSS IntelliSense
- Prettier
- PHP Debug

## コード品質

### コードフォーマット
```bash
# PHP（Laravel Pint）
./vendor/bin/pint

# JavaScript/CSS（Prettier）
npx prettier --write .
```

### テスト実行
```bash
# PHPUnit
./vendor/bin/sail artisan test

# または
./vendor/bin/sail test
```

## フロントエンド開発

### Tailwind CSS
Tailwind CSS v4を使用。設定は以下で管理：
- `resources/css/app.css`
- `vite.config.js`

### アセットのビルド
```bash
# 開発用（ウォッチモード）
npm run dev

# 本番用
npm run build
```

## トラブルシューティング

### よくある問題

#### 1. Composer install が失敗する
```bash
composer install --ignore-platform-reqs
```

#### 2. パーミッションエラー
```bash
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

#### 3. Node.js依存関係のエラー
```bash
rm -rf node_modules package-lock.json
npm install
```

#### 4. データベース接続エラー
- `.env`のDB設定を確認
- SQLiteファイルの存在と権限を確認
- `./vendor/bin/sail artisan config:clear`でキャッシュクリア

## 開発フロー

### 1. 新機能開発
1. ブランチ作成: `git checkout -b feature/feature-name`
2. コード作成・修正
3. テスト実行: `./vendor/bin/sail artisan test`
4. フォーマット: `./vendor/bin/pint`
5. コミット・プッシュ

### 2. マイグレーション
```bash
# マイグレーション作成
./vendor/bin/sail artisan make:migration create_table_name

# マイグレーション実行
./vendor/bin/sail artisan migrate

# ロールバック
./vendor/bin/sail artisan migrate:rollback
```

### 3. モデル・コントローラー作成
```bash
# モデル
./vendor/bin/sail artisan make:model ModelName

# コントローラー
./vendor/bin/sail artisan make:controller ControllerName

# リソースコントローラー
./vendor/bin/sail artisan make:controller ControllerName --resource
```

## 本番デプロイメント準備

```bash
# 最適化
composer install --optimize-autoloader --no-dev
./vendor/bin/sail artisan config:cache
./vendor/bin/sail artisan route:cache
./vendor/bin/sail artisan view:cache

# アセット最適化
npm run build
```

## サポート

問題が発生した場合は、以下を確認してください：
1. PHP、Node.js、Composerのバージョン
2. `.env`設定
3. ログファイル（`storage/logs/laravel.log`）
4. ブラウザの開発者ツール

詳細なエラーログを含めてissueを作成してください。