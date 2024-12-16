<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Antonio (Millabas)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            background-image: url('https://www.eaglenews.ph/wp-content/uploads/2016/09/SK7.png');
        }

        /* Navigation bar styling */
        nav {
            height: 100vh; /* Full viewport height */
            width: 250px; /* Adjust width as needed */
            background-color: #333; /* Dark background */
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 20px;
        }

        nav li {
            margin-bottom: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        nav a:hover {
            background-color: #555;
        }

        /* Main content styling */
        main {
            margin-left: 250px; /* Adjust for navigation bar width */
            padding: 20px;
        }

        /* Header styling */
        header {
            background-color: #f0f0f0; /* Light gray */
            color: #333;
            padding: 20px;
            text-align: center;
        }

        /* Certificate container styling */
        .certificate-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Certificate item styling */
        .certificate-item {
            width: 200px;
            height: 150px;
            background-color: #fff; /* White background for certificates */
            border: 1px solid #ccc;
            text-align: center;
            padding: 20px;
            margin: 10px;
        }

        /* Specific certificate item styling */
        .certificate-item:nth-child(1),
        .certificate-item:nth-child(4) {
            background-color: #336699; /* Dark blue */
        }

        .certificate-item:nth-child(2),
        .certificate-item:nth-child(5) {
            background-color: #993333; /* Dark red */
        }

        .certificate-item:nth-child(3) {
            background-color: #99cc00; /* Dark green */
        }
    </style>
</head>
<body>
    <header>
        <h1>Barangay San Antonio (Millabas)</h1>
    </header>

    <nav>
        <ul>
            <li><a href="user_dashboard.php">Dashboard</a></li>
            <li><a href="user_annoucement.php">Announcements</a></li>
            <li><a href="user_ordinance.php">Ordinances</a></li>
            <li><a href="#">Barangay Disclosure Board</a></li>
            <li><a href="#">SK Disclosure Board</a></li>
            <li><a href="brgycert.php">Barangay Certificate</a></li>
            <li><a href="#">Blotter Form</a></li>
            <li><a href="#">Barangay Medicine</a></li>
            <li><a href="#">4PS Update</a></li>
        </ul>
    </nav>

    <main>
        <h2>Barangay Certificates</h2>

        <div class="certificate-container">
            <div class="certificate-item">
                <h3><a href="user_clearance.php" target="_blank">Barangay Clearance</a></h3>
            </div>
            <div class="certificate-item">
                <h3><a href="user_indigency.php" target="_blank">Barangay Indigency</a></h3>
            </div>
            <div class="certificate-item">
                <h3><a href="residency_form.pdf" target="_blank">Barangay Residency</a></h3>
            </div>
            <div class="certificate-item">
                <h3><a href="business_permit_form.pdf" target="_blank">Barangay Business Permit</a></h3>
            </div>
            <div class="certificate-item">
                <h3><a href="community_tax_form.pdf" target="_blank">Community Tax Certificate</a></h3>
            </div>
        </div>
    </main>
</body>
</html>