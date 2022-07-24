<?php 
// Required Files for AWS to Connect
require ('vendor/autoload.php');
use Aws\S3\S3Client;  
use Aws\S3\Exception\AwsS3Exception;


// $credentials = new Aws\Credentials\Credentials(KEY, SECRET);

$img_id = filter_input(INPUT_POST, 'img_id', FILTER_SANITIZE_STRING);
if(!$img_id){
    $img_id = filter_input(INPUT_GET, 'img_id', FILTER_SANITIZE_STRING);
};
// S3 key needs to be a string
// Get file upload details 
if (isset($_FILES) ){ 
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $temp_source = __DIR__ . "/images/".$file_name;


    // Verify the correct extensions are used
    $extensions = array("jpeg", "jpg", "png");
    $explode = explode('.', $file_name);
    $file_ext = strtolower(end($explode));
    $file_new_name = $img_id;
    if(in_array($file_ext,$extensions) === false) {
        $message = "Only the following img extensions are allowed: jpeg, jpg, png.";
    }
    // If no Errors exist, move the file to the images directory
    if(empty($message) == true) {
        move_uploaded_file($file_tmp, __DIR__ ."aws/api/images/".$file_new_name);
                // Upload the file to the bucket
                uploadFiletoS3($file_new_name);
        echo "Congratulations Image Uploaded Successfully";
        header("Location: .?action=show_recipes");


    }
};

function uploadFiletoS3($file_name){ 

    if(isset($file_name)) {


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


// Use S3 client to upload image stored in images folder to the S3 Bucket
    $result = $s3Client->putObject([
        'Bucket' => "crudappbucket",
        'Body'   => "this is the body!",
        'Key' =>  $file_name,
        'SourceFile' => 'aws/api/images/'.$file_name,
    ]);
// Echo Any Error Messages
} catch (S3Exception $e) {
    echo "An Error With AWS Occured With Image Upload:" .  $e->getMessage() . "\n";
};
}
}
?>
