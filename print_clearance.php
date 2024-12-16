<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = ''; // Set your database password
$database = 'edms';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Retrieve the ID of the clearance to print
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the clearance details from the database
    $stmt = $conn->prepare("SELECT * FROM clearances WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the clearance data
        $clearance = $result->fetch_assoc();
    } else {
        die("Clearance with ID $id not found.");
    }

    $stmt->close();
} else {
    die("Invalid or missing ID parameter.");
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barangay Clearance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 8.5in;
            height: 11in;
            padding: 40px;
            margin: auto;
            border: 1px solid #ccc;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header1 {
            text-align: center;
        }
        .header img {
            width: 100px;
        }
        .barangay-title {
            text-align: center;
            margin-top: 10px;
        }
        .body {
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.6;
        }
        .body p {
            text-indent: 20px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            margin-top: 40px;
            text-align: left;
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <div class="header">
        <!-- Left Seal Image -->
        <img src="http://pilarsorsogon.gov.ph/wp-content/uploads/2021/01/LGU-Pilar-final-logo.png" alt="Seal Left">
        <div class="header1">
            <h2>Republic of the Philippines</h2>
            <p>Province of Sorsogon</p>
            <p>Municipality of Pilar</p>
            <p>Barangay San Antonio (Millabas)</p>
        </div>
        <!-- Right Seal Image -->
        <img src="https://tse4.mm.bing.net/th?id=OIP.zYDInWXrMlNeaY9D0zFdTwHaHa&pid=Api&P=0&h=220" alt="Seal Right">
    </div>

    <!-- Horizontal Line Under the Header Text -->
    <hr>

    <div class="body">
        <p><strong>To Whom It May Concern:</strong></p>
        <p>This is to certify that <strong><?php echo htmlspecialchars($clearance['name']); ?></strong>, 
        <?php echo htmlspecialchars($clearance['age']); ?> years old, is a bonafide resident of the barangay with postal address at 
        <strong><?php echo htmlspecialchars($clearance['address']); ?></strong>, Pilar, Sorsogon.</p>
        
        <p>I further certify that the above-named person is well known to me, possesses a good moral character, and is an abiding citizen of our Barangay with no criminal records or violations.</p>
        
        <p>This certification is issued upon the request of the interested party for whatever legal purposes it may serve.</p>
        
        <p>Given this <strong><?php echo htmlspecialchars($clearance['date']); ?></strong> at Barangay Millabas, Pilar, Sorsogon.</p>
    </div>
    
    <div class="footer">
        <p>Issued by:</p>
        <p><strong>OFELIA D. BUENDIA</strong></p>
        <p>Punong Barangay</p>
    </div>
    
    <div class="signature">
        <p>__________________________</p>
        <p>Signature of Applicant</p>
    </div>
</div>

</body>
</html>
