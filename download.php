<?php
include "connection.php";
session_start();
if(isset($_POST['export-btn'])){
$link = $_SERVER['REQUEST_URI'];
$key = "?";
if (strpos($link, $key)) {
    $sortingOrder = explode("?",$link);      
    if ($sortingOrder[1] == "All_Clear") {
        $sql = "SELECT * from studentdetails where (teacherid = '{$_SESSION['id']}') AND 
        (firstSemester NOT LIKE '__Back%') AND (secondSemester NOT LIKE '__Back%') AND
        (thirdSemester NOT LIKE '__Back%') AND (fourthSemester NOT LIKE '__Back%') AND
        (fifthSemester NOT LIKE '__Back%') AND (sixthSemester NOT LIKE '_Back%') AND
        (seventhSemester NOT LIKE '__Back%') AND (eighthSemester NOT LIKE '__Back%')";
    } elseif ($sortingOrder[1] == "Backlog") {
      $sql = "SELECT * from studentdetails where (teacherid = '{$_SESSION['id']}') AND 
        (firstSemester LIKE '__Back%' OR secondSemester LIKE '__Back%' OR
        thirdSemester LIKE '__Back%' OR fourthSemester LIKE '__Back%' OR
        fifthSemester LIKE '__Back%' OR sixthSemester LIKE 'Back%'OR
        seventhSemester LIKE '__Back%' OR eighthSemester LIKE '__Back%')";
    } else {
        $sql = "SELECT * FROM studentdetails WHERE teacherid = '{$_SESSION['id']}'";
    }
}else{
    $sql = "SELECT * FROM studentdetails WHERE teacherid = '{$_SESSION['id']}'";
}

// $sql = "SELECT * from studentdetails where teacherid = '{$_SESSION['userid']}'";
$result = mysqli_query($conn,$sql);
$tabel = '<table>
            <tr>
                <td>Name</td>
                <td>Rollno.</td>
                <td>Enrollment</td>
                <td>Course</td>
                <td>Branch</td>
                <td>Semester</td>
                <td>Aadharno.</td>
                <td>DOB</td>
                <td>Father Name</td>
                <td>Mother Name</td>
                <td>Temporary Addr.</td>
                <td>Permanent Addr.</td>
                <td>Email id.</td>
                <td>Phoneno.</td>
                <td>Father Phoneno.</td>
                <td>Mother Phoneno.</td>
                <td>Semester 1</td>
                <td>Semester 2</td>
                <td>Semester 3</td>
                <td>Semester 4</td>
                <td>Semester 5</td>
                <td>Semester 6</td>
                <td>Semester 7</td>
                <td>Semester 8</td>
            </tr>';
while($row = mysqli_fetch_assoc($result)){
    $tabel .= '<tr><td>'.$row['studentid'].'</td>
                    <td>'.$row['rollNumber'].'
                    <td>'.$row['enrollmentNumber'].'
                    <td>'.$row['course'].'
                    <td>'.$row['branch'].'
                    <td>'.$row['semester'].'
                    <td>'.$row['aadhaarNumber'].'
                    <td>'.$row['dob'].'
                    <td>'.$row['fatherName'].'
                    <td>'.$row['motherName'].'
                    <td>'.$row['temporaryAddress'].'
                    <td>'.$row['permanentAddress'].'
                    <td>'.$row['email'].'
                    <td>'.$row['phoneNumber'].'
                    <td>'.$row['fatherPhoneNo'].'
                    <td>'.$row['motherPhoneNo'].'
                    <td>'.$row['firstSemester'].'
                    <td>'.$row['secondSemester'].'
                    <td>'.$row['thirdSemester'].'
                    <td>'.$row['fourthSemester'].'
                    <td>'.$row['fifthSemester'].'
                    <td>'.$row['sixthSemester'].'
                    <td>'.$row['seventhSemester'].'
                    <td>'.$row['eighthSemester'].'
                    
                </tr>';
}
$tabel .= '</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');
echo $tabel;
// mysqli_close($conn);
}
