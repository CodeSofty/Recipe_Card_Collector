<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

// Headers

header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, x-Requested-with');

require_once('../../config/database.php');
require('../../model/recipe_db.php');

// Instantiate DB and Connect to DB

$database = new Database();
$db = $database->connect();


// Instantiate Recipe Object

$recipe = new Recipe($db);

// Get posted data

$data = json_decode(file_get_contents('php://input'));

// Set ID to update


$recipe->title = $data->title;
$recipe->description = $data->description;
$recipe->prep = $data->prep;
$recipe->servings = $data->servings;
$recipe->cook_time = $data->cook_time;
$recipe->ingredients = $data->ingredients;
$recipe->directions = $data->directions;
$recipe->aws_url = $data->aws_url;
$recipe->id = $data->id;

// Update Recipe

if($recipe->update()) {
    echo json_encode(
        array('message' => 'Recipe Updated')); 
    } else {
        echo json_encode(
            array('message' => 'Recipe Not Updated'));
    }
?>