<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require_once('../../config/database.php');
require('../../model/recipe_db.php');

// Instantiate DB and Connect to DB

$database = new Database();
$db = $database->connect();


// Instantiate Recipe Object

$recipe = new Recipe($db);


// Get ID

$recipe->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single recipe
$recipe->read_single();

// Create array

$recipe_arr = array(
    'id' => $recipe->id,
    'title' => $recipe->title,
    'description' => $recipe->description,
    'prep' => $recipe->prep,
    'servings' => $recipe->servings,
    'cook_time' => $recipe->cook_time,
    'ingredients' => $recipe->ingredients,
    'directions' => $recipe->directions
);

// Make JSON and Output

print_r(json_encode($recipe_arr));

?>