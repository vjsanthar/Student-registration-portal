<?php

include "connection.php";
session_start();
session_unset();
session_destroy();

header("location: http://localhost/student_Registration_Portal/login.php");

?>