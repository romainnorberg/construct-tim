Construct-tim.be
================

Open source client website based on Symfony 2.8

### Env vars

Environment production vars are stored in a remote file, read more: https://help.fortrabbit.com/secrets

### First installation

Run:
 - cp app/config/parameters.yml.dist app/config/parameters.yml
 - composer install
 - sudo npm install -g bower
 - sudo npm install -g grunt-cli
 - php app/console assets:install --symlink && grunt symlink
 - grunt && grunt watch

### Performance

- composer dump-autoload --optimize
-
