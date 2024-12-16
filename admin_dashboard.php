<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'edms');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize filters
$roleFilter = isset($_GET['role']) ? $_GET['role'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'user_id';  // Default order by 'user_id'
$order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC';  // Default order is descending

// Build SQL query with optional filters and sorting
$sql = "SELECT *, 
               CASE 
                   WHEN created_at >= NOW() - INTERVAL 1 DAY THEN 1 
                   ELSE 0 
               END AS recent_user 
        FROM users WHERE 1";

$bindTypes = ''; // Variable to store bind types
$params = [];    // Array to store bind parameters

// Add filters to query
if ($roleFilter) {
    $sql .= " AND role = ?";
    $bindTypes .= 's';
    $params[] = $roleFilter;
}
if ($statusFilter) {
    $sql .= " AND status = ?";
    $bindTypes .= 's';
    $params[] = $statusFilter;
}
if ($searchQuery) {
    $sql .= " AND (fullname LIKE ? OR email LIKE ?)";
    $bindTypes .= 'ss';
    $params[] = "%$searchQuery%";
    $params[] = "%$searchQuery%";
}

// Add sorting to query
$sql .= " ORDER BY $orderby $order";

// Prepare and bind statement
$stmt = $conn->prepare($sql);

// Bind parameters dynamically
if ($bindTypes) {
    $stmt->bind_param($bindTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch statistics
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$activeUsersQuery = "SELECT COUNT(*) AS active_users FROM users WHERE status = 'active'";
$inactiveUsersQuery = "SELECT COUNT(*) AS inactive_users FROM users WHERE status = 'inactive'";

$totalUsersResult = $conn->query($totalUsersQuery)->fetch_assoc();
$activeUsersResult = $conn->query($activeUsersQuery)->fetch_assoc();
$inactiveUsersResult = $conn->query($inactiveUsersQuery)->fetch_assoc();

$totalUsers = $totalUsersResult['total_users'];
$activeUsers = $activeUsersResult['active_users'];
$inactiveUsers = $inactiveUsersResult['inactive_users'];

// Handle status change for activate/deactivate
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    // Update status based on action (activate or deactivate)
    $newStatus = ($action === 'activate') ? 'active' : 'inactive';
    $updateStatusQuery = "UPDATE users SET status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param('si', $newStatus, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User status updated successfully!'); window.location.href = 'admin_dashboard.php';</script>";
        exit;
    } else {
        echo "Error updating status: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #3F000F;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #57677A;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3E0818;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .recent-user {
            background-color: #ffff99; /* Light yellow to highlight recent users */
            font-weight: bold;
        }
        .chart-container {
            width: 40%;
            height: 300px;
            margin: 30px auto;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="admin_dashboard.php">User Management</a>
    <a href="admin_announcement.php">Announcements</a>
    <a href="admin_ordinance.php">Ordinances</a>
    <a href="#">Barangay Disclosure Board</a>
    <a href="#">SK Disclosure Board</a>
    <a href="admin_certificate.php">Barangay Certificate</a>
    <a href="#">Blotter Form</a>
    <a href="#">Barangay Medicine</a>
    <a href="#">4PS Update</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h1 class="text-center">User Management</h1>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="<?= htmlspecialchars($searchQuery) ?>">
            </div>
            <div class="col-md-2">
                <select name="role" class="form-control">
                    <option value="">Role</option>
                    <option value="admin" <?= $roleFilter == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="viewer" <?= $roleFilter == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                    <option value="editor" <?= $roleFilter == 'editor' ? 'selected' : '' ?>>Editor</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Status</option>
                    <option value="active" <?= $statusFilter == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $statusFilter == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <a href="add_user.php" class="btn btn-success mb-3">Add User</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="?orderby=user_id&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">ID</a></th>
                <th><a href="?orderby=fullname&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">Full Name</a></th>
                <th><a href="?orderby=email&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">Email</a></th>
                <th><a href="?orderby=role&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">Role</a></th>
                <th><a href="?orderby=status&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">Status</a></th>
                <th><a href="?orderby=created_at&order=<?= $order == 'asc' ? 'desc' : 'asc' ?>">Created</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="<?= $row['recent_user'] ? 'recent-user' : '' ?>">
                    <td><?= $row['user_id'] ?></td>
                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_user.php?id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        <?php if ($row['status'] == 'active'): ?>
                            <a href="?action=deactivate&id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm">Deactivate</a>
                        <?php else: ?>
                            <a href="?action=activate&id=<?= $row['user_id'] ?>" class="btn btn-success btn-sm">Activate</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No users found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="chart-container">
        <canvas id="userStatisticsChart"></canvas>
    </div>
</div>

<script>
    const data = {
        labels: ['Active Users', 'Inactive Users'],
        datasets: [{
            label: 'User Statistics',
            data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
            backgroundColor: ['#28a745', '#dc3545']
        }]
    };

    new Chart(document.getElementById('userStatisticsChart'), { type: 'pie', data });
</script>

</body>
</html>

<?php
$conn->close();
?>
