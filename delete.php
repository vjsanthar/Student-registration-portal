<?php
include "connection.php";
$link = $_SERVER['REQUEST_URI'];
$key = "?";
$identity = explode("?", $link);
$sql1 = "DELETE FROM studentdetails WHERE studentid = '{$identity[1]}'";
$result = mysqli_query($conn, $sql1);
mysqli_close($conn);
header("location: http://localhost/student_Registration_Portal/activity.php");
?>
