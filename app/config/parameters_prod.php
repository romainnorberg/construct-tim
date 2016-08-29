<?php

# database
$container->setParameter('database_driver', 'pdo_mysql');
$container->setParameter('database_host', getenv('MYSQL_ADDON_HOST'));
$container->setParameter('database_name', getenv('MYSQL_ADDON_DB'));
$container->setParameter('database_user', getenv('MYSQL_ADDON_USER'));
$container->setParameter('database_password', getenv('MYSQL_ADDON_PASSWORD'));

# mailer
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', getenv('MAILER_HOST'));
$container->setParameter('mailer_user', getenv('MAILER_USER'));
$container->setParameter('mailer_password', getenv('MAILER_PASSWORD'));
$container->setParameter('mailer_sender', getenv('MAILER_SENDER'));

# locale
$container->setParameter('locale', 'fr');

# rollbar
$container->setParameter('rollbar_server_access_token', getenv('ROLLBAR_SERVER_ACCESS_TOKEN'));
$container->setParameter('rollbar_client_access_token', getenv('ROLLBAR_CLIENT_ACCESS_TOKEN'));
$container->setParameter('rollbar_environment', getenv('ROLLBAR_ENVIRONMENT'));

# ewz_recaptcha
$container->setParameter('ewz_recaptcha_public_key', getenv('EWZ_RECAPTCHA_PUBLIC_KEY'));
$container->setParameter('ewz_recaptcha_private_key', getenv('EWZ_RECAPTCHA_PRIVATE_KEY'));

# s3 permissions
$container->setParameter('s3_credentials_key', getenv('S3_CREDENTIALS_KEY'));
$container->setParameter('s3_credentials_secret', getenv('S3_CREDENTIALS_SECRET'));
