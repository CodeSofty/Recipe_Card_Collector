<?php 
use Aws\S3\Exception\S3Exception;

require('aws/aws_db.php');
?>

<?php include('view/header.php'); 

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
</head>
<body>

<form action="." method="POST" enctype="multipart/form-data">
<div class="form-group">
    <input type="hidden" name="action" value="edit_recipe">
    <input type="file" class="form-control-file"  name = "image" name = "action" value="upload"> <br>
    <input type="hidden" name="recipe_id" id="recipe_id" value = <?php echo $id ?>>
<!-- This Input Variable Allows The File Name To Be Timestamped To Make A Unique File Name  -->
    <input type="hidden" name = "img_id" value = "<?php echo 'user_img' . time(); ?>">
</div>



<!-- Form With Form Values Preloaded From Recipe Data -->
<div class="form-group">
    <label for="title">Recipe Title</label>
    <input class="form-control" type="text" name="updated_title" id="title" value = <?php echo $title ?>>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="updated_description" id="description" rows="3"><?php echo $description ?></textarea>
</div>

<div class="form-group">
    <label for="prep">Preparation Time</label>
    <input class="form-control" type="text" name="updated_prep" id="prep"  value = <?php echo $prep ?>>
</div>

<div class="form-group">
    <label for="servings">No. of Servings</label>
    <input class="form-control" type="text" name="updated_servings" id="servings" value = <?php echo $servings ?>>
</div>

<div class="form-group">
    <label for="time">Cook Time</label>
    <input class="form-control" type="text" name="updated_cook_time" id="cook_time" value = <?php echo $cook_time ?>>
</div>

<div class="form-group">
    <label for="ingredients">Ingredients</label>
    <textarea class="form-control" id="ingredients" name="updated_ingredients" rows="5" cols="20"><?php echo $ingredients ?></textarea>
</div>
<div class="form-group">
    <label for="directions">Directions</label>
    <textarea class="form-control" name="updated_directions" id="directions" rows="3"><?php echo $directions ?></textarea>
</div>


</select>
<input type="submit" class="btn btn-primary" name="submit" value="Submit">
</form>

</body>
<?php include('view/footer.php'); ?>
</html>