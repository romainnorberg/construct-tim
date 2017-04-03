Construct-tim.be
================

Open source client website based on Symfony 3.x

### Status
[![Build Status](https://travis-ci.org/romainnorberg/construct-tim.svg?branch=master)](https://travis-ci.org/romainnorberg/construct-tim)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b175d406-8e1f-4c4c-9c3c-c86ad271e319/mini.png)](https://insight.sensiolabs.com/projects/b175d406-8e1f-4c4c-9c3c-c86ad271e319)

### Env vars

Environment production vars are stored on instance configuration, read more: https://www.clever-cloud.com/doc/admin-console/environment-variables/

### First installation

Run:
  - cp app/config/parameters.yml.dist app/config/parameters.yml
  - composer install
  - npm install -g bower
  - bower install
  - npm install -g grunt-cli
  - npm install
  - php bin/console assets:install --symlink && grunt symlink
  - grunt && grunt watch
  - php bin/console doctrine:database:create --env=test
  - php bin/console doctrine:schema:create --env=test
  - php bin/console doctrine:fixtures:load -n --env=test

Optional:
  - cp tests/pre-commit-dist .git/hooks/pre-commit
  - chmod a+x .git/hooks/pre-commit

### Performance

- composer dump-autoload --optimize
-
