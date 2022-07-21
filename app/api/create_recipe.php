<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

require('../../config/database.php');
require('../../model/recipe_db.php');

// Instantiate DB and Connect to DB

$database = new Database();
$db = $database->connect();


// Instantiate Recipe Object

$recipe = new Recipe($db);


// Get Raw Posted Data

$data = json_decode(file_get_contents("php://input"));

$recipe->description = $data->description;
$recipe->title = $data->title;
$recipe->prep = $data->prep;
$recipe->servings = $data->servings;
$recipe->cook_time = $data->cook_time;
$recipe->ingredients = $data->ingredients;
$recipe->directions = $data->directions;

// Create Recipe

if($recipe->create()) {
    echo json_encode(array('message' => 'Recipe Created'));
} else {
    echo json_encode(array('message' => 'Recipe Not Created'));
}