<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: dashboard.php");
    exit();
}
include '../model/config.php';
include '../model/rent_car_model.php';
$cars = fetchAllAvailableCars($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Available Cars</title>
  <link rel="stylesheet" href="../asset/rent_car.css">
</head>
<body>
  <h2>Available Cars</h2>
 <div style="display: flex; justify-content: center;">
  <a href="dashboard.php" class="rent-btn">Dashboard</a>
</div>
  <div class="row">
    <?php foreach ($cars as $car): ?>
      <div class="card" style="width:250px; margin:1em; display:inline-block; vertical-align:top;">
        <img
          src="../uploads/<?= htmlspecialchars(basename($car['image'])) ?>"
          alt="Car: <?= htmlspecialchars($car['car_name']) ?>"
          style="width:250px;height:150px;object-fit:cover;"
        >
        <div style="padding: 10px;">
          <h3><?= htmlspecialchars($car['car_name']) ?></h3>
          <p>Model: <?= htmlspecialchars($car['car_model']) ?></p>
          <p> <?= htmlspecialchars($car['description']) ?></p>
          <p>৳<?= number_format($car['price_per_day'], 2) ?>/day</p>
          <!-- Rent Now Button -->
          <a href="rent_confirm.php?car_id=<?= urlencode($car['id']) ?>" class="rent-btn">Rent Now</a>




        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
