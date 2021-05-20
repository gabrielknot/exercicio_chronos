#!/bin/bash

set -xe
: "${DB_DATABASE?Need an api url}"
set -xe
: "${DB_PASSWORD?Need an api url}"

sed -i "s/DB_PASSWORD/$DB_PASSWORD/g" /app/.env.example

sed -i "s/DB_DATABASE/$DB_DATABASE/g" /app/.env.example

exec "$@"
