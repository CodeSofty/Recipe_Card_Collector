<?php 
// Required Files for AWS to Connect
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
require ('vendor/autoload.php');
?>


<?php 

try { 
// Create New S3Client With Parameters
$s3Client = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-2'
]);
} catch(S3Exception $e) {
// If Errors Occur Show Them
    $error = $e->getMessage();
Echo "Error Occured with AWS Connection:" . $error;
}
?>