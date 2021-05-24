#!/bin/bash
set -xe
: "${DB_ENV_HOST?Need database configuration, environment variables}"

set -xe
: "${DB_ENV_PORT?Need database configuration, environment variables}"
set -xe
: "${DB_ENV_DATABASE?Need database configuration, environment variables}"

set -xe
: "${DB_ENV_USERNAME?Need database configuration, environment variables}"
set -xe
: "${DB_ENV_PASSWORD?Need database configuration, environment variables}"

sed -i "s/DB_ENV_HOST/$DB_ENV_HOST/g" /usr/share/nginx/blog/.env

sed -i "s/DB_ENV_PORT/$DB_ENV_PORT/g" /usr/share/nginx/blog/.env

sed -i "s/DB_ENV_DATABASE/$DB_ENV_DATABASE/g" /usr/share/nginx/blog/.env

sed -i "s/DB_ENV_USERNAME/$DB_ENV_USERNAME/g" /usr/share/nginx/blog/.env



sed -i "s/DB_ENV_PASSWORD/$DB_ENV_PASSWORD/g" /usr/share/nginx/blog/.env

exec "$@"
