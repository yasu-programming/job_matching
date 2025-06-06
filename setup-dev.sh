#!/bin/bash

# Development Environment Setup Script
# This script sets up the development environment for the Job Matching application

echo "🚀 Setting up Job Matching development environment..."

# Check if .env exists, if not copy from .env.example
if [ ! -f .env ]; then
    echo "📋 Creating .env file from .env.example..."
    cp .env.example .env
else
    echo "✅ .env file already exists"
fi

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
if command -v composer &> /dev/null; then
    composer install
else
    echo "❌ Composer not found. Please install Composer first."
    exit 1
fi

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
if command -v npm &> /dev/null; then
    npm install
else
    echo "❌ npm not found. Please install Node.js and npm first."
    exit 1
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Create SQLite database if it doesn't exist
echo "🗄️  Setting up database..."
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

# Run migrations
echo "🔄 Running database migrations..."
php artisan migrate

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

echo "✅ Development environment setup complete!"
echo ""
echo "To start the development server:"
echo "  composer run dev"
echo ""
echo "Or run each service separately:"
echo "  php artisan serve       # Backend server"
echo "  npm run dev            # Frontend dev server"
echo "  php artisan queue:work # Queue worker (optional)"