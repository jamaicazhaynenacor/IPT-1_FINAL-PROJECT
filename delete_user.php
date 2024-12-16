<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'edms');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Delete the user from the database
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // User deleted successfully, redirect to admin dashboard with success message
            echo "<script>alert('User deleted successfully!'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            // Error deleting user
            echo "<script>alert('Error deleting user!'); window.location.href = 'admin_dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href = 'admin_dashboard.php';</script>";
    }
} else {
    // If no ID is provided, redirect back to the dashboard
    header("Location: admin_dashboard.php");
    exit;
}

// Close the database connection
$conn->close();
?>
