<?php

# https://help.fortrabbit.com/secrets

$secrets = json_decode(file_get_contents($_SERVER['APP_SECRETS']), true);

# database
$container->setParameter('database_driver', 'pdo_mysql');
$container->setParameter('database_host', $secrets['MYSQL']['HOST']);
$container->setParameter('database_name', $secrets['MYSQL']['DATABASE']);
$container->setParameter('database_user', $secrets['MYSQL']['USER']);
$container->setParameter('database_password', $secrets['MYSQL']['PASSWORD']);

# mailer
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', $secrets['CUSTOM']['MAILER_HOST']);
$container->setParameter('mailer_user', $secrets['CUSTOM']['MAILER_USER']);
$container->setParameter('mailer_password', $secrets['CUSTOM']['MAILER_PASSWORD']);
$container->setParameter('mailer_sender', $secrets['CUSTOM']['MAILER_SENDER']);
