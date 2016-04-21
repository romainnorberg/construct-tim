Construct-tim.be
================

Open source client website based on Symfony 2.8

### Status
[![Build Status](https://travis-ci.org/romainnorberg/construct-tim.svg?branch=master)](https://travis-ci.org/romainnorberg/construct-tim)

### Env vars

Environment production vars are stored in a remote file, read more: https://help.fortrabbit.com/secrets

### First installation

Run:
  - cp app/config/parameters.yml.dist app/config/parameters.yml
  - composer install
  - npm install -g bower
  - bower install
  - npm install -g grunt-cli
  - npm install
  - php app/console assets:install --symlink && grunt symlink
  - grunt && grunt watch

### Performance

- composer dump-autoload --optimize
-
