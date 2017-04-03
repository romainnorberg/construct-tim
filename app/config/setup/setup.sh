#! /bin/bash

gem install sass
cp app/config/parameters.yml.dist app/config/parameters.yml
composer install
npm install -g bower
bower install
npm install -g grunt-cli
npm install
php bin/console assets:install --symlink && grunt symlink
grunt
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:create --env=test
php bin/console doctrine:fixtures:load -n --env=test
