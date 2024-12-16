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

// Retrieve the ID of the indigency to print
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the indigency details from the database
    $stmt = $conn->prepare("SELECT * FROM indigencies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the indigency data
        $indigency = $result->fetch_assoc();
    } else {
        die("Indigency record with ID $id not found.");
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
    <title>Print Indigency Certificate</title>
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
        <p>This is to <strong> CERTIFY </strong>  that <strong><?php echo htmlspecialchars($indigency['name']); ?></strong>, 
        <?php echo htmlspecialchars($indigency['age']); ?> years old, <strong> <?php echo htmlspecialchars($indigency['civil_status']); ?>, </strong> is a resident of Barangay San Antonio (Millabas), Pilar, Sorsogon.</p>
        
        <p>Based on our records and inquiry, the above-mentioned person belongs to an indigent family in our barangay. This certification is issued for the purpose of 
        <strong><?php echo htmlspecialchars($indigency['purpose']); ?></strong> and for whatever legal purpose it may serve.</p>
        
        <p>Issued this <strong><?php echo htmlspecialchars($indigency['date']); ?></strong> at Barangay San Antonio (Millabas), Pilar, Sorsogon.</p>
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
