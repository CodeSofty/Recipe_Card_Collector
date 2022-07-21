<?php 
// Required Files for AWS to Connect
require ('vendor/autoload.php');
use Aws\S3\S3Client;  
use Aws\S3\Exception\AwsS3Exception;


function deleteFileFromS3($aws_url){ 
    $url = $aws_url;
    $explode_url = explode('/', $url);
    $img_to_be_deleted = end($explode_url);
    echo "<script type='text/javascript'>alert('$img_to_be_deleted');</script>";
// Shared S3 Configuration
try {
    $sharedConfig = [
        'region' => 'us-east-2',
        'version' => 'latest',
        'credentials' => array (
            'key' => $_ENV['AWS_ACCESS_KEY_ID'],
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
    ),
    ];

// Give the SDK the configuration for connection
$sdk = new Aws\Sdk($sharedConfig);
// Create an S3 Client
$s3Client = $sdk->createS3();


// Use S3 Client to delete the image in the S3 Bucket

try {
    $result = $s3Client->deleteObject([
        'Bucket' => 'crudappbucket',
        'Key' => $img_to_be_deleted, //This works, but needs to be dynamically sent
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
};
// Echo Any Error Messages
} catch (S3Exception $e) {
echo "An Error Occured With Image Upload:" .  $e->getMessage() . "\n";
};
}
?>