
<?php
session_start();
include '../model/config.php';

$user_id = $_SESSION['user_id'];
// … validate $_POST fields …

if (isset($_FILES['car_image']) && $_FILES['car_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir  = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    // Create a unique filename
    $ext        = pathinfo($_FILES['car_image']['name'], PATHINFO_EXTENSION);
    $filename   = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['car_image']['tmp_name'], $targetPath)) {
        // Store JUST the web-relative path in DB:
        $dbPath = 'uploads/' . $filename;
        $stmt   = $conn->prepare(
            "INSERT INTO cars 
             (seller_id, car_name, car_model, description, price_per_day, image, created_at)
             VALUES (?, ?, ?, ?, ?, ?, NOW())"
        );
        $stmt->bind_param(
            "isssds",
            $user_id,
            $_POST['car_name'],
            $_POST['car_model'],
            $_POST['description'],
            $_POST['price_per_day'],
            $dbPath
        );
        $stmt->execute();
    } else {
        die("Failed to move uploaded file.");
    }
}
?>