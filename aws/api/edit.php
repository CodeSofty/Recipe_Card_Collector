<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Required Files for AWS to Connect
require ('vendor/autoload.php');
use Aws\S3\S3Client;  
use Aws\S3\Exception\AwsS3Exception;


$aws_url = filter_input(INPUT_POST, 'aws_url', FILTER_SANITIZE_STRING);
if (!$aws_url){
    $aws_url = filter_input(INPUT_GET, 'aws_url', FILTER_SANITIZE_STRING);
};

$url = $aws_url;
echo $url;
$explode_url = explode('/', $url);
$previous_file_name = end($explode_url);

// S3 key needs to be a string
// Get file upload details 

// Tests if file name is in the image directory
if(isset($_FILES)) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $temp_source = __DIR__ . "/images/".$file_name;

     // Verify the correct extensions are used
    $extensions = array("jpeg", "jpg", "png");
    $explode = explode('.', $file_name);
    $file_ext = strtolower(end($explode));
    $file_new_name = $previous_file_name;
    if(in_array($file_ext,$extensions) === false) {
        $errors[] = "File extension is not allowed";
    }
    // If no Errors exist, move the file to the images directory
    if(empty($errors) == true) {
        move_uploaded_file($file_tmp, __DIR__ . "/images/".$file_new_name);
                // Upload the file to the bucket
                echo __DIR__ . "/images/";
                updateFiletoS3($file_new_name);
                echo "<script type='text/javascript'>alert('$file_new_name');</script>"; 
        echo "Image Edited Successfully";
        header("Location: .?action=show_recipes");


    } else {
        // Print Errors if any exist
        print_r($errors);
        echo "<script type='text/javascript'>alert('This File is Not Set');</script>"; 
    }
};

function updateFiletoS3($file_name){ 

    if(isset($file_name)) {
        uploadFiletoS3($file_name);

// // Shared S3 Configuration
// try {
//     $sharedConfig = [
//         'region' => 'us-east-2',
//         'version' => 'latest',
//         'credentials' => array (
//             'key' => $_ENV['AWS_ACCESS_KEY_ID'],
//             'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
//     ),
//     ];

// // Give the SDK the configuration for connection
// $sdk = new Aws\Sdk($sharedConfig);
// // Create an S3 Client
// $s3Client = $sdk->createS3();


// // Use S3 client to upload image stored in images folder to the S3 Bucket
//     $result = $s3Client->putObject([
//         'Bucket' => "crudappbucket",
//         'Body'   => "this is the body!",
//         'Key' =>  $file_name,
//         'SourceFile' =>  __DIR__ .'/images/'.$file_name,
//     ]);
// // Echo Any Error Messages
// } catch (S3Exception $e) {
//     echo "An Error Occured With Image Upload:" .  $e->getMessage() . "\n";
// };
}
};

// Compare previous file name to current uploaded
// Change the current uploaded to the previous file name
// Upload the newly named file

// if (isset($_FILES) ){ 
//     // Verify the correct extensions are used
//     $extensions = array("jpeg", "jpg", "png");
//     $explode = explode('.', $file_name);
//     $file_ext = strtolower(end($explode));
//     $file_new_name = $previous_file_name;
//     if(in_array($file_ext,$extensions) === false) {
//         $errors[] = "File extension is not allowed";
//     }
//     // If no Errors exist, move the file to the images directory
//     if(empty($errors) == true) {
//         move_uploaded_file($file_tmp, __DIR__ .'/images/'.$file_new_name);
//                 // Upload the file to the bucket
//                 updateS3Object($file_new_name);
//         echo "Image Uploaded Successfully";
//         header("Location: .?action=show_recipes");


//     } else {
//         // Print Errors if any exist
//         print_r($errors);
//     }
// };
?>