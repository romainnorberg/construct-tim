<?php

require_once('_set_env_vars.php');

# mailer
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', getenv('MAILER_HOST'));
$container->setParameter('mailer_user', getenv('MAILER_USER'));
$container->setParameter('mailer_password', getenv('MAILER_PASSWORD'));
$container->setParameter('mailer_sender', getenv('MAILER_SENDER'));
