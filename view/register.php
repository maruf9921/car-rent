<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../asset/register.css">
</head>
<body>


<form method="POST" action="../controller/register_controller.php">
    <h2>Register</h2>

    <div class="form-grid">
        <!-- Left Column -->
        <div class="form-column">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" required>
        </div>

        <!-- Right Column -->
        <div class="form-column">
            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Confirm Password:</label>
            <input type="password" name="cpassword" required>

            <label>User Type:</label>
            <select name="user_type" required>
                <option value="">Select Type</option>
                <option value="buyer">Rent Seeker</option>
                <option value="seller">Owner</option>
            </select>
        </div>
    </div>


    <!-- ✅ Move validation messages here -->
    <?php if (!empty($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color:green; text-align:center; font-weight:bold;"><?= $success ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color:green"><?= $success ?></p>
    <?php endif; ?>

    <button type="submit">Register</button>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>


    
</body>
</html>
