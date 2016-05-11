<?php

# database
$container->setParameter('database_driver', 'pdo_mysql');
$container->setParameter('database_host', getenv('DATABASE_HOST'));
$container->setParameter('database_name', getenv('DATABASE_NAME'));
$container->setParameter('database_user', getenv('DATABASE_USER'));
$container->setParameter('database_password', getenv('DATABASE_PASSWORD'));

# rollbar
$container->setParameter('rollbar_server_access_token', getenv('ROLLBAR_SERVER_ACCESS_TOKEN'));
$container->setParameter('rollbar_client_access_token', getenv('ROLLBAR_CLIENT_ACCESS_TOKEN'));
$container->setParameter('rollbar_environment', getenv('ROLLBAR_ENVIRONMENT'));
