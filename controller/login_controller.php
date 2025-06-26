<?php
session_start();
include '../model/config.php';
include '../model/login_model.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = checkLogin($conn, $email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

include '../view/login.php';
?>
