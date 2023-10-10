<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
    'region'      => 'us-east-1', // Change this to your desired AWS region
    'credentials' => [
        'key'    => '',
        'secret' => '',
    ],
]);

$bucketName1 = 'inputbucketpapsoft';
$bucketName2 = 'outputbucketpapsoft';
$localDirectory = 'view/img_temp';

try {
    $result = $s3->createBucket([
        'Bucket' => $bucketName1,
    ]);

    echo "Bucket " . $bucketName1 . " created successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

try {
    $result = $s3->createBucket([
        'Bucket' => $bucketName2,
    ]);

    echo "Bucket " . $bucketName2 . " created successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

try {
    $files = glob($localDirectory . '/*');

    foreach ($files as $file) {
        if (is_file($file)) {
            // Get the file's name without the entire path
            $filesName = basename($file);

            // Upload the file to S3
            $result = $s3->putObject([
                'Bucket' => $bucketName1,
                'Key' => $filesName,
                'SourceFile' => $file,
            ]);
            
            // Print a success message
            echo "File " . $filesName . " uploaded successfully to input's Bucket with ETag: " . $result['ETag'] . ".\n";
        }
    }
} catch (AwsException $e) {
    // Handle any errors that occur
    echo "Error: " . $e->getMessage() . "\n";
}

try {
    $responses = 'controller/response.json';
    $responseName = basename($responses);

    // Upload the response to S3
    $result = $s3->putObject([
        'Bucket' => $bucketName2,
        'Key' => $responseName,
        'SourceFile' => $responses,
    ]);

    // Print a success message
    echo "Response uploaded successfully to output's Bucket with ETag: " . $result['ETag'] . ".\n";
} catch (AwsException $e) {
    // Handle any errors that occur
    echo "Error: " . $e->getMessage() . "\n";
}

?>