<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://www.eaglenews.ph/wp-content/uploads/2016/09/SK7.png');
            margin: 0;
            padding: 0;
        }
        /* Sidebar */
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
        /* Main content */
        .main-content {
            margin-left: 270px; /* Ensure it aligns correctly with the sidebar */
            padding: 80px 20px 20px; /* Adjusted for notification bar */
        }
        /* Header with Notification Icon */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f4cc70;
            color: #333;
            padding: 20px;
            border-bottom: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .notification-icon {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
        }
        .notification-icon img {
            width: 24px;
            height: 24px;
        }
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Dashboard Cards */
        .dashboard {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }
        .card {
            width: 150px;
            padding: 20px;
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
        }
        .card p {
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
        }
        /* Transaction section */
        .transactions {
            margin-top: 40px;
        }
        .transactions h2 {
            font-size: 1.5em;
            color: #004080;
            margin-bottom: 20px;
        }
        .transaction-item {
            background-color: #F0FFFF;
            margin-bottom: 15px;
            padding: 15px;
            border-left: 5px solid #8BC34A;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .transaction-item .transaction-text {
            flex: 1;
            font-size: 16px;
        }
        .transaction-item .transaction-status {
            background-color: #8BC34A;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
<a href="dashboard.php">Dashboard</a>
    <a href="admin_dashboard.php">User Management</a>
    <a href="admin_annoucement.php">Announcements</a>
    <a href="admin_ordinance.php">Ordinances</a>
    <a href="admin_brgy.php">Barangay Disclosure Board</a>
    <a href="admin_sk.php">SK Disclosure Board</a>
    <a href="admin_certificate.php">Barangay Certificate</a>
    <a href="admin_blotter.php">Blotter Form</a>
    <a href="admin_medicine.php">Barangay Medicine</a>
    <a href="admin_4ps.php">4PS Update</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header with Notification Icon -->
    <div class="header">
        <h1>Barangay San Antonio (Millabas)</h1>
        <div class="notification-icon" onclick="alert('You have new notifications!')">
            <img src="https://cdn-icons-png.flaticon.com/512/1827/1827392.png" alt="Notification Bell">
            <div class="notification-badge">3</div> <!-- Number of notifications -->
        </div>
    </div>

    <h2>DASHBOARD</h2>

    <!-- Dashboard Cards -->
    <div class="dashboard">
        <div class="card">
            <h3>BARANGAY OFFICIALS</h3>
            <p>10</p> <!-- This value should come from the database -->
        </div>
        <div class="card">
            <h3>SK OFFICIALS</h3>
            <p>8</p>
        </div>
        <div class="card">
            <h3>APPOINTED BRGY OFFICIALS</h3>
            <p>12</p>
        </div>
        <div class="card">
            <h3>Residents</h3>
            <p>856</p>
        </div>
        <div class="card">
            <h3>SK Youth</h3>
            <p>394</p>
        </div>
        <div class="card">
            <h3>Registered Voters</h3>
            <p>791</p>
        </div>
        <div class="card">
            <h3>Barangay Certs</h3>
            <p>142</p>
        </div>
    </div>

    <!-- Transaction Section -->
    <div class="transactions">
        <h2>Recent Transactions</h2>

        <!-- Transaction Item 1 -->
        <div class="transaction-item">
            <div class="transaction-text">
                Jay-ar Vitto has completed the Barangay Clearance and paid for it.
            </div>
            <div class="transaction-status">Completed</div>
        </div>

        <!-- Transaction Item 2 -->
        <div class="transaction-item">
            <div class="transaction-text">
                Mikyla Marinda has requested to schedule a blotter.
            </div>
            <div class="transaction-status">Pending</div>
        </div>

        <!-- Transaction Item 3 -->
        <div class="transaction-item">
            <div class="transaction-text">
                Chichi Luna has completed the Indigency Certificate and paid for it.
            </div>
            <div class="transaction-status">Completed</div>
        </div>
    </div>
</div>

<script>
    // Example: Handle notification icon click
    function showNotifications() {
        alert("You have 3 new notifications!");
    }
</script>

</body>
</html>
