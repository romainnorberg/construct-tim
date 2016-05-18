<?php

$include_env_vars_file = dirname(__FILE__).'/../_set_env_vars.php';
if(file_exists($include_env_vars_file)){
  include($include_env_vars_file);
}

$s3_bucket = 'construct-tim-2016';

$s3_policy = base64_encode(json_encode(array(
  'expiration' => date('Y-m-d\TH:i:s.000\Z', strtotime('+1 day')),
  'conditions' => array(
    array('bucket' => $s3_bucket),
    array('signatureVersion' => 'v4'),
    array('acl' => 'public-read'),
    array('starts-with', '$key', ''),
    array('starts-with', '$Content-Type', ''), // accept all files
    // Plupload internally adds name field, so we need to mention it here
    array('starts-with', '$name', ''),
    // One more field to take into account: Filename - gets silently sent by FileReference.upload() in Flash
    // http://docs.amazonwebservices.com/AmazonS3/latest/dev/HTTPPOSTFlash.html
    array('starts-with', '$Filename', ''),
  )
)));
// sign policy
$s3_signature = base64_encode(hash_hmac('sha1', $s3_policy, getenv('S3_CREDENTIALS_SECRET'), true));

$container->setParameter('s3_region', 'eu-central-1');
$container->setParameter('s3_version', 'latest');
$container->setParameter('s3_bucket', $s3_bucket);
$container->setParameter('s3_policy', $s3_policy);
$container->setParameter('s3_signature', $s3_signature);
