<?php
session_start();
include '../model/config.php';
include '../model/register_model.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $dob        = $_POST['dob'];
    $password   = trim($_POST['password']);
    $cpassword  = trim($_POST['cpassword']);
    $user_type  = $_POST['user_type'];

    // Basic input validation
    if (!in_array($user_type, ['buyer', 'seller'])) {
        $error = "Invalid user type.";
    } elseif (empty($username) || empty($email) || empty($dob) || empty($password) || empty($cpassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $cpassword) {
        $error = "Passwords do not match.";
    } elseif (preg_match('/\d/', $username)) {
        $error = "Username must not contain numbers.";
    } else {
        // Age validation
        $dobDate = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($dobDate)->y;

        if ($age < 18) {
            $error = "You must be at least 18 years old to register.";
        } else {
            // Call the model function to register
            $result = registerUser($conn, $username, $email, $password, $user_type, $dob);

            if ($result === true) {
                // ✅ Redirect with success message
                $_SESSION['success'] = "Registration successful! You can now login.";
                header("Location: ../view/login.php");
                exit();
            } else {
                $error = $result;
            }
        }
    }
}

// Show register form with error if validation fails
include '../view/register.php';
?>
