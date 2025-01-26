<?php

include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['Sol_ID'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

$sol_id = $_SESSION['Sol_ID']; // Get logged-in user's Sol_ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_number = $_POST['account_number'];
    $account_name = $_POST['account_name'];
    $document_name = $_POST['document_name'];
    $upload_dir = "uploads/"; // Directory to store uploaded files

    // Debugging: Confirm Sol_ID
    if (empty($sol_id)) {
        $message = "Session Sol_ID is not set or is empty. Please log in again.";
        exit();
    }

    // Handle file upload
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $file_name = basename($_FILES['document']['name']);
        $file_tmp_path = $_FILES['document']['tmp_name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid("doc_") . "." . $file_extension; // Generate unique file name
        $upload_path = $upload_dir . $new_file_name;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($file_tmp_path, $upload_path)) {
            // Insert data into the database
            $stmt = $conn->prepare("INSERT INTO documents (Sol_ID, Account_No, Account_Name, Doc_name, url) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $sol_id, $account_number, $account_name, $document_name, $upload_path);

            if ($stmt->execute()) {
                $success_message = "Document uploaded successfully!";
            } else {
                $message = "Failed to upload document. Please try again.";
            }

            $stmt->close();
        } else {
            $message ="Failed to move uploaded file. Please check folder permissions.";
        }
    } else {
       $message ="Please upload a valid document.";
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

<!-- Upload Form -->
<div class="container">
    <h2>üpload Your Documents</h2>
    <form action="" method="POST" enctype="multipart/form-data">
    <?php if (!empty($message)): ?>
            <p style="color: red; text-align:center;"><?php echo $message; ?></p>
        <?php elseif (!empty($success_message)): ?>
            <p style="color: green; text-align:center;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <!-- Account Number Input -->
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" id="account_number" name="account_number" minlength="10" maxlength="10" required>
        </div>
        
        <!-- Account Name Input -->
        <div class="form-group">
            <label for="account_name">Account Name</label>
            <input type="text" id="account_name" name="account_name" required>
        </div>
        
        <!-- Document Name Input -->
        <div class="form-group">
            <label for="document_name">Document Name</label>
            <input type="text" id="document_name" name="document_name" required>
        </div>
        
        <!-- File Upload Input -->
        <div class="form-group">
            <label for="document">Upload Document/Image</label>
            <input type="file" id="document" name="document" accept=".jpg,.jpeg,.png,.pdf,.docx,.xlsx,.txt" required>
        </div>

        <!-- Submit Button -->
        <input class="button" type="submit" value="Upload Document">
    </form></div>
    
    <a href="dashboard.php" class="cta-button"> PREV  <input  type="button" > </a>


<!-- Footer Section -->

</body>
</html>
