<?php  
// Database connection
$conn = new mysqli('localhost', 'root', '', 'edms');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request for adding a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the user input for username, email, phone, role, and status
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role = $_POST['role']; // Role input from the form
    $status = $_POST['status']; // Status input from the form

    // Check if username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Error: Username already exists!";
        exit;
    }

    // SQL query to insert the new user with the username, role, status, email, and phone
    $sql = "INSERT INTO users (username, fullname, email, phone, role, status) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $fullname, $email, $phone, $role, $status);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the dashboard upon success
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Add New User</h1>
    <form method="POST">
        <!-- Username input -->
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <!-- Full Name input -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name:</label>
            <input type="text" class="form-control" name="fullname" required>
        </div>

        <!-- Email input -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <!-- Phone input -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" name="phone" required>
        </div>

        <!-- Role selection -->
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" name="role" required>
                <option value="admin">Admin</option>
                <option value="viewer">Viewer</option>
                <option value="editor">Editor</option>
            </select>
        </div>

        <!-- Status selection -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
</body>
</html>
