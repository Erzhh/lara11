#!/usr/bin/env bash
set -e

echo "Running supervisor"
exec supervisord -c /etc/supervisor/supervisord.conf
