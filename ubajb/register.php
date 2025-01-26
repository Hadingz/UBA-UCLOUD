<?php
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $sol_id = trim($_POST['Sol_ID']);
    $password = trim($_POST['Password']);
    $confirm_password = trim($_POST['Confirm_Password']);

    // Validate inputs
    if (empty($sol_id) || empty($password) || empty($confirm_password)) {
        $error_message = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } elseif (strlen($password) < 8) {
        $error_message = 'Password must be at least 8 characters.';
    } else {
        // Check if SOL ID already exists
        $stmt = $conn->prepare("SELECT Sol_ID FROM users WHERE Sol_ID = ?");
        $stmt->bind_param("s", $sol_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = 'SOL ID already exists. Please choose another.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (Sol_ID, Password, RegTime) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $sol_id, $hashed_password);

            if ($stmt->execute()) {
                // Registration successful
                $success_message = 'Registration successful. You can now log in.';
            } else {
                $error_message = 'Something went wrong. Please try again later.';
            }
        }
        $stmt->close();
    }
}
?>
    <!-- Header Section -->
    <?php include 'inc/header.php'; ?>
    
    <!-- Registration Section -->
    <div class="container">
        <h2>REGISTER FOR üCLOUD</h2>

        <!-- Display messages -->
        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php elseif (!empty($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <!-- SOL ID Input -->
            <div class="form-group">
                <label for="sol_id">SOL ID</label>
                <input type="text" id="sol_id" name="Sol_ID" required>
            </div>
            
            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="Password" minlength="8" required>
            </div>

            <!-- Confirm Password Input -->
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="Confirm_Password" minlength="8" required>
            </div>

            <!-- Submit Button -->
            <input class="button" type="submit" name="register" value="REGISTER">
        </form>
    </div>

    <?php include 'inc/footer.php'; ?>
</body>
</html>
