#!/usr/bin/env bash
# One-command Docker build+up for Laravel app
docker-compose build --no-cache
docker-compose up -d --remove-orphans
echo "Containers started. To view logs: docker-compose logs -f"