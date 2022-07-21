<?php include('view/header.php');?>
<h2>Recipes</h2>
<div class="row">   
<?php foreach ($recipes as $recipe) : ?>
    <!-- Creates A Card For Each Recipe In The Database -->
    <div class="col-sm-12 col-md-6 col-lg-4 card-deck">
        <div class="card">
            <img class="card-img-top" src = "<?php echo $recipe['aws_url']?>" alt="recipe card top image">
            <div class="card-body">
                <div class="title-box">
                    <h5 class="card-title"><?php echo $recipe['title']?></h5>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dots-icon" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </div>
            <!-- This Is For The Delete Trash Icon, Sends The Unique Id For The Recipe and AWS_URL To Index.php -->
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_recipe">
                    <input type="hidden" name="recipe_id" value="<?= $recipe['id']?>">
                    <input type="hidden" name="aws_url" value="<?=$recipe['aws_url']?>">
                    <button type="submit" class=" btn delete-button hide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
        </form>

    <!-- This Is For The Edit Pencil Icon, Sends The Unique Id For The Recipe and AWS_URL To Index.php -->
        <form action="." method="post">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="recipe_id" value="<?= $recipe['id']?>">
                <input type="hidden" name="aws_url" value="<?=$recipe['aws_url']?>">
            <button type="submit" class="btn btn-edit hide">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
        </button>
        </form>
    <!-- These Get Sent To Index.php So Users Can Load The Single Recipe Page With Data -->
        <form>
            <input type="hidden" name="action" value="view_single">
            <input type="hidden" name="recipe_id" value="<?= $recipe['id']?>">
            <input type="hidden" name="aws_url" value="<?=$recipe['aws_url']?>">
            <input type="hidden" name="title" value="<?= $recipe['title']?>">
            <input type="hidden" name="directions" value="<?= $recipe['directions']?>">
            <input type="hidden" name="ingredients" value="<?= $recipe['ingredients']?>">
            <input type="hidden" name="prep" value="<?= $recipe['prep']?>">
            <input type="hidden" name="servings" value="<?= $recipe['servings']?>">
            <input type="hidden" name="cook_time" value="<?= $recipe['cook_time']?>">
            <input type="submit" class="btn btn-primary" value="View Recipe">
        </form>
    </div>
    </div>
</div>

        <?php endforeach; ?>
</div>
<?php include('view/footer.php'); ?>