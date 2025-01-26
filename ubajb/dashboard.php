<?php

include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['Sol_ID'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

$sol_id = $_SESSION['Sol_ID'];

/* // Fetch user data from the database
$stmt = $conn->prepare("SELECT account_balance FROM users WHERE Sol_ID = ?");
$stmt->bind_param("s", $sol_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();

$account_balance = $userData['account_balance'] ?? 0; // Default to 0 if not found */
?>


    <!-- Header Section -->
    <?php include 'inc/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <h1>üCloud – Transforming UBA's Data Management</h1>
        <p>Secure. Scalable. Seamless. Access and manage your data with ease.</p>
    </section>

    <!-- Dashboard Section -->
    <section class="container dashboard-section">
        <h1>Welcome, <?php echo htmlspecialchars($sol_id); ?></h1>
        <p>Access, manage, and upload documents securely.</p>
        
        <!-- Banking Info -->
    <div class="banking-info">
        <button style="background-color: red; color: white; padding: 10px 20px; border: none; cursor: pointer;" onclick="location.href='upload.php'">Upload Documents</button>
        <button style="background-color: red; color: white; padding: 10px 20px; border: none; cursor: pointer;" onclick="location.href='manage.php'">Manage Documents</button>
        <button style="background-color: red; color: white; padding: 10px 20px; border: none; cursor: pointer;" onclick="location.href='logout.php'">Logout</button>
    </div>
    </section>
<br><br>
  
</body>
</html>
