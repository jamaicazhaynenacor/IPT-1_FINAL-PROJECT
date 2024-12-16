<?php
// Include the database connection
include 'db.php';

// Sample admin credentials
$username = 'jamaica12';
$password = password_hash('jamaica111', PASSWORD_BCRYPT); // Hash the password
$fullname = 'Jamaica Zhayne Nacor';
$email = 'jamaicazhaynenacor@example.com';

$username = 'princess13';
$password = password_hash('princess222', PASSWORD_BCRYPT); // Hash the password
$fullname = 'Princess Vitto';
$email = 'princessvitto@example.com';

$username = 'leigh14';
$password = password_hash('leigh333', PASSWORD_BCRYPT); // Hash the password
$fullname = 'Lea Lyn Ancheta';
$email = 'leighancheta@example.com';

$username = 'earl15';
$password = password_hash('earl444', PASSWORD_BCRYPT); // Hash the password
$fullname = 'Earl Raisen Carretero';
$email = 'earlraisencarreteri@example.com';


// Check if the username or email already exists
$sql_check = "SELECT * FROM admins WHERE username = ? OR email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ss", $username, $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Error: Username or email already exists!";
} else {
    // Insert the new admin into the table
    $sql_insert = "INSERT INTO admins (username, password, fullname, email) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssss", $username, $password, $fullname, $email);

    if ($stmt_insert->execute()) {
        echo "Admin account successfully added!";
    } else {
        echo "Error: " . $stmt_insert->error;
    }
}

// Close connections
$stmt_check->close();
$stmt_insert->close();
$conn->close();
?>
