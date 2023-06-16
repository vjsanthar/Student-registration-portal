<?php

include "connection.php";

if(isset($_POST['signup_btn'])){

    $f_name = mysqli_real_escape_string($conn,$_POST['fname']);
    $l_name = mysqli_real_escape_string($conn,$_POST['lname']);
    $email_id = mysqli_real_escape_string($conn,$_POST['email']);
    $user_id = mysqli_real_escape_string($conn,$_POST['userid']);
    $password_1 = mysqli_real_escape_string($conn,md5($_POST['password1']));
    $password_2 = mysqli_real_escape_string($conn,md5($_POST['password2']));

    if($password_1 === $password_2){
        $str = explode("@",$user_id);
        if($str[0] === 'iamteacher'){
            // Teacher table entry
            $sql1 = "SELECT tremail, truserid FROM teacherregistration WHERE truserid = '{$str[1]}'";
            $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
            if(mysqli_num_rows($result1) > 0){
                echo "Userid already exist.";
                die();
            }else{
                $sql2 = "insert into teacherregistration (trfirstname,trlastname,tremail,truserid,trpassword) values ('{$f_name}','{$l_name}','{$email_id}','{$str[1]}','{$password_1}')";
                $result = mysqli_query($conn,$sql2) or die("Query Failed");
                mysqli_close($conn);
                }
        }
        else{
            // Student table entry
            $sql3 = "SELECT sremail, sruserid FROM studentregistration WHERE sruserid = '{$user_id}'";
            $result3 = mysqli_query($conn,$sql3);
            if(mysqli_num_rows($result3) > 0){
                header("location: http://localhost/student_Registration_Portal/login.php?check=no");
                die();
            }else{
            $sql4 = "insert into studentregistration (srfirstname,srlastname,sremail,sruserid,srpassword) values ('{$f_name}','{$l_name}','{$email_id}','{$user_id}','{$password_1}')";
            $result4 = mysqli_query($conn,$sql4) or die("Query Failed");
            mysqli_close($conn);            
            }
        }
    }
    else{
        // incorect password
        echo "<script>alert('The two passwords didn't matched');</script>";
    }
    header("location: http://localhost/student_Registration_Portal/login.php?check=yes");
    
}
