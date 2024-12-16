<?php
// Mock data for announcements
$announcements = [
    'today' => [
        'heading' => 'TODAY',
        'items' => [
            'SK Chairman call all the youth aged 8-10 for feeding program.',
            'Barangay Officials conducted general cleaning in Purok 2 & 5.',
            'Peace Youth Federation Sponsor visiting the Brgy. San Antonio (Millabas) for conducting games with the children.',
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
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #004080;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

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

    <div class="main-content">
        <div class="header">
            <h1>Barangay San Antonio (Millabas)</h1>
        </div>

        <div class="announcements">
            <h2>Announcements</h2>
            <?php foreach ($announcements as $key => $announcement): ?>
                <h3><?php echo $announcement['heading']; ?></h3>
                <ul>
                    <?php foreach ($announcement['items'] as $item): ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        © 2024 Barangay San Antonio | All Rights Reserved
    </footer>

</body>
</html>
