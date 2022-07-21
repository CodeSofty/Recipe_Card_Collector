<?php 
use Aws\S3\Exception\S3Exception;

require('aws/aws_db.php');
?>

<?php include('view/header.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>

<form action="." method="POST" enctype="multipart/form-data">
<div class="form-group"> 
    <input type="hidden" name="action" value="create_recipe" class="form-control">
    <input type="file" name="image" class="form-control-file">
    <input type="hidden" name = "img_id" value = "<?php echo 'user_img' . time(); ?>">
</div>

<div class="form-group"> 
    <label for="title">Recipe Title</label>
    <input type="text" name="title" id="title" class="form-control">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
</div>

<div class="form-group">
    <label for="prep">Preparation Time</label>
    <input type="text" name="prep" id="prep" class="form-control">
</div>

<div class="form-group">
    <label for="servings">No. of Servings</label>
    <input type="text" name="servings" id="servings" class="form-control">
</div>

<div class="form-group">
    <label for="time">Cook Time</label>
    <input type="text" name="cook_time" id="cook_time" class="form-control">
</div>

<div class="form-group">
    <label for="ingredients">Ingredients</label>
    <textarea id="ingredients" name="ingredients" rows="5" cols="20" class="form-control">
    </textarea>
</div>

<div class="form-group">
    <label for="directions">Directions</label>
    <textarea class="form-control" name="directions" id="directions" rows="3"></textarea>
</div>


</select>
<input type="submit" class="btn btn-primary" name="submit" value="Submit">
</form>

</body>
<?php include('view/footer.php'); ?>
</html>