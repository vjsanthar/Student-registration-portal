<?php

session_start();

unset($_SESSION['new_userid']);

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/header.css">

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
            $sql1 = "SELECT srfirstname as firstname, srlastname as lastname from studentregistration WHERE srid = '{$_SESSION['id']}' AND srpassword = '{$_SESSION['password']}'
                UNION ALL
                SELECT trfirstname as firstname, trlastname as lastname from teacherregistration WHERE trid = '{$_SESSION['id']}' AND trpassword = '{$_SESSION['password']}'";

            $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo "<h3 class='name'>$row1[firstname] $row1[lastname]</h3>";
                }
            }

            ?>
        </div>
        <div class="settting-bar">
            <div class="settings">
                <input class="
            logout-btn" type="button" value="Settings">
            </div>
            <div class="logout">
                <form action="logout.php" method="post">
                    <input class="logout-btn" type="submit" value="Logout">
                </form>
            </div>
        </div>
    </header>


    <section>
        <?php

        include "connection.php";

        if ($_SESSION['role'] == 1) {
            $link = $_SERVER['REQUEST_URI'];
            $key = "?";
            if (strpos($link, $key)) {
                $identity = explode("?",$link);                
                $sql2 = "SELECT teacherid FROM studentdetails WHERE studentid = '{$identity[1]}'";
                $result2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_assoc($result2);
                    if($row2['teacherid'] == $_SESSION['id']){
                        $_SESSION['new_userid'] = $identity[1];
                        $sql = "SELECT * FROM studentdetails WHERE studentid = '{$identity[1]}'";
                    }else{
                        echo "<span class='text-3d'>404</span>";
                        echo "<span class='text'>No data to show, please select the student first to view there data.</span>";
                        die();
                    }
                }
                $_SESSION['new_userid'] = $identity[1];
                $sql = "SELECT * FROM studentdetails WHERE studentid = '{$identity[1]}'";
            }else{
                // echo "No data to show, please select the student first to view there data.";
                echo "<span class='text-3d'>404</span>";
                echo "<span class='text'>No data to show, please select the student first to view there data.</span>";

                die();
            }
            
        } else {
            $sql = "SELECT * FROM studentdetails WHERE studentid = '{$_SESSION['userid']}'";
        }

        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="container">
                <div class="personal-container">
                    <h1 class="personal-logo">Personal Details</h1>
                    <ul class="wrapper">
                        <div class="student-photo-container">
                            <div class="student-photo">
                                <img src="images/<?php echo $row['studentImage']; ?>" alt="">
                                <h3>Student Photo</h3>
                            </div>
                        </div>
                        <li>
                            <label for="">Name</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Date of Birth</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['dob']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Father's name</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['fatherName']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Mother's name</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['motherName']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Temporary Address</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['temporaryAddress']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Permanent Address</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['permanentAddress']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Aadhar Number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['aadhaarNumber']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Email Address</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['email']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Phone number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['phoneNumber']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Father's Phone number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['fatherPhoneNo']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Mother's Phone number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['motherPhoneNo']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>

                    </ul>
                </div>
                <div class="college-container">
                    <h1 class="college-logo">Academic Details</h1>
                    <ul class="wrapper">
                        <li>
                            <label for="">College Name</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['collegeName']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Course</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['course']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Branch</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['branch']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['semester']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Enrollment number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['enrollmentNumber']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Roll number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['rollNumber']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Recipt number</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo $row['recipt']; ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 1 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['firstSemester'])?$row['firstSemester']." %":$row['firstSemester']);  ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 2 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['secondSemester'])?$row['secondSemester']." %":$row['secondSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 3 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['thirdSemester'])?$row['thirdSemester']." %":$row['thirdSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 4 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['fourthSemester'])?$row['fourthSemester']." %":$row['fourthSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 5 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['fifthSemester'])?$row['fifthSemester']." %":$row['fifthSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 6 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['sixthSemester'])?$row['sixthSemester']." %":$row['sixthSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 7 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['seventhSemester'])?$row['seventhSemester']." %":$row['seventhSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li>
                            <label for="">Semester 8 Result</label>
                            <input type="text" readonly onselectstart="return false" value="<?php echo (is_numeric($row['eighthSemester'])?$row['eighthSemester']." %":$row['eighthSemester']); ?>" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </li>
                        <li class="image">
                            <div>
                                <img src="images/<?php echo $row['feeRecipt']; ?>" alt="">
                                <h3>Student fee recipt</h3>
                            </div>
                            <div>
                                <img src="images/<?php echo $row['studentSignature']; ?>" alt="">
                                <h3>Student Signature</h3>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
    </section>
<?php
        }else{
            echo "<span class='text-3d'>404</span>";
            echo "<span class='text'>No data to show, please fill the student form first to view your data.</span>";
            die();
        }
        mysqli_close($conn);
?>

<?php include_once "footer.php" ?>

</body>

</html>