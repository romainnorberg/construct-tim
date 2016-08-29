<?php

$include_env_vars_file = dirname(__FILE__).'/../_set_env_vars.php';
if(file_exists($include_env_vars_file)){
  include($include_env_vars_file);
}

$s3_bucket = 'construct-tim-2016';
$s3_region = 'eu-central-1';
$acl = 'private';

$container->setParameter('s3_region', $s3_region);
$container->setParameter('s3_version', 'latest');
$container->setParameter('s3_bucket', $s3_bucket);
