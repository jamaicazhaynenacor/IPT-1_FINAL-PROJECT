<?php
// Start session to store announcements dynamically
session_start();

// Initialize announcements if not already set
if (!isset($_SESSION['announcements'])) {
    $_SESSION['announcements'] = [
        'today' => [
            'heading' => 'TODAY',
            'items' => [
                'SK Chairman calls all the youth aged 8-10 for the feeding program.',
                'Barangay Officials conducted general cleaning in Purok 2 & 5.',
                'Peace Youth Federation Sponsor visiting Brgy. San Antonio (Millabas) for conducting games with the children.',
            ]
        ],
        'tomorrow' => [
            'heading' => 'TOMORROW',
            'items' => [
                'SK Officials will conduct KK Profiling for all the youth aged 15-30 years old in the morning.',
                'Tomorrow will be the Grand Santacruzan 2024 in San Antonio (Millabas).',
            ]
        ],
        'yesterday' => [
            'heading' => 'YESTERDAY',
            'items' => [
                'No Announcement'
            ]
        ]
    ];
}

// Handle form submission to add a new announcement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_announcement'])) {
        $day = $_POST['day']; // "today", "tomorrow", or "yesterday"
        $newAnnouncement = htmlspecialchars($_POST['new_announcement']); // Sanitize input

        // Add the new announcement to the selected day
        if (!empty($newAnnouncement)) {
            $_SESSION['announcements'][$day]['items'][] = $newAnnouncement;
        }
    }

    // Handle delete request
    if (isset($_POST['delete_announcement'])) {
        $day = $_POST['day']; // "today", "tomorrow", or "yesterday"
        $announcementIndex = $_POST['delete_announcement']; // Index of the announcement to delete

        // Remove the selected announcement from the array
        if (isset($_SESSION['announcements'][$day]['items'][$announcementIndex])) {
            unset($_SESSION['announcements'][$day]['items'][$announcementIndex]);
            // Reindex the array to avoid empty spots
            $_SESSION['announcements'][$day]['items'] = array_values($_SESSION['announcements'][$day]['items']);
        }
    }
}

// Get announcements
$announcements = $_SESSION['announcements'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f9;
            color: #333;
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
            margin-left: 260px;
            padding: 20px;
        }
        .header {
            background-color: #f4cc70;
            color: #333;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }
        .header img {
            width: 50px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .header h1 {
            display: inline-block;
            font-size: 2em;
            margin: 0;
        }
        .announcements {
            margin-top: 20px;
        }
        .announcements h2 {
            font-size: 1.5em;
            color: #004080;
            margin-bottom: 10px;
        }
        .announcements h3 {
            background-color: #004080;
            color: #fff;
            padding: 10px;
            font-size: 1.2em;
            border-radius: 5px;
        }
        .announcements ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .announcements li {
            background-color: #e9f0fa;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-container input, .form-container select, .form-container button {
            padding: 10px;
            font-size: 14px;
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
        <div class="header">
            <h1>Barangay San Antonio (Millabas)</h1>
        </div>

        <div class="announcements">
            <h2>Announcements</h2>

            <!-- Create New Announcement -->
            <div class="form-container">
                <form method="POST" action="">
                    <input type="text" name="new_announcement" placeholder="Enter new announcement..." required>
                    <select name="day">
                        <option value="today">Today</option>
                        <option value="tomorrow">Tomorrow</option>
                        <option value="yesterday">Yesterday</option>
                    </select>
                    <button type="submit">Add Announcement</button>
                </form>
            </div>

            <!-- Display Announcements -->
            <?php foreach ($announcements as $key => $announcement): ?>
                <h3><?php echo $announcement['heading']; ?></h3>
                <ul>
                    <?php foreach ($announcement['items'] as $index => $item): ?>
                        <li>
                            <?php echo $item; ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="day" value="<?php echo $key; ?>">
                                <input type="hidden" name="delete_announcement" value="<?php echo $index; ?>">
                                <button type="submit" style="background-color: red; color: white; border: none; cursor: pointer;">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
