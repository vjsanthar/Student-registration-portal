<?php

include "connection.php";

if (isset($_POST['signin_btn'])) {

    $user_id = mysqli_real_escape_string($conn, $_POST['userid']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $link = $_SERVER['HTTP_REFERER'];

    $sql = "SELECT srid as id, sruserid as userid, srpassword as password, role from studentregistration WHERE sruserid = '{$user_id}' and srpassword = '{$password}'
    UNION ALL
    SELECT trid as id, truserid as userid, trpassword as password, role from teacherregistration WHERE truserid = '{$user_id}' and trpassword = '{$password}'";

    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['id'];
            $key = "::";
            if (strpos($link, $key)) {
                $str = explode("id=", $link);
                $crypted_token = $str[1];
                list($crypted_token, $enc_iv) = explode("::", $crypted_token);;
                $cipher_method = 'aes-128-ctr';
                $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
                $token = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
                unset($crypted_token, $cipher_method, $enc_key, $enc_iv);
                $_SESSION['teacherid'] = $token;
            } else {
                $_SESSION['teacherid'] = 0;
            }
            
            if($_SESSION['role'] == 1){
                header("location: http://localhost/student_Registration_Portal/activity.php");
            }else{
                header("location: http://localhost/student_Registration_Portal/index.php");
            }
            
        }
    } else {
        // include "login.php";
        // echo '<script>alert("Username or Password mismatch");</script>';
        header("location: http://localhost/student_Registration_Portal/login.php?status=failed");
    }
}
