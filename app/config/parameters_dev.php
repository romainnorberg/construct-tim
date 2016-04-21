<?php

$include_env_vars_file = dirname(__FILE__).'/_set_env_vars.php';
if(file_exists($include_env_vars_file)){
  include($include_env_vars_file);
}

# mailer
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', getenv('MAILER_HOST'));
$container->setParameter('mailer_user', getenv('MAILER_USER'));
$container->setParameter('mailer_password', getenv('MAILER_PASSWORD'));
$container->setParameter('mailer_sender', getenv('MAILER_SENDER'));
