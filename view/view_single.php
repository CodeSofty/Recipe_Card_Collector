<?php include('view/header.php');?>
<div class="jumbotron img-fluid" style="background-image: url('<?php echo $aws_url?>');">
  <h1 class="display-4"><?php echo $title?></h1>
  <div class="table_container">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Prep</th>
      <th scope="col">Cook Time</th>
      <th scope="col">Servings</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $prep?></td>
      <td><?php echo $cook_time?></td>
      <td><?php echo $servings?></td>
    </tr>
  </tbody>
</table>
  </div>
  </div>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h3 class="secondary_title">Ingredients</h3>
            <p><?php echo $ingredients?></p>
        </div>

        <div class="read-single-right-col col-md-8">
            <h3 class="secondary_title text-center">Description</h3>
            <p><?php echo $description?></p>

            <h3 class="secondary_title text-center">Directions</h3>
            <p><?php echo $directions?></p>
        </div>
    </div>
</div>

<?php include('view/footer.php'); ?>