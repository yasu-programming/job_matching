# Job Matching Application

転職マッチングアプリケーション - Laravel + Tailwind CSS で構築された求人・転職マッチングプラットフォーム

## 🚀 開発環境のセットアップ

### クイックスタート
```bash
# 自動セットアップスクリプトを実行
./setup-dev.sh

# 開発環境テスト
./test-dev-env.sh

# 開発サーバー起動
composer run dev
```

### 詳細な手順
詳細なセットアップ手順については [開発環境セットアップガイド](docs/development-setup.md) を参照してください。

## 🛠️ 技術スタック

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Vite + Tailwind CSS v4
- **Database**: SQLite (開発) / MySQL (本番)
- **Queue**: Database
- **Cache**: Database

## 📋 主要機能

- ユーザー認証・認可システム
- 求職者プロフィール管理
- 企業プロフィール管理
- 求人投稿・管理
- 応募・マッチング機能
- メッセージング機能
- 通知システム
- レジュメ管理

## 🔧 開発ツール

- **コードフォーマッタ**: Laravel Pint (PHP), Prettier (JS/CSS)
- **IDE設定**: VS Code設定ファイル完備
- **デバッグ**: XDebug対応
- **テスト**: PHPUnit

## 📁 プロジェクト構造

```
├── app/                    # Laravelアプリケーションコード
├── config/                 # 設定ファイル
├── database/              # マイグレーション、シーダー
├── docs/                  # ドキュメント
├── public/                # 公開ファイル
├── resources/             # ビュー、アセット
│   ├── css/
│   ├── js/
│   └── views/
├── routes/                # ルート定義
├── tests/                 # テストファイル
├── .vscode/               # VS Code設定
├── setup-dev.sh           # 開発環境セットアップスクリプト
└── test-dev-env.sh        # 環境テストスクリプト
```

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
