<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    // Sanitize input to prevent XSS attacks
    $fullname = htmlspecialchars($_POST['fullname']);
    $address = htmlspecialchars($_POST['address']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Check if username or email already exists using prepared statements
    $checkUser = "SELECT * FROM Users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkUser);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Insert new user with password hashing and prepared statement
        $sql = "INSERT INTO Users (fullname, address, username, password, email, phone, role) 
                VALUES (?, ?, ?, ?, ?, ?, 'user')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fullname, $address, $username, $password, $email, $phone);

        if ($stmt->execute()) {
            echo "New user registered successfully.";
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <form class="registration-form" action="register.php" method="post">
                <h2>Registration</h2>

                <label for="fullname">Full name:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
                <br>
                <button type="submit">Register</button>
                <br>
                <p>Already have an account?
                <a href="login.php">Log in</a></p>
            </form>
        </div>
    </body>
</html>
