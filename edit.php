<?php

include "connection.php";

session_start();

if(isset($_POST['modify_btn'])){

    if(empty($_FILES['new_stu_photo']['name'])){
        $file_name_photo = $_POST['old_stu_image'];
    }else{
            $errors = array();
    
            $file_name_photo = $_FILES['new_stu_photo']['name'];
            $file_size = $_FILES['new_stu_photo']['size'];
            $file_tmp = $_FILES['new_stu_photo']['tmp_name'];
            $file_type = $_FILES['new_stu_photo']['type'];
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
    

    if(empty($_FILES['new_fee_recipt']['name'])){
        $file_name_recipt = $_POST['old_recipt_image'];
    }else{
            $errors = array();
    
            $file_name_recipt = $_FILES['new_fee_recipt']['name'];
            $file_size = $_FILES['new_fee_recipt']['size'];
            $file_tmp = $_FILES['new_fee_recipt']['tmp_name'];
            $file_type = $_FILES['new_fee_recipt']['type'];
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

    if(empty($_FILES['new_stu_signature']['name'])){
        $file_name_signature = $_POST['old_signature_image'];
    }else{
            $errors = array();
    
            $file_name_signature = $_FILES['new_stu_signature']['name'];
            $file_size = $_FILES['new_stu_signature']['size'];
            $file_tmp = $_FILES['new_stu_signature']['tmp_name'];
            $file_type = $_FILES['new_stu_signature']['type'];
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

    

    $fname = mysqli_real_escape_string($conn,$_POST['modfname']);
    $mname = mysqli_real_escape_string($conn,$_POST['modmname']);
    $lname = mysqli_real_escape_string($conn,$_POST['modlname']);
    $college_name = mysqli_real_escape_string($conn,$_POST['modcollegename']);
    $enrollment_num = mysqli_real_escape_string($conn,$_POST['modenrollment']);
    $roll_num = mysqli_real_escape_string($conn,$_POST['modrollnumber']);
    $aadhaar_num = mysqli_real_escape_string($conn,$_POST['modaadhaar']);
    $course = mysqli_real_escape_string($conn,$_POST['modcourse']);
    $branch = mysqli_real_escape_string($conn,$_POST['modbranch']);
    $sem =mysqli_real_escape_string($conn, $_POST['modsemester']);
    $father_name = mysqli_real_escape_string($conn,$_POST['modfathername']);
    $mother_name = mysqli_real_escape_string($conn,$_POST['modmothername']);
    $dob = mysqli_real_escape_string($conn,$_POST['moddob']);
    $date_of_birth = date('Y-m-d',strtotime($dob));
    $temp_add = mysqli_real_escape_string($conn,$_POST['modtemproary_add']);
    $perm_add = mysqli_real_escape_string($conn,$_POST['modpermanent_add']);
    $email_add = mysqli_real_escape_string($conn,$_POST['modemail']);
    $stu_phone = mysqli_real_escape_string($conn,$_POST['modstudentnumber']);
    $father_phone = mysqli_real_escape_string($conn,$_POST['modfathernumber']);
    $mother_phone = mysqli_real_escape_string($conn,$_POST['modmothernumber']);
    $recipt_number = mysqli_real_escape_string($conn,$_POST['modreciptnumber']);
    $selectValueSem1 = mysqli_real_escape_string($conn,$_POST['modsem1']);
    $inputValueSem1 = mysqli_real_escape_string($conn,$_POST['mod1sem']);
    $semester_1 = selectOptionValue($selectValueSem1,$inputValueSem1);
    $selectValueSem2 = mysqli_real_escape_string($conn,$_POST['modsem2']);
    $inputValueSem2 = mysqli_real_escape_string($conn,$_POST['mod2sem']);
    $semester_2 = selectOptionValue($selectValueSem2,$inputValueSem2);
    $selectValueSem3 = mysqli_real_escape_string($conn,$_POST['modsem3']);
    $inputValueSem3 = mysqli_real_escape_string($conn,$_POST['mod3sem']);
    $semester_3 = selectOptionValue($selectValueSem3,$inputValueSem3);
    $selectValueSem4 = mysqli_real_escape_string($conn,$_POST['modsem4']);
    $inputValueSem4 = mysqli_real_escape_string($conn,$_POST['mod4sem']);
    $semester_4 = selectOptionValue($selectValueSem4,$inputValueSem4);
    $selectValueSem5 = mysqli_real_escape_string($conn,$_POST['modsem5']);
    $inputValueSem5 = mysqli_real_escape_string($conn,$_POST['mod5sem']);
    $semester_5 = selectOptionValue($selectValueSem5,$inputValueSem5);
    $selectValueSem6 = mysqli_real_escape_string($conn,$_POST['modsem6']);
    $inputValueSem6 = mysqli_real_escape_string($conn,$_POST['mod6sem']);
    $semester_6 = selectOptionValue($selectValueSem6,$inputValueSem6);
    $selectValueSem7 = mysqli_real_escape_string($conn,$_POST['modsem7']);
    $inputValueSem7 = mysqli_real_escape_string($conn,$_POST['mod7sem']);
    $semester_7 = selectOptionValue($selectValueSem7,$inputValueSem7);
    $selectValueSem8 = mysqli_real_escape_string($conn,$_POST['modsem8']);
    $inputValueSem8 = mysqli_real_escape_string($conn,$_POST['mod8sem']);
    $semester_8 = selectOptionValue($selectValueSem8,$inputValueSem8);

    if($_SESSION['role'] == 1){
      $sql = "UPDATE studentdetails SET firstName = '{$fname}', middleName = '{$mname}', lastName = '{$lname}',collegeName = '{$college_name}', enrollmentNumber = '{$enrollment_num}', rollNumber = '{$roll_num}', aadhaarNumber = '{$aadhaar_num}', course = '{$course}', branch = '{$branch}', semester = '{$sem}', fatherName = '{$father_name}', motherName = '{$mother_name}', dob = '{$date_of_birth}', temporaryAddress = '{$temp_add}', permanentAddress = '{$perm_add}', email = '{$email_add}', phoneNumber = '{$stu_phone}', fatherPhoneNo = '{$father_phone}', motherPhoneNo = '{$mother_phone}', recipt = '{$recipt_number}', firstSemester = '{$semester_1}', secondSemester = '{$semester_2}', thirdSemester = '{$semester_3}', fourthSemester = '{$semester_4}', fifthSemester = '{$semester_5}', sixthSemester = '{$semester_6}', seventhSemester = '{$semester_7}', eighthSemester = '{$semester_8}', studentImage = '{$file_name_photo}', feeRecipt = '{$file_name_recipt}', studentSignature = '{$file_name_signature}' WHERE studentid = '{$_SESSION['new_userid']}'";
    }else{
        $sql = "UPDATE studentdetails SET firstName = '{$fname}', middleName = '{$mname}', lastName = '{$lname}',collegeName = '{$college_name}', enrollmentNumber = '{$enrollment_num}', rollNumber = '{$roll_num}', aadhaarNumber = '{$aadhaar_num}', course = '{$course}', branch = '{$branch}', semester = '{$sem}', fatherName = '{$father_name}', motherName = '{$mother_name}', dob = '{$date_of_birth}', temporaryAddress = '{$temp_add}', permanentAddress = '{$perm_add}', email = '{$email_add}', phoneNumber = '{$stu_phone}', fatherPhoneNo = '{$father_phone}', motherPhoneNo = '{$mother_phone}', recipt = '{$recipt_number}', firstSemester = '{$semester_1}', secondSemester = '{$semester_2}', thirdSemester = '{$semester_3}', fourthSemester = '{$semester_4}', fifthSemester = '{$semester_5}', sixthSemester = '{$semester_6}', seventhSemester = '{$semester_7}', eighthSemester = '{$semester_8}', studentImage = '{$file_name_photo}', feeRecipt = '{$file_name_recipt}', studentSignature = '{$file_name_signature}' WHERE studentid = '{$_SESSION['userid']}'";
    }

   


    $result = mysqli_query($conn,$sql) or die("Query Failed");

    if($_SESSION['role'] == 1){
        header("location: http://localhost/student_Registration_Portal/dashboard.php?$_SESSION[new_userid]");
    }else{
        header("location: http://localhost/student_Registration_Portal/dashboard.php");
    }


    


    mysqli_close($conn);
    
}else{
    echo "<script>alert('Some unexpected error occured');</script>";
}

function selectOptionValue($selectValue,$inputValue){
    if($selectValue == "All Clear"){
        $selectValue = $inputValue;
        return $selectValue;
    }
    elseif($selectValue == "Not Appeared"){
        return "Not Appeared";
    }elseif($selectValue == ""){
        return "Not Appeared";
    }else{
        return $selectValue;
    }
}

?>
