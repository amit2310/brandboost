<?php 
require 'aws-autoloader.php';
use Aws\S3\S3Client;  
use Aws\Exception\AwsException;

$s3Client = new S3Client([
    'region' => 'us-west-2',
    'version' => '2006-03-01',
    'credentials' => [
        'key' => 'AKIAJ52XK7ZH7VCR7XHQ',
        'secret' => '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'
    ],
    // Set the S3 class to use objects.dreamhost.com/bucket
    // instead of bucket.objects.dreamhost.com
    'use_path_style_endpoint' => true
]);

$objects = $s3Client->listObjectsV2([
        'Bucket' => 'brandboost.io',
        "Prefix" => '35'
]);
echo '<pre>';
print_r($objects);




?>
