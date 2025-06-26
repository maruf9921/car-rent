<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../asset/login.css">
</head>
<body>
    
    <form method="POST" action="../controller/login_controller.php">
        <h2>Login</h2>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <?php if (!empty($error)): ?>
        <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>

    
</body>
</html>
