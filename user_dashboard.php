
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
            padding: 20px;
        }
        /* Dashboard cards */
        .dashboard {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .card {
            width: 150px;
            padding: 20px;
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 10px;
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
        .transaction-item {
            background-color: #F0FFFF;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #8BC34A;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="user_dashboard.php">Dashboard</a>
    <a href="user_annoucement.php">Announcements</a>
    <a href="#">Ordinances</a>
    <a href="#">Barangay Disclosure Board</a>
    <a href="#">SK Disclosure Board</a>
    <a href="#">Barangay Certificate</a>
    <a href="#">Blotter Form</a>
    <a href="#">Barangay Medicine</a>
    <a href="#">4PS Update</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h1>BARANGAY SAN ANTONIO (MILLABAS)</h1>
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
        <h2>Transactions</h2>
        <div class="transaction-item">Jay-ar Vitto has completed the Barangay Clearance and paid for it.</div>
        <div class="transaction-item">Mikyla Marinda has requested to schedule a blotter.</div>
        <div class="transaction-item">Chichi Luna has completed the Indigency Certificate and paid for it.</div>
    </div>
</div>

</body>
</html>