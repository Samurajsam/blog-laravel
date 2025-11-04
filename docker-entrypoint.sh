#!/usr/bin/env bash
set -euo pipefail

# Ensure application key exists if provided via environment
if [ -z "${APP_KEY:-}" ]; then
  echo "[entrypoint] Generating APP_KEY"
  php artisan key:generate --force
fi

# Run migrations if enabled
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  echo "[entrypoint] Running database migrations"
  php artisan migrate --force
fi

exec "$@"
