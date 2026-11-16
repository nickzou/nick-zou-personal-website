#!/usr/bin/env bash
# Copy the pinned front-end assets from node_modules into the theme.
# Run after `pnpm install` or after updating alpinejs / @fontsource-variable/noto-sans.
set -euo pipefail
cd "$(dirname "$0")/.."

theme=nick-zou
fonts=node_modules/@fontsource-variable/noto-sans/files

cp node_modules/alpinejs/dist/cdn.min.js "$theme/assets/js/alpine.min.js"
cp "$fonts/noto-sans-latin-wght-normal.woff2" \
   "$fonts/noto-sans-latin-wght-italic.woff2" \
   "$theme/assets/fonts/"

echo "Vendored alpine.min.js and Noto Sans into $theme/assets/"
