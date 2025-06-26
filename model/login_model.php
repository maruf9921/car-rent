<?php
function checkLogin($conn, $email, $password) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Check password directly (for plaintext passwords like '1234')
            if ($password === $user['password']) {
                return $user;
            }
        }
    }
    return false;
}
?>
