<?php
// Database connection
$host = "localhost";
$username = "root";
$password = ""; // Set your database password
$dbname = "edms"; // Database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch clearances from the database
$sql = "SELECT * FROM clearances"; // Replace `clearances` with your actual table name
$result = $conn->query($sql);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete clearance from the database
    $delete_sql = "DELETE FROM clearances WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Redirect to refresh the table
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Barangay Clearance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        td {
            vertical-align: middle; /* Align content vertically */
        }
        td.actions {
            vertical-align: middle; /* Center content vertically */
            text-align: center; /* Center content horizontally */
            white-space: nowrap; /* Prevent wrapping of buttons */
        }
        .actions a {
            display: inline-block; /* Ensure buttons are inline */
            margin: 0 5px; /* Spacing between buttons */
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Panel - Barangay Clearance Applications</h2>
    <table>
        <thead>
            <tr>
                <th>Clearance Code</th>
                <th>Name</th>
                <th>Address</th>
                <th>Age</th>
                <th>Purpose</th>
                <th>Contact</th> <!-- Contact Column -->
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($clearance = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($clearance['clearance_code']); ?></td>
                        <td><?php echo htmlspecialchars($clearance['name']); ?></td>
                        <td><?php echo htmlspecialchars($clearance['address']); ?></td>
                        <td><?php echo htmlspecialchars($clearance['age']); ?></td>
                        <td><?php echo htmlspecialchars($clearance['purpose']); ?></td>
                        <td><?php echo htmlspecialchars($clearance['contact']); ?></td> <!-- Display Contact -->
                        <td><?php echo htmlspecialchars($clearance['date']); ?></td>
                        <td class="actions">
                            <!-- Print button (opens in new tab) -->
                            <a href="print_clearance.php?id=<?php echo $clearance['id']; ?>" class="btn" target="_blank">Print</a>
                            <!-- Delete button (with confirmation) -->
                            <a href="?delete_id=<?php echo $clearance['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this clearance?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No clearance data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
