<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'edms');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and fetch user ID and new status from the URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    $user_id = intval($_GET['id']);
    $new_status = ($_GET['status'] === 'active') ? 'active' : 'inactive';

    // Update the user's status in the database
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    $stmt->bind_param("si", $new_status, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the user management page with a success message
        header("Location: user_management.php?message=Status updated successfully");
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
} else {
    // Redirect back with an error message if parameters are missing
    header("Location: admin_dashboard.php?message=Invalid request");
}

$conn->close();
?>
