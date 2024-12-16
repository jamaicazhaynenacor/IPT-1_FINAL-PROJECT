<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Antonio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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
            margin-left: 250px;
            padding: 20px;
        }
        header {
            background-color: #f5b041;
            padding: 15px;
            color: white;
            text-align: center;
            font-size: 20px;
        }
        .button-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        .button-container button {
            padding: 20px;
            font-size: 18px;
            background-color: #ffffff;
            color: #333;
            border: 2px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        .button-container button:hover {
            background-color: #f5b041;
            color: white;
            border: 2px solid #f5b041;
            transform: translateY(-3px);
        }
        .button-container button:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
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
<div class="main-content">
    <header>
        BARANGAY CERTIFICATE
    </header>
    <div class="button-container">
         <button> <a href="admin_view.php"> Barangay Clearance </a> </button>
        <button> <a href="admin_indigency.php"> Barangay Indigency </a> </button>
        <button>Barangay Residency</button>
        <button>Barangay Business Permit</button>
        <button>Community Tax Certificate</button>
    </div>
</div>
</body>
</html>
