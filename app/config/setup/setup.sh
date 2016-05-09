#! /bin/bash

gem install sass
cp app/config/parameters.yml.dist app/config/parameters.yml
composer install
npm install -g bower
bower install
npm install -g grunt-cli
npm install
php app/console assets:install --symlink && grunt symlink
grunt
php app/console doctrine:database:create --env=test
php app/console doctrine:schema:create --env=test
php app/console doctrine:fixtures:load -n --env=test
