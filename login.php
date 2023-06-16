<?php

session_start();

if (isset($_SESSION['userid'])) {
    header("location: http://localhost/student_Registration_Portal/dashboard.php");
}

if(isset($_GET['check'])){
    if($_GET['check'] == 'yes'){
        echo "<script>alert('Registrstion Successfull')</script>";
    }
    if($_GET['check'] == 'no'){
        echo "<script>alert('Registrstion Unsuccessfull')</script>";
    }
}

if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Userid or password incorrect.')</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login&Signup</title>
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <h1>Student Registration Portal</h1>
        </div>
        <section>
            <div class="container">
                <div class="signin-container">
                    <h1 class="signin-logo">Sign In</h1>
                    <form action="sign_in.php" method="POST">
                        <input type="text" placeholder="User Id" name="userid" required>
                        <input type="password" name="password" id="" placeholder="Password" required>
                        <input type="submit" value="Sign in" name="signin_btn">
                    </form>
                </div>
                <div class="signup-container">
                    <h1 class="signup-logo">Sign Up</h1>
                    <!-- <form action="sign_up.php" method="POST" name="myForm1"> -->
                    <form action="sign_up.php" method="POST" name="myForm1" id="myForm1" onsubmit="return matchpass() && validateForm() && validateemail() && CheckPassword(document.myForm1.password1)">
                        <span id="error-fname" class="validation"></span>
                        <input type="text" placeholder="First Name" name="fname" required>
                        <span id="error-lname" class="validation"></span>
                        <input type="text" placeholder="Last Name" name="lname" required>
                        <span id="error-email" class="validation"></span>
                        <input type="text" placeholder="Email Id" name="email" required>
                        <span id="error-userid" class="validation"> </span>
                        <input type="text" placeholder="UserId" name="userid" required>
                        <span id="error-password1" class="validation"></span>
                        <input type="password" name="password1" id="" placeholder="Password" required>
                        <span id="error-password2" class="validation"></span>
                        <input type="password" name="password2" id="" placeholder="Re-enter Password" required>
                        <input type="submit" value="Sign up" name="signup_btn">
                    </form>
                </div>
            </div>
        </section>
    </div>

<script src="javascript/formValidation.js"></script>

</body>
</html>