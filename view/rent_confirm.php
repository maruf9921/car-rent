<?php
session_start();

// 1. Check if user is logged in and is a buyer
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: dashboard.php");
    exit();
}

// 2. Check if car_id exists in the URL
if (!isset($_GET['car_id'])) {
    die("❌ No car selected.");
}

include '../model/config.php';

$car_id = intval($_GET['car_id']); // Safely cast to integer

// Debugging: Show raw GET data and car_id
echo "<pre>";
echo "🔍 Debug - Raw GET:\n";
print_r($_GET);
echo "car_id passed in URL: $car_id\n";
echo "</pre>";

$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();

// Debugging: Show result count
echo "<pre>SQL executed. Number of rows: {$result->num_rows}</pre>";

if ($result->num_rows === 0) {
    die("🚫 Car not found.");
}

$car = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Rent</title>
    <link rel="stylesheet" href="../asset/rent_car.css">
    <style>
        .confirm-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .confirm-container img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            height: 250px;
        }
        .btn-confirm {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            display: inline-block;
            margin-top: 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-confirm:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
<div class="confirm-container">
    <h2>Confirm Your Rent</h2>
    <img src="../uploads/<?= htmlspecialchars(basename($car['image'])) ?>" alt="<?= htmlspecialchars($car['car_name']) ?>">
    <h3><?= htmlspecialchars($car['car_name']) ?> (<?= htmlspecialchars($car['car_model']) ?>)</h3>
    <p><strong>Details:</strong><br><?= nl2br(htmlspecialchars($car['description'])) ?></p>
    <p><strong>Price:</strong> ৳<?= number_format($car['price_per_day'], 2) ?>/day</p>

    <p style="color:green">Your rent is confirm. You need to wait few minutes</p>
    <a href="dashboard.php" class="rent-btn">Dashboard</a>
</div>
</body>
</html>
