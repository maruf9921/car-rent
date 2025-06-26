<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Post Your Car for Rent</title>
<link rel="stylesheet" href="../asset/give_rent_post.css">
</head>
<body>
<div class="container mt-5">
<h2>Post Your Car for Rent</h2>
 
    <?php if (!empty($_SESSION['post_error'])): ?>
<div class="alert alert-danger">
<?= $_SESSION['post_error']; unset($_SESSION['post_error']); ?>
</div>
<?php endif; ?>
 
    <?php if (!empty($_SESSION['post_success'])): ?>
<div class="alert alert-success">
<?= $_SESSION['post_success']; unset($_SESSION['post_success']); ?>
</div>
<?php endif; ?>
 
    <form action="../controller/give_rent_post_controller.php"
          method="post"
          enctype="multipart/form-data">
<div class="mb-3">
<label for="car_name" class="form-label">Car Name</label>
<input type="text" class="form-control" id="car_name" name="car_name" required>
</div>
 
      <div class="mb-3">
<label for="car_model" class="form-label">Car Model</label>
<input type="text" class="form-control" id="car_model" name="car_model" required>
</div>
 
      <div class="mb-3">
<label for="description" class="form-label">Details Note</label>
<textarea class="form-control" id="description" name="description" rows="4"></textarea>
</div>
 
      <div class="mb-3">
<label for="price_per_day" class="form-label">Rent Price (per day)</label>
<input type="number" step="0.01" class="form-control"
               id="price_per_day" name="price_per_day" required>
</div>
 
      <div class="mb-3">
<label for="car_image" class="form-label">Upload Car Picture</label>
<input type="file" class="form-control"
               id="car_image" name="car_image" accept="image/*" required>
</div>
 
      <button type="submit" class="btn btn-primary">Post Car</button>
</form>
</div>
</body>
</html>