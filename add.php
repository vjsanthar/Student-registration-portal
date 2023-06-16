<?php

include "connection.php";

session_start();



if(isset($_POST['add_btn'])){

    if(isset($_FILES['stu_photo'])){
        $errors = array();

        $file_name_photo = $_FILES['stu_photo']['name'];
        $file_size = $_FILES['stu_photo']['size'];
        $file_tmp = $_FILES['stu_photo']['tmp_name'];
        $file_type = $_FILES['stu_photo']['type'];
        $file_ext = explode('.',$file_name_photo);
        $file_ext = strtolower(end($file_ext));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            $errors = "Please choose a file with JPEG, JPG, or PNG extensions.";
        }

        if($file_size > 2097152){
            $errors = "File size must be lower than or equla to 2 mb";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,"images/".$file_name_photo);
        }else{
            print_r($errors);
            die();
        }
    }

    if(isset($_FILES['fee_recipt'])){
        $errors = array();

        $file_name_recipt = $_FILES['fee_recipt']['name'];
        $file_size = $_FILES['fee_recipt']['size'];
        $file_tmp = $_FILES['fee_recipt']['tmp_name'];
        $file_type = $_FILES['fee_recipt']['type'];
        $file_ext = explode('.',$file_name_recipt);
        $file_ext = strtolower(end($file_ext));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            $errors = "Please choose a file with JPEG, JPG, or PNG extensions.";
        }

        if($file_size > 2097152){
            $errors = "File size must be lower than or equla to 2 mb";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,"images/".$file_name_recipt);
        }else{
            print_r($errors);
            die();
        }
    }

    if(isset($_FILES['stu_signature'])){
        $errors = array();

        $file_name_signature = $_FILES['stu_signature']['name'];
        $file_size = $_FILES['stu_signature']['size'];
        $file_tmp = $_FILES['stu_signature']['tmp_name'];
        $file_type = $_FILES['stu_signature']['type'];
        $file_ext = explode('.',$file_name_signature);
        $file_ext = strtolower(end($file_ext));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            $errors = "Please choose a file with JPEG, JPG, or PNG extensions.";
        }

        if($file_size > 2097152){
            $errors = "File size must be lower than or equla to 2 mb";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,"images/".$file_name_signature);
        }else{
            print_r($errors);
            die();
        }
    }

    $fname = mysqli_real_escape_string($conn,$_POST['first_name']);
    $mname = mysqli_real_escape_string($conn,$_POST['middle_name']);
    $lname = mysqli_real_escape_string($conn,$_POST['last_name']);
    $collegename = mysqli_real_escape_string($conn,$_POST['college_name']);
    $enrollment_num = mysqli_real_escape_string($conn,$_POST['enrollment_number']);
    $roll_num = mysqli_real_escape_string($conn,$_POST['roll_number']);
    $aadhaar_num = mysqli_real_escape_string($conn,$_POST['aadhaar_number']);
    $course = mysqli_real_escape_string($conn,$_POST['courseValue']);
    $branch = mysqli_real_escape_string($conn,$_POST['branchValue']);
    $sem =mysqli_real_escape_string($conn, $_POST['semesterValue']);
    $father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
    $mother_name = mysqli_real_escape_string($conn,$_POST['mother_name']);
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $date_of_birth = date('Y-m-d',strtotime($dob));
    $temp_add = mysqli_real_escape_string($conn,$_POST['temproary_add']);
    $perm_add = mysqli_real_escape_string($conn,$_POST['permanent_add']);
    $email_add = mysqli_real_escape_string($conn,$_POST['email']);
    $stu_phone = mysqli_real_escape_string($conn,$_POST['student_number']);
    $father_phone = mysqli_real_escape_string($conn,$_POST['father_number']);
    $mother_phone = mysqli_real_escape_string($conn,$_POST['mother_number']);
    $recipt_number = mysqli_real_escape_string($conn,$_POST['recipt_number']);
    $selectValueSem1 = mysqli_real_escape_string($conn,$_POST['sem1']);
    $inputValueSem1 = mysqli_real_escape_string($conn,$_POST['1sem']);
    $semester_1 = selectOptionValue($selectValueSem1,$inputValueSem1);
    $selectValueSem2 = mysqli_real_escape_string($conn,$_POST['sem2']);
    $inputValueSem2 = mysqli_real_escape_string($conn,$_POST['2sem']);
    $semester_2 = selectOptionValue($selectValueSem2,$inputValueSem2);
    $selectValueSem3 = mysqli_real_escape_string($conn,$_POST['sem3']);
    $inputValueSem3 = mysqli_real_escape_string($conn,$_POST['3sem']);
    $semester_3 = selectOptionValue($selectValueSem3,$inputValueSem3);
    $selectValueSem4 = mysqli_real_escape_string($conn,$_POST['sem4']);
    $inputValueSem4 = mysqli_real_escape_string($conn,$_POST['4sem']);
    $semester_4 = selectOptionValue($selectValueSem4,$inputValueSem4);
    $selectValueSem5 = mysqli_real_escape_string($conn,$_POST['sem5']);
    $inputValueSem5 = mysqli_real_escape_string($conn,$_POST['5sem']);
    $semester_5 = selectOptionValue($selectValueSem5,$inputValueSem5);
    $selectValueSem6 = mysqli_real_escape_string($conn,$_POST['sem6']);
    $inputValueSem6 = mysqli_real_escape_string($conn,$_POST['6sem']);
    $semester_6 = selectOptionValue($selectValueSem6,$inputValueSem6);
    $selectValueSem7 = mysqli_real_escape_string($conn,$_POST['sem7']);
    $inputValueSem7 = mysqli_real_escape_string($conn,$_POST['7sem']);
    $semester_7 = selectOptionValue($selectValueSem7,$inputValueSem7);
    $selectValueSem8 = mysqli_real_escape_string($conn,$_POST['sem8']);
    $inputValueSem8 = mysqli_real_escape_string($conn,$_POST['8sem']);
    $semester_8 = selectOptionValue($selectValueSem8,$inputValueSem8);    

    echo $sql = "INSERT INTO studentdetails (teacherid, studentid, firstName, middleName, lastName, collegeName, enrollmentNumber, rollNumber, aadhaarNumber, course, branch, semester, fatherName, motherName, dob, temporaryAddress, permanentAddress, email, phoneNumber, fatherPhoneNo, motherPhoneNo, recipt, firstSemester, secondSemester, thirdSemester, fourthSemester, fifthSemester, sixthSemester, seventhSemester, eighthSemester, studentImage, feeRecipt, studentSignature) VALUES ('{$_SESSION['teacherid']}','{$_SESSION['userid']}','{$fname}','{$mname}','{$lname}','{$collegename}','{$enrollment_num}','{$roll_num}','{$aadhaar_num}','{$course}','{$branch}','{$sem}','{$father_name}','{$mother_name}','{$date_of_birth}','{$temp_add}','{$perm_add}','{$email_add}','{$stu_phone}','{$father_phone}','{$mother_phone}','{$recipt_number}','{$semester_1}','{$semester_2}','{$semester_3}','{$semester_4}','{$semester_5}','{$semester_6}','{$semester_7}','{$semester_8}','{$file_name_photo}','{$file_name_recipt}','{$file_name_signature}')";

    $result = mysqli_query($conn,$sql) or die("Query Failed");


    header("location: http://localhost/student_Registration_Portal/dashboard.php");


    mysqli_close($conn);

    
}else{
    echo "Some unexpected error occured";
}

function selectOptionValue($selectValue,$inputValue){
    if($selectValue == "All Clear"){
        $selectValue = $inputValue;
        return $selectValue;         
    }
    elseif($selectValue === "Not Appeared"){
        return "Not Appeared";
    }elseif($selectValue == ""){
        return "Not Appeared";
    }else{
        return $selectValue;
    }
}
?>
<script src="javascript/inputDisable.js"></script>


