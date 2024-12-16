<?php
// Start the session (optional, for other purposes)
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = ''; // Set your database password
$database = 'edms';

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique Indigency Code
function generateIndigencyCode($counter) {
    $date = date('Ymd'); // Current date in YYYYMMDD format
    return "IND-{$date}-" . str_pad($counter, 4, "0", STR_PAD_LEFT);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_indigency'])) {
    // Collect user input
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $civil_status = htmlspecialchars($_POST['civil_status']);
    $purpose = htmlspecialchars($_POST['purpose']);
    $date = htmlspecialchars($_POST['date']);

    // Generate a unique indigency code
    $indigency_code = generateIndigencyCode(mt_rand(1000, 9999)); // Random counter for uniqueness

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO indigencies (indigency_code, name, age, civil_status, purpose, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $indigency_code, $name, $age, $civil_status, $purpose, $date);

    if ($stmt->execute()) {
        $success_message = "Your Indigency Application has been submitted successfully! Your Indigency Code is: " . $indigency_code;
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indigency Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Indigency Application</h2>

    <!-- Display Success or Error Message -->
    <?php if (isset($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="civil_status">Civil Status</label>
            <input type="text" id="civil_status" name="civil_status" required>
        </div>
        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea id="purpose" name="purpose" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit_indigency">Submit Application</button>
        </div>
    </form>
</div>

</body>
</html>
