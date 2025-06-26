<?php
session_start();
require_once __DIR__ . '/../model/config.php';
require_once __DIR__ . '/../model/give_rent_post_model.php';
 
$model = new GiveRentPostModel($conn);
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/give_rent_post.php');
    exit;
}
 
// 1) Check upload error
if (!isset($_FILES['car_image']) || $_FILES['car_image']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['post_error'] = "Image upload failed (error code: " .
        ($_FILES['car_image']['error'] ?? 'none') . ").";
    header('Location: ../view/give_rent_post.php');
    exit;
}
 
// 2) Validate form fields
$car_name      = trim($_POST['car_name']      ?? '');
$car_model     = trim($_POST['car_model']     ?? '');
$description   = trim($_POST['description']   ?? '');
$price_per_day = trim($_POST['price_per_day'] ?? '');
 
if ($car_name === '' || $car_model === '' || $price_per_day === '') {
    $_SESSION['post_error'] = "Please fill in all required fields.";
    header('Location: ../view/give_rent_post.php');
    exit;
}
 
// 3) Prepare uploads folder
$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
 
// 4) Validate file type & move
$fileTmp  = $_FILES['car_image']['tmp_name'];
$fileName = basename($_FILES['car_image']['name']);
$ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowed  = ['jpg','jpeg','png','gif'];
 
if (!in_array($ext, $allowed)) {
    $_SESSION['post_error'] = "Only JPG, PNG & GIF files are allowed.";
    header('Location: ../view/give_rent_post.php');
    exit;
}
 
$newFilename = uniqid('car_', true) . '.' . $ext;
$destination = $uploadDir . $newFilename;
 
if (!move_uploaded_file($fileTmp, $destination)) {
    $_SESSION['post_error'] = "Failed to move uploaded file. Check folder permissions.";
    header('Location: ../view/give_rent_post.php');
    exit;
}
 
// 5) Insert into database
$seller_id = $_SESSION['seller_id'] ?? 1;  // replace with real auth logic
$ok = $model->saveCar(
    $seller_id,
    $car_name,
    $car_model,
    $description,
    (float)$price_per_day,
    $newFilename
);
 
if ($ok) {
    $_SESSION['post_success'] = "Your car has been posted successfully!";
} else {
    $_SESSION['post_error'] = "Database error: " . $conn->error;
}
 
header('Location: ../view/give_rent_post.php');
exit;