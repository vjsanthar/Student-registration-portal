<?php include_once "header.php";

if($_SESSION['role'] == 1){
    header("location: http://localhost/student_Registration_Portal/delete.php");
}
$sql2 = "SELECT studentid FROM studentdetails where studentid = '{$_SESSION['userid']}'";


$result2 = mysqli_query($conn,$sql2);

if($row1= mysqli_num_rows($result2) > 0 || $_SESSION['teacherid'] === 0){
    echo "<script> $(document).ready(function(){
        $('#myForm1 :input').prop('disabled', true);
    }); </script>";
}
?>

<div class="container" id="mycontainer">
    <form class="form-container" action="add.php" method="POST" enctype="multipart/form-data" id="myForm1" onsubmit="return  Validatemodfname() && Validatemodlname() && Validatemodfathername() && Validatemodmothername()">
        <div class="name">
            <input type="text" name="first_name" id="fname" placeholder="Name" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off autofocus required>
            <input type="text" name="middle_name" placeholder="Middle Name (if any)" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
            <input type="text" name="last_name" id="lname" placeholder="Last Name" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
        </div>
        <input type="text" placeholder="College name" name="college_name" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
        <input type="text" placeholder="Enrollment number" name="enrollment_number" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Roll number" id="stu_roll" name="roll_number" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Aadhaar number" id="stu_aadhaar" name="aadhaar_number" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <div class="name">
            <div class="backlog">
                <div class="backlog-container">
                    <div class="backlog-inner-container backlog-inner-container2">
                        <label for="">Course</label>
                        <select name="courseValue" required>
                            <option value="B.E.">B.E.</option>
                            <option value="B.Tech">B.Tech</option>
                            <option value="M.Tech">M.Tech</option>
                            <option value="B.S.C">B.S.C</option>
                            <option value="M.S.C">M.S.C</option>
                            <option value="B.Com">B.Com</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="backlog">
                <div class="backlog-container">
                    <div class="backlog-inner-container backlog-inner-container2">
                        <label for="">Branch</label>
                        <select name="branchValue" required>
                            <option value="CSE">CS</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="Electrical">Electrical</option>
                            <option value="EEE">EEE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="backlog">
                <div class="backlog-container">
                    <div class="backlog-inner-container backlog-inner-container2">
                        <label for="">Semester</label>
                        <select name="semesterValue" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" placeholder="Father's name" id="father_name" name="father_name" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Mother's name" id="mother_name" name="mother_name" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="date" placeholder="Date of birth" name="dob" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Temproary address " name="temproary_add" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Permanent address " name="permanent_add" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="email" placeholder="Email address " name="email" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Phone number " name="student_number" id="stu_num" required onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Father's phone number" name="father_number" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Mother's phone number" name="mother_number" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
        <input type="text" placeholder="Recipt number" name="recipt_number" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>


        <div class="backlog">
            <div class="backlog-container">
                <div class="backlog-inner-container">
                    <label for="">1<sup>st</sup> Semester Result</label>
                    <select name="sem1" id="selsectOptions" onchange="GetSelectedTextValue(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input" value="" placeholder="Your percentage..." name="1sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">2<sup>nd</sup> Semester Result</label>
                    <select name="sem2" id="selsectOptions" onchange="GetSelectedTextValue2(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input1" placeholder="Your percentage..." name="2sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">3<sup>rd</sup> Semester Result</label>
                    <select name="sem3" id="selsectOptions" onchange="GetSelectedTextValue3(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input2" placeholder="Your percentage..." name="3sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">4<sup>th</sup> Semester Result</label>
                    <select name="sem4" id="selsectOptions" onchange="GetSelectedTextValue4(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input3" placeholder="Your percentage..." name="4sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">5<sup>th</sup> Semester Result</label>
                    <select name="sem5" id="selsectOptions" onchange="GetSelectedTextValue5(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input4" placeholder="Your percentage..." name="5sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">6<sup>th</sup> Semester Result</label>
                    <select name="sem6" id="selsectOptions" onchange="GetSelectedTextValue6(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input5" placeholder="Your percentage..." name="6sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">7<sup>th</sup> Semester Result</label>
                    <select name="sem7" id="selsectOptions" onchange="GetSelectedTextValue7(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input6" placeholder="Your percentage..." name="7sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
                <div class="backlog-inner-container">
                    <label for="">8<sup>th</sup> Semester Result</label>
                    <select name="sem8" id="selsectOptions" onchange="GetSelectedTextValue8(this)">
                        <option value="" selected disabled hidden>Choose Here</option>>
                        <option value="All Clear">All Clear</option>
                        <option value="1 Backlog">1 Backlog</option>
                        <option value="2 Backlog">2 Backlog</option>
                        <option value="3 Backlog">3 Backlog</option>
                        <option value="4 Backlog">4 Backlog</option>
                        <option value="5 Backlog">5 Backlog</option>
                        <option value="6 Backlog">6 Backlog</option>
                        <option value="Not Appeared">Not Appeared</option>
                    </select>
                    <input type="text" id="Input7" placeholder="Your percentage..." name="8sem" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                </div>
            </div>
        </div>
        <div class="file">
            <ul class="wrapper">
                <li>
                    <div class="lst-container">
                        <label for="">Upload your photo (max size: 2mb)</label>
                        <input type="file" name="stu_photo" required>
                    </div>
                </li>
                <li>
                    <div class="lst-container">
                        <label for="">Upload your fee recipt (max size: 2mb)</label>
                        <input type="file" name="fee_recipt" required>
                    </div>
                </li>

                <li>
                    <div class="lst-container">
                        <label for="">Upload your signature (max size: 2mb)</label>
                        <input type="file" name="stu_signature" required>
                    </div>
                </li>
            </ul>
        </div>
        <input type="submit" name="add_btn"onclick="return phonenumber((document.myForm1.stu_num)) && rollnumber((document.myForm1.stu_roll)) && aadhaarnumber((document.myForm1.stu_aadhaar))">
    </form>
</div>

<?php include_once "footer.php" ?>

<script src = "javascript/optionSelect.js"></script>
<script src="javascript/studentFormValidation.js"></script>


<!-- <script src = "javascript/inputDisable.js"></script> -->


</body>

</html>