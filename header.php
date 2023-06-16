<?php

session_start();

if (!isset($_SESSION['userid'])) {
    header("location: http://localhost/student_Registration_Portal/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/activity.css">
    <link rel="stylesheet" href="css/settings.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Add Records</title>
</head>

<body>
    <header>
        <nav class="menu">
            <ul>
                
                <li><a href="dashboard.php" class="<?php echo (strpos($_SERVER['SCRIPT_NAME'], 'dashboard.php') ? "active" : "") ?>">Dashboard</a></li>
                <?php if ($_SESSION['role'] == 0) { ?>
                    <li><a href="index.php" class="<?php echo (strpos($_SERVER['SCRIPT_NAME'], 'index.php') ? "active" : "") ?>">Add</a></li>
                <?php } ?>
                <li><a href="modify.php" class="<?php echo (strpos($_SERVER['SCRIPT_NAME'], 'modify.php') ? "active" : "") ?>">Modify</a></li>
                <?php if ($_SESSION['role'] == 1) { ?>
                    <li><a href="activity.php" class="<?php echo (strpos($_SERVER['SCRIPT_NAME'], 'activity.php') ? "active" : "") ?>">Activity</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div class="logo">
            <h1 class="greet">Welcome</h1>
            <?php
            include "connection.php";
            $sql = "SELECT srfirstname as firstname, srlastname as lastname from studentregistration WHERE srid = '{$_SESSION['id']}' AND srpassword = '{$_SESSION['password']}'
                UNION ALL
                SELECT trfirstname as firstname, trlastname as lastname from teacherregistration WHERE trid = '{$_SESSION['id']}' AND trpassword = '{$_SESSION['password']}'";

            $result = mysqli_query($conn, $sql) or die("Query Failed");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<h3 class='name'>$row[firstname] $row[lastname]</h3>";
                }
            }

            ?>

        </div>
        <div class="settting-bar">
            <div class="settings">
                <form action="settings.php">
                    <input class="
            logout-btn" type="submit" value="Settings">
                </form>

            </div>
            <div class="logout">
                <form action="logout.php" method="post">
                    <input class="logout-btn" type="submit" value="Logout">
                </form>
            </div>
        </div>
    </header>