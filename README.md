Construct-tim.be
================

Open source client website based on Symfony 2.8

### Status
[![Build Status](https://travis-ci.org/romainnorberg/construct-tim.svg?branch=master)](https://travis-ci.org/romainnorberg/construct-tim)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b175d406-8e1f-4c4c-9c3c-c86ad271e319/mini.png)](https://insight.sensiolabs.com/projects/b175d406-8e1f-4c4c-9c3c-c86ad271e319)

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
  - php app/console doctrine:database:create --env=test
  - php app/console doctrine:schema:create --env=test
  - php app/console doctrine:fixtures:load -n --env=test

Optional:
  - cp tests/pre-commit-dist .git/hooks/pre-commit
  - chmod a+x .git/hooks/pre-commit

### Performance

- composer dump-autoload --optimize
-
