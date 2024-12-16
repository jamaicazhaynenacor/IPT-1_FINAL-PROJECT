<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'edms');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $user as an empty array in case there's no user data
$user = [];

// Check if the user ID (id) is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data based on the provided ID
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('User not found!'); window.location.href = 'admin_dashboard.php';</script>";
        exit;
    }
} else {
    header("Location: admin_dashboard.php");
    exit;
}

// Handle the form submission for updating the user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $fullname = trim($_POST['fullname']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Validate required fields
    if (empty($fullname) || empty($address) || empty($username) || empty($email) || empty($phone) || empty($role) || empty($status)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {
        // Update query using prepared statement
        $sql = "UPDATE users SET fullname = ?, address = ?, username = ?, email = ?, phone = ?, role = ?, status = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        // Check if statement prepared successfully
        if ($stmt === false) {
            echo "Error in SQL preparation: " . $conn->error;
            exit;
        }

        // Bind parameters
        $stmt->bind_param('sssssssi', $fullname, $address, $username, $email, $phone, $role, $status, $id);

        // Execute and check for success
        if ($stmt->execute()) {
            echo "<script>alert('User updated successfully!'); window.location.href = 'admin_dashboard.php';</script>";
            exit;
        } else {
            echo "Error updating user: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Update User</h1>
    <form method="POST">
        <!-- Hidden input to pass the user ID -->
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id'] ?? '') ?>">

        <!-- Full Name input -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name:</label>
            <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" required>
        </div>

        <!-- Address input -->
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>" required>
        </div>

        <!-- Username input -->
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
        </div>

        <!-- Email input -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

        <!-- Phone input -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
        </div>

        <!-- Role selection -->
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" name="role" required>
                <option value="admin" <?= isset($user['role']) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="viewer" <?= isset($user['role']) && $user['role'] == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                <option value="editor" <?= isset($user['role']) && $user['role'] == 'editor' ? 'selected' : '' ?>>Editor</option>
            </select>
        </div>

        <!-- Status selection -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" name="status" required>
                <option value="active" <?= isset($user['status']) && $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= isset($user['status']) && $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
</body>
</html>
