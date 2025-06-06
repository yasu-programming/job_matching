#!/bin/bash

# Development Environment Test Script
# This script tests if the development environment is properly set up

echo "🧪 Testing Job Matching development environment..."

ERRORS=0

# Test 1: Check if .env file exists
echo -n "✓ Checking .env file... "
if [ -f .env ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - .env file not found"
    ERRORS=$((ERRORS + 1))
fi

# Test 2: Check if node_modules exists
echo -n "✓ Checking Node.js dependencies... "
if [ -d node_modules ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - node_modules not found. Run 'npm install'"
    ERRORS=$((ERRORS + 1))
fi

# Test 3: Test frontend build
echo -n "✓ Testing frontend build... "
if npm run build > /dev/null 2>&1; then
    echo "✅ PASS"
else
    echo "❌ FAIL - Frontend build failed"
    ERRORS=$((ERRORS + 1))
fi

# Test 4: Check if build files were created
echo -n "✓ Checking build output... "
if [ -f public/build/manifest.json ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - Build manifest not found"
    ERRORS=$((ERRORS + 1))
fi

# Test 5: Check VS Code configuration
echo -n "✓ Checking VS Code configuration... "
if [ -f .vscode/settings.json ] && [ -f .vscode/extensions.json ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - VS Code configuration incomplete"
    ERRORS=$((ERRORS + 1))
fi

# Test 6: Check code formatting configuration
echo -n "✓ Checking code formatting configuration... "
if [ -f pint.json ] && [ -f .prettierrc ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - Code formatting configuration incomplete"
    ERRORS=$((ERRORS + 1))
fi

# Test 7: Check if SQLite database directory exists
echo -n "✓ Checking database directory... "
if [ -d database ]; then
    echo "✅ PASS"
else
    echo "❌ FAIL - Database directory not found"
    ERRORS=$((ERRORS + 1))
fi

echo ""
if [ $ERRORS -eq 0 ]; then
    echo "🎉 All tests passed! Development environment is ready."
    echo ""
    echo "Next steps:"
    echo "1. Install PHP dependencies: composer install"
    echo "2. Generate app key: php artisan key:generate"
    echo "3. Set up database: php artisan migrate"
    echo "4. Start development: composer run dev"
    exit 0
else
    echo "❌ $ERRORS test(s) failed. Please fix the issues above."
    exit 1
fi