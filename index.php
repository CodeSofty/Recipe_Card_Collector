<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);


//Require Models (database, API, and class files)
require_once('config/database.php');
require('model/recipe_db.php');
require('aws/api/upload.php');
require('aws/api/delete.php');
include('view/header.php');

// Database connection
$database = new Database();
$db = $database->connect();
// Create a New Recipe Object
$recipes = new Recipe($db);


// Get and Store Parameters in Variables for Create, Read, and Delete Operations
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
if (!$title){
    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
};

$aws_url = filter_input(INPUT_POST, 'aws_url', FILTER_SANITIZE_STRING);
if (!$aws_url){
    $aws_url = filter_input(INPUT_GET, 'aws_url', FILTER_SANITIZE_STRING);
};

$id = filter_input(INPUT_POST, 'recipe_id', FILTER_SANITIZE_STRING);
if (!$id){
    $id = filter_input(INPUT_GET, 'recipe_id', FILTER_SANITIZE_STRING);
};

$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
if(!$description){
    $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
};

$prep = filter_input(INPUT_POST, 'prep', FILTER_SANITIZE_STRING);
if(!$prep){
    $prep = filter_input(INPUT_GET, 'prep', FILTER_SANITIZE_STRING);
};

$servings = filter_input(INPUT_POST, 'servings', FILTER_VALIDATE_INT);
if(!$servings){
    $servings = filter_input(INPUT_GET, 'servings', FILTER_VALIDATE_INT);
};

$previous_file_name = filter_input(INPUT_POST, 'previous_file_name', FILTER_VALIDATE_INT);
if(!$previous_file_name){
    $previous_file_name = filter_input(INPUT_GET, 'previous_file_name', FILTER_VALIDATE_INT);
};

$cook_time = filter_input(INPUT_POST, 'cook_time', FILTER_VALIDATE_INT);
if(!$cook_time){
    $cook_time = filter_input(INPUT_GET, 'cook_time', FILTER_VALIDATE_INT);
};

$img_to_be_deleted = filter_input(INPUT_POST, 'img_to_be_deleted', FILTER_VALIDATE_INT);
if(!$img_to_be_deleted){
    $img_to_be_deleted = filter_input(INPUT_GET, 'img_to_be_deleted', FILTER_VALIDATE_INT);
};


$ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_STRING);
if(!$ingredients){
    $ingredients = filter_input(INPUT_GET, 'ingredients', FILTER_SANITIZE_STRING);
};


$directions = filter_input(INPUT_POST, 'directions', FILTER_SANITIZE_STRING);
if(!$directions){
    $directions = filter_input(INPUT_GET, 'directions', FILTER_SANITIZE_STRING);
};


// Get and Store Parameters for Update Operations
$updated_title = filter_input(INPUT_POST, 'updated_title', FILTER_SANITIZE_STRING);
if (!$updated_title){
    $updated_title = filter_input(INPUT_GET, 'updated_title', FILTER_SANITIZE_STRING);
};


$updated_description = filter_input(INPUT_POST, 'updated_description', FILTER_SANITIZE_STRING);
if(!$updated_description){
    $updated_description = filter_input(INPUT_GET, 'updated_description', FILTER_SANITIZE_STRING);
};

$updated_prep = filter_input(INPUT_POST, 'updated_prep', FILTER_SANITIZE_STRING);
if(!$updated_prep){
    $updated_prep = filter_input(INPUT_GET, 'updated_prep', FILTER_SANITIZE_STRING);
};

$updated_servings = filter_input(INPUT_POST, 'updated_servings', FILTER_VALIDATE_INT);
if(!$updated_servings){
    $updated_servings = filter_input(INPUT_GET, 'updated_servings', FILTER_VALIDATE_INT);
};


$updated_cook_time = filter_input(INPUT_POST, 'updated_cook_time', FILTER_VALIDATE_INT);
if(!$updated_cook_time){
    $updated_cook_time = filter_input(INPUT_GET, 'updated_cook_time', FILTER_VALIDATE_INT);
};


$updated_ingredients = filter_input(INPUT_POST, 'updated_ingredients', FILTER_SANITIZE_STRING);
if(!$updated_ingredients){
    $updated_ingredients = filter_input(INPUT_GET, 'updated_ingredients', FILTER_SANITIZE_STRING);
};


$updated_directions = filter_input(INPUT_POST, 'updated_directions', FILTER_SANITIZE_STRING);
if(!$updated_directions){
    $updated_directions = filter_input(INPUT_GET, 'updated_directions', FILTER_SANITIZE_STRING);
};

$img_id = filter_input(INPUT_POST, 'img_id', FILTER_SANITIZE_STRING);
if(!$img_id){
    $img_id = filter_input(INPUT_GET, 'img_id', FILTER_SANITIZE_STRING);
};

// Get Action for Controller
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
$bucketName = "crudappbucket";


// Main Controller (Switch statement)
switch($action) {
// Show All Recipes
    case "show_recipes": 
        $recipes = $recipes->read();
        include('view/recipe_list.php');
        break;
// Update Recipe with User Input
    case "edit_recipe":
        if($id) {
            $recipes->id = $id;
            $recipes->title = $updated_title;
            $recipes->description = $updated_description;
            $recipes->cook_time = $updated_cook_time;
            $recipes->prep = $updated_prep;
            $recipes->servings = $updated_servings;
            $recipes->aws_url = 'https://crudappbucket.s3.amazonaws.com/'.$img_id;
            $recipes->ingredients = $updated_ingredients;
            $recipes->directions = $updated_directions;
            $recipes->update();
        }
        header("Location: .?action=show_recipes");
        break;
// View Single Recipe Page With Unique ID
    case "view_single":
            $recipes = $recipes->read_single();
            include('view/view_single.php');
            break;
// Create New Recipe with User Input
    case "create_recipe":  
        if(isset($title)) {
            $recipes->img_id = $img_id;
            $recipes->title = $title;
            $recipes->description = $description;
            $recipes->cook_time = $cook_time;
            $recipes->prep = $prep;
            $recipes->servings = $servings;
            $recipes->ingredients = $ingredients;
            $recipes->directions = $directions;
            $recipes->aws_url = 'https://crudappbucket.s3.amazonaws.com/'.$img_id;
            $recipes->create();
            $recipes->read();
            header("Location: .?action=show_recipes");
        }
        break;
            
// Delete Recipe With Unique ID
    case "delete_recipe":
        if($aws_url){
            deleteFileFromS3($aws_url);
        };
            $recipes->id = $id;
            $recipes->delete();
        echo "deleted";
            header("Location: .?action=show_recipes");
        
        break;
// Load the Update View and Pre-fill Form Values
    case "update":
        if ($id) {
            echo $id;
            $recipes->id = $id;
            $recipes->read_single();
            $title =  $recipes->title;
            $description = $recipes->description;
            $cook_time = $recipes->cook_time;
            $prep = $recipes->prep;
            $servings = $recipes->servings;
            $ingredients = $recipes->ingredients;
            $directions = $recipes->directions;
            include('view/update.php');
        }
        break;
        
// Load the Upload View
    case "upload":
        include('view/upload.php');
        break;
// By Default List all Recipes
    default:
        $recipes = $recipes->read();
        include('view/recipe_list.php');
        echo '<script>alert($file_name)</script>';
}

?>
