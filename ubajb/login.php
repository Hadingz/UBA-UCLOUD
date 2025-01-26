<?php
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sol_id = trim($_POST['Sol_ID']);
    $password = trim($_POST['Password']);
    $reg_time = date('Y-m-d H:i:s'); // Capture the current timestamp

    // Validate inputs
    if (empty($sol_id) || empty($password)) {
        $error_message = 'All fields are required.';
    } else {
        // Prepare and execute the query to fetch the user
        $stmt = $conn->prepare("SELECT password FROM users WHERE Sol_ID = ?");
        $stmt->bind_param("s", $sol_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, fetch the hashed password
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the entered password against the hashed password
            if (password_verify($password, $hashed_password)) {
                // Start a session
                session_start();
                $_SESSION['Sol_ID'] = $sol_id;

                // Update the RegTime in the database
                $update_stmt = $conn->prepare("UPDATE users SET RegTime = ? WHERE Sol_ID = ?");
                $update_stmt->bind_param("ss", $reg_time, $sol_id);
                $update_stmt->execute();
                $update_stmt->close();

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                // Password does not match
                $error_message = 'Invalid credentials.';
            }
        } else {
            // SOL ID does not exist
            $error_message = 'Invalid credentials.';
        }

        $stmt->close();
    }
}
?>
    <!-- Header Section -->
    <?php include 'inc/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero-section">
    <h1>üCloud – Transforming UBA's Data Management</h1>
    <p>Secure. Scalable. Seamless. Access and manage your data with ease.</p>
    </section>
    
    <div class="container">
        <h2>LOGIN TO  üCLOUD</h2>
        <form action="" method="POST">
        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php elseif (!empty($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
            <!-- SOL ID Input -->
            <div class="form-group">
                <label for="account_number">SOL ID</label>
                <input type="text" id="account_number" name="Sol_ID" required>
            </div>
            
            <!-- Password Input -->
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="Password" required>
            </div>
            
            <!-- Submit Button -->
            <input class="button" type="submit" value="LOGIN">
        </form>
    </div>

    <p id="loginError" style="color: red;"></p>


</body>
</html>
