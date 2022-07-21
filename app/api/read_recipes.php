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

// Recipe Read Query

$result = $recipe->read();

// Row count

$num = $result->rowCount();

// Check if any recipes

if($num > 0){
    // Init array
    $recipe_arr = array();
    $recipe_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $recipe_item = array(
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'prep' => $prep,
            'servings' => $servings,
            'cook_time' => $cook_time,
            'ingredients' => $ingredients,
            'directions' => $directions

        );

        // Push to 'data'
        array_push($recipe_arr['data'], $recipe_item);
    }

    // Change to JSON and then Output
    echo json_encode($recipe_arr);

}else {
    // No Recipes

    echo json_encode(
        array('message' => 'No Recipes Found')
    );
}

?>