<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$isBuyer = $_SESSION['user_type'] === 'buyer';
$isSeller = $_SESSION['user_type'] === 'seller';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../asset/dashboard.css">
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>

    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>You are logged in as a <strong><?= $_SESSION['user_type'] ?></strong>.</p>

    <div class="button-group">
        <!-- Rent Car Button -->
        <?php if ($isBuyer): ?>
            <a href="rent_car.php" class="btn">Rent Car</a>
        <?php else: ?>
            <a href="#" class="btn" onclick="showAlert('You cannot rent a car as a seller.'); return false;">Rent Car</a>
        <?php endif; ?>

        <!-- Give Rent Post Button -->
        <?php if ($isSeller): ?>
            <a href="give_rent_post.php" class="btn">Give Rent Post</a>
        <?php else: ?>
            <a href="#" class="btn" onclick="showAlert('You cannot post a car for rent as a buyer.'); return false;">Give Rent Post</a>
        <?php endif; ?>
    </div>

    <a href="../logout.php"  class="logout" style="display: inline-block;
    padding: 14px 28px;
    margin: 10px 15px;
    font-size: 16px;
    font-weight: 600;
    background-color:rgb(252, 21, 21);
    color: white;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">Logout</a>

</body>
</html>
