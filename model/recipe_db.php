<?php 

class Recipe {
 // DB Stuff

    private $conn;


    // Properties

    public $id;
    public $recipes;
    public $title;
    public $description;
    public $prep;
    public $servings;
    public $cook_time;
    public $ingredients;
    public $directions;
    public $aws_url;
    public $img_id;


    // Constructor with DB

    public function __construct($db){
        $this->conn = $db;
    }


    // Read Recipes

    public function read() {
        // Create query

        $query = 'SELECT recipes.id, recipes.title, recipes.description, recipes.prep, recipes.servings,
            recipes.cook_time, recipes.ingredients, recipes.directions, recipes.aws_url
                            FROM recipes';
                        $statement = $this->conn->prepare($query);
                        $statement->execute();
                        return $statement;
    }


    // Get Single Recipe

    public function read_single() {
        //Create Query
        $query = 'SELECT recipes.id, recipes.title, recipes.description, recipes.prep, recipes.servings,
            recipes.cook_time, recipes.ingredients, recipes.directions
                            FROM recipes
                            WHERE recipes.id = ?
                            LIMIT 0,1';
                        $statement = $this->conn->prepare($query);
                        $statement->bindParam(1, $this->id);
                        $statement->execute();
                        $row = $statement->fetch(PDO::FETCH_ASSOC);


                        // Set Properties

                        $this->title = $row['title'];
                        $this->description = $row['description'];
                        $this->prep = $row['prep'];
                        $this->servings = $row['servings'];
                        $this->cook_time = $row['cook_time'];
                        $this->ingredients = $row['ingredients'];
                        $this->directions = $row['directions'];
    }

    // Create Recipe

    public function create() {
        //Create query

        $query = 'INSERT INTO recipes
        SET title = :title, description = :description, prep = :prep, servings = :servings, cook_time = :cook_time, ingredients = :ingredients, directions = :directions, aws_url = :aws_url';

        $statement = $this->conn->prepare($query);

        //Secure Data


        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prep = htmlspecialchars(strip_tags($this->prep));
        $this->servings = htmlspecialchars(strip_tags($this->servings));
        $this->cook_time = htmlspecialchars(strip_tags($this->cook_time));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
        $this->directions = htmlspecialchars(strip_tags($this->directions));
        $this->aws_url = htmlspecialchars(strip_tags($this->aws_url));

        // Bind Data for Query

        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':prep', $this->prep);
        $statement->bindParam(':servings', $this->servings);
        $statement->bindParam(':cook_time', $this->cook_time);
        $statement->bindParam(':ingredients', $this->ingredients);
        $statement->bindParam(':directions', $this->directions);
        $statement->bindParam(':aws_url', $this->aws_url);

        // Execute Query
        if($statement->execute()) {
            printf('Recipe Created');
            return true;
        } 

        // Print error if something goes wrong

        printf("Error: %s.\n", $statement->error);
        return false;
    }



    // Update Recipe

    public function update() {
        // Create query

        $query = 'UPDATE recipes
        SET title = :title, 
        description = :description, 
        prep = :prep, 
        servings = :servings,
        aws_url = :aws_url,
        cook_time = :cook_time, 
        ingredients = :ingredients, 
        directions = :directions,
        id = :id
        WHERE id = :id';

        $statement = $this->conn->prepare($query);

        //Secure Data

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prep = htmlspecialchars(strip_tags($this->prep));
        $this->servings = htmlspecialchars(strip_tags($this->servings));
        $this->cook_time = htmlspecialchars(strip_tags($this->cook_time));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
        $this->directions = htmlspecialchars(strip_tags($this->directions));
        $this->aws_url = htmlspecialchars(strip_tags($this->aws_url));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind Data for Query

        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':prep', $this->prep);
        $statement->bindParam(':servings', $this->servings);
        $statement->bindParam(':cook_time', $this->cook_time);
        $statement->bindParam(':ingredients', $this->ingredients);
        $statement->bindParam(':directions', $this->directions);
        $statement->bindParam(':aws_url', $this->aws_url);
        $statement->bindParam(':id', $this->id);


        if($statement->execute()) {
            return true;
        } 

        // Print error if something goes wrong

        printf('Error: %s . \n', $statement->error);
        return false;
    }

// Delete Post

public function delete() {
    // Query

    $query = 'DELETE from recipes WHERE id = :id';
    // Prepared Statement
    $statement = $this->conn->prepare($query);
    // Clean ID
    $this->id = htmlspecialchars(strip_tags($this->id));
    // Bind ID 
    $statement->bindParam(':id', $this->id);

    if($statement->execute()) {
        return true;
    } 

    // Print error if something goes wrong

    printf('Error: %s . \n', $statement->error);
    return false;
}

}

?>