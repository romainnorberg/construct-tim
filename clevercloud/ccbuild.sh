#!/bin/bash

php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force
