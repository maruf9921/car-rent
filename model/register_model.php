<?php
function registerUser($conn, $username, $email, $password, $user_type, $dob) {
    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        return "Email already registered.";
    }

    // Insert user with DOB
    $stmt = $conn->prepare("INSERT INTO users (username, email, dob, password, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $dob, $password, $user_type);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Registration failed: " . $conn->error;
    }
}
?>
