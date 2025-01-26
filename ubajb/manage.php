<?php
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['Sol_ID'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

$sol_id = $_SESSION['Sol_ID']; // Get logged-in user's Sol_ID

// Fetch documents for the logged-in user
$stmt = $conn->prepare("SELECT Sol_ID, Account_No, Account_Name, Doc_name, url, uploaded_Time FROM documents");
$stmt->execute();
$result = $stmt->get_result();
?>

    <!-- Header Section -->
    <?php include 'inc/header.php'; ?>

    <a href="dashboard.php" class="cta-button"> PREVIOUS PAGE  <input  type="button" > </a>

    <section class="container2 manage-section">
        <h1>Manage Your Documents</h1>
        <input type="text" id="searchBar" placeholder="Search Documents..." onkeyup="filterTable()">
        <table id="documentTable">
            <thead>
                <tr>
                    
                    <th>Document Name</th>
                    <th>Document Type</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Uploaded By</th>
                    <th>Upload Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    // Extract document type from the file extension
                    $document_type = pathinfo($row['url'], PATHINFO_EXTENSION);
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Doc_name']); ?></td>
                        <td><?php echo strtoupper($document_type); ?></td>
                        <td><?php echo htmlspecialchars($row['Account_No']); ?></td>
                        <td><?php echo htmlspecialchars($row['Account_Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Sol_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['uploaded_Time']); ?></td>
                        <td>
                            <button class="cta-button" onclick="window.location.href='<?php echo htmlspecialchars($row['url']); ?>'">Download</button>
                            <button class="cta-button" onclick="deleteDocument('<?php echo htmlspecialchars($row['Doc_name']); ?>')">Delete</button>
                            <button class="cta-button" onclick="modifyDocument('<?php echo htmlspecialchars($row['Doc_name']); ?>')">Modify</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
        
    <a href="dashboard.php" class="cta-button"> PREVIOUS PAGE  <input  type="button" > </a>

    </section>
<br><br>

    <script>
        // Filter table rows based on the search input
        function filterTable() {
            const searchBar = document.getElementById('searchBar');
            const filter = searchBar.value.toLowerCase();
            const table = document.getElementById('documentTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j] && cells[j].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        }

        // Placeholder for delete action
        function deleteDocument(docName) {
            alert('Deleting document: ' + docName);
            // Add actual delete functionality here
        }

        // Placeholder for modify action
        function modifyDocument(docName) {
            alert('Modifying document: ' + docName);
            // Add actual modify functionality here
        }
    </script>


</body>
</html>
