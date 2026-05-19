#!/bin/bash
# =============================================================
# build.sh — Hostinger deployment package for KozerTravel
# Usage: bash build.sh
# Output: kozertravel-deploy.zip (ready to upload to Hostinger)
# =============================================================

set -e

PROJECT="kozertravel"
OUTPUT="${PROJECT}-deploy.zip"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

echo "========================================"
echo "  KozerTravel — Hostinger Build Script"
echo "========================================"

# ── 1. Run Vite production build ──────────────────────────────
echo ""
echo "[1/4] Building frontend assets (Vite)..."
if [ -f "package.json" ]; then
    npm ci --silent
    npm run build
    echo "      ✓ Assets built → public/build/"
else
    echo "      ⚠ No package.json found, skipping Vite build"
fi

# ── 2. Remove dev artifacts ───────────────────────────────────
echo ""
echo "[2/4] Cleaning up dev artifacts..."
rm -rf bootstrap/cache/*.php 2>/dev/null || true
echo "      ✓ Bootstrap cache cleared"

# ── 3. Create zip excluding heavy/sensitive directories ───────
echo ""
echo "[3/4] Creating deployment zip..."

zip -r "${OUTPUT}" . \
    --exclude "*.git*" \
    --exclude "*/.git/*" \
    --exclude "vendor/*" \
    --exclude "node_modules/*" \
    --exclude "*.zip" \
    --exclude "build.sh" \
    --exclude ".env" \
    --exclude ".env.production" \
    --exclude "storage/logs/*.log" \
    --exclude "storage/framework/cache/*" \
    --exclude "storage/framework/sessions/*" \
    --exclude "storage/framework/views/*" \
    --exclude "tests/*" \
    --exclude "*.md" \
    --exclude "phpunit.xml" \
    --exclude ".phpunit.cache/*" \
    --exclude "Procfile" \
    --exclude "railway.json" \
    --exclude "nixpacks.toml"

echo "      ✓ Created: ${OUTPUT}"

# ── 4. Summary ────────────────────────────────────────────────
SIZE=$(du -sh "${OUTPUT}" 2>/dev/null | cut -f1)
echo ""
echo "========================================"
echo "  Build complete!"
echo "  File : ${OUTPUT}"
echo "  Size : ${SIZE}"
echo "  Time : $(date '+%Y-%m-%d %H:%M:%S')"
echo "========================================"
echo ""
echo "Next steps:"
echo "  1. Upload ${OUTPUT} to Hostinger File Manager → /public_html/"
echo "  2. Extract the zip there"
echo "  3. SSH in and run: composer install --no-dev --optimize-autoloader"
echo "  4. Copy .env.production to .env and fill in APP_KEY, DB path, mail"
echo "  5. php artisan key:generate"
echo "  6. php artisan migrate --force"
echo "  7. php artisan storage:link"
echo "  8. php artisan config:cache && php artisan route:cache"
echo ""
