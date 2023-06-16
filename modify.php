<?php include_once "header.php" ?>

<div class="container">
    <?php
    include "connection.php";    
    if($_SESSION['role'] == 1){
        $link = $_SERVER['REQUEST_URI'];
            $key = "?";
            if(strpos($link, $key) == false){
                if(isset($_SESSION['new_userid']) && !empty($_SESSION['new_userid'])){
                    $sql = "SELECT * FROM studentdetails WHERE studentid = '{$_SESSION['new_userid']}'";
                    // unset($_SESSION['new_userid']);
                }else{
                    // echo "No data to show, please select the student first to modify there data.";
                    echo "<span class='text-3d'>404</span>";
                    echo "<span class='text'>No data to show, please select the student first to modify there data.</span>";
                    die();
                }               
            }else{
                $identity = explode("?",$link);
                $sql = "SELECT * FROM studentdetails WHERE studentid = '{$identity[1]}'";
            }
    }else{
        $sql = "SELECT * FROM studentdetails WHERE studentid = '{$_SESSION['userid']}'";
    }
    $_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($_result) > 0) {
        while ($rows = mysqli_fetch_assoc($_result)) {
    ?>
            <form class="form-container" action="edit.php" method="POST" enctype="multipart/form-data" name="myForm1" onsubmit="return  Validatemodfname() && Validatemodlname() && Validatemodfathername() && Validatemodmothername()">
                <div class="name">
                    <input type="text" name="modfname" id="test-input" value="<?php echo $rows['firstName']; ?>" placeholder="Name" autofocus onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                    <input type="text" name="modmname" id="" value="<?php echo $rows['middleName']; ?>" placeholder="Middle Name (if any)" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                    <input type="text" name="modlname" id="lname" value="<?php echo $rows['lastName']; ?>" placeholder="Last Name" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                </div>
                <input type="text" placeholder="College name" name="modcollegename" required value="<?php echo $rows['collegeName']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Enrollment number" name="modenrollment" value="<?php echo $rows['enrollmentNumber']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Roll number" name="modrollnumber" id="stu_roll" value="<?php echo $rows['rollNumber']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Aadhaar number" name="modaadhaar" id="stu_aadhaar" value="<?php echo $rows['aadhaarNumber']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <div class="name">
                    <div class="backlog">
                        <div class="backlog-container">
                            <div class="backlog-inner-container backlog-inner-container2">
                                <label for="">Course</label>
                                <select name="modcourse" id="" required>
                                    <option value='B.E.' <?php if ($rows['course'] == 'B.E.') {
                                                            echo "selected";
                                                        } ?>>B.E.</option>
                                    <option value='B.Tech' <?php if ($rows['course'] == 'B.Tech') {
                                                            echo "selected";
                                                        } ?>>B.Tech</option>
                                    <option value='M.Tech' <?php if ($rows['course'] == 'M.Tech') {
                                                            echo "selected";
                                                        } ?>>M.Tech</option>
                                    <option value='B.S.C' <?php if ($rows['course'] == 'B.S.C') {
                                                            echo "selected";
                                                        } ?>>B.S.C</option>
                                    <option value='M.S.C' <?php if ($rows['course'] == 'M.S.C') {
                                                            echo "selected";
                                                        } ?>>M.S.C</option>
                                    <option value='B.Com' <?php if ($rows['course'] == 'B.Com') {
                                                            echo "selected";
                                                        } ?>>B.Com</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="backlog">
                        <div class="backlog-container">
                            <div class="backlog-inner-container backlog-inner-container2">
                                <label for="">Branch</label>
                                <select name="modbranch" id="" required>
                                    <option value='CSE' <?php if ($rows['branch'] == 'CSE') {
                                                            echo "selected";
                                                        } ?>>CS</option>";
                                    <option value='IT' <?php if ($rows['branch'] == 'IT') {
                                                            echo "selected";
                                                        } ?>>IT</option>";
                                    <option value="Civil" <?php if ($rows['branch'] == 'Civil') {
                                                                echo "selected";
                                                            } ?>>Civil</option>
                                    <option value="Mechanical" <?php if ($rows['branch'] == 'Mechanical') {
                                                                    echo "selected";
                                                                } ?>>Mechanical</option>
                                    <option value="Electrical" <?php if ($rows['branch'] == 'Electrical') {
                                                                    echo "selected";
                                                                } ?>>Electrical</option>
                                    <option value="EEE" <?php if ($rows['branch'] == 'EEE') {
                                                            echo "selected";
                                                        } ?>>EEE</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="backlog">
                        <div class="backlog-container">
                            <div class="backlog-inner-container backlog-inner-container2">
                                <label for="">Semester</label>
                                <select name="modsemester" id="" required>
                                    <option value="1"<?php if ($rows['semester'] == '1') {
                                                            echo "selected";
                                                        } ?>>1</option>
                                    <option value="2"<?php if ($rows['semester'] == '2') {
                                                            echo "selected";
                                                        } ?>>2</option>
                                    <option value="3"<?php if ($rows['semester'] == '3') {
                                                            echo "selected";
                                                        } ?>>3</option>
                                    <option value="4"<?php if ($rows['semester'] == '4') {
                                                            echo "selected";
                                                        } ?>>4</option>
                                    <option value="5"<?php if ($rows['semester'] == '5') {
                                                            echo "selected";
                                                        } ?>>5</option>
                                    <option value="6"<?php if ($rows['semester'] == '6') {
                                                            echo "selected";
                                                        } ?>>6</option>
                                    <option value="7"<?php if ($rows['semester'] == '7') {
                                                            echo "selected";
                                                        } ?>>7</option>
                                    <option value="8"<?php if ($rows['semester'] == '8') {
                                                            echo "selected";
                                                        } ?>>8</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" placeholder="Father's name" id="father_name" name="modfathername" value="<?php echo $rows['fatherName']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Mother's name" id="mother_name "name="modmothername" value="<?php echo $rows['motherName']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="date" placeholder="Date of birth" name="moddob" value="<?php echo $rows['dob']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Temproary address " name="modtemproary_add" value="<?php echo $rows['temporaryAddress']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                <input type="text" placeholder="Permanent address " name="modpermanent_add" value="<?php echo $rows['permanentAddress']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="email" placeholder="Email address " name="modemail" value="<?php echo $rows['email']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Phone number " name="modstudentnumber" id="stu_num" value="<?php echo $rows['phoneNumber']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>
                <input type="text" placeholder="Father's phone number" name="modfathernumber" value="<?php echo $rows['fatherPhoneNo']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                <input type="text" placeholder="Mother's phone number" name="modmothernumber" value="<?php echo $rows['motherPhoneNo']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                <input type="text" placeholder="Recipt number" name="modreciptnumber" value="<?php echo $rows['recipt']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off required>

                <div class="backlog">
                    <div class="backlog-container">
                        <div class="backlog-inner-container">
                            <label for="">1<sup>st</sup> Semester Result</label>
                            <select name="modsem1" id="selsectOptions" onchange="GetSelectedTextValue(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['firstSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['firstSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['firstSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['firstSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['firstSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['firstSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['firstSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['firstSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input" placeholder="Your percentage..." name="mod1sem" value="<?php echo $rows['firstSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">2<sup>nd</sup> Semester Result</label>
                            <select name="modsem2" id="selsectOptions" onchange="GetSelectedTextValue2(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['secondSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['secondSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['secondSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['secondSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['secondSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['secondSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['secondSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['secondSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input1" placeholder="Your percentage..." name="mod2sem" value="<?php echo $rows['secondSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">3<sup>rd</sup> Semester Result</label>
                            <select name="modsem3" id="selsectOptions" onchange="GetSelectedTextValue3(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['thirdSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['thirdSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['thirdSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['thirdSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['thirdSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['thirdSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['thirdSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['thirdSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input2"placeholder="Your percentage..." name="mod3sem" value="<?php echo $rows['thirdSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">4<sup>th</sup> Semester Result</label>
                            <select name="modsem4" id="selsectOptions" onchange="GetSelectedTextValue4(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['fourthSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['fourthSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['fourthSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['fourthSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['fourthSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['fourthSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['fourthSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['fourthSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input3" placeholder="Your percentage..." name="mod4sem" value="<?php echo $rows['fourthSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">5<sup>th</sup> Semester Result</label>
                            <select name="modsem5" id="selsectOptions" onchange="GetSelectedTextValue5(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['fifthSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['fifthSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['fifthSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['fifthSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['fifthSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['fifthSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['fifthSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['fifthSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input4" placeholder="Your percentage..." name="mod5sem" value="<?php echo $rows['fifthSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">6<sup>th</sup> Semester Result</label>
                            <select name="modsem6" id="selsectOptions" onchange="GetSelectedTextValue6(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['sixthSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['sixthSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['sixthSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['sixthSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['sixthSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['sixthSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['sixthSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['sixthSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input5" placeholder="Your percentage..." name="mod6sem" value="<?php echo $rows['sixthSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">7<sup>th</sup> Semester Result</label>
                            <select name="modsem7" id="selsectOptions" onchange="GetSelectedTextValue7(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['seventhSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['seventhSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['seventhSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['seventhSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['seventhSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['seventhSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['seventhSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['seventhSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input6" placeholder="Your percentage..." name="mod7sem" value="<?php echo $rows['seventhSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                        <div class="backlog-inner-container">
                            <label for="">8<sup>th</sup> Semester Result</label>
                            <select name="modsem8" id="selsectOptions" onchange="GetSelectedTextValue8(this)">
                                <!-- <option value="" selected disabled hidden>Choose Here</option> -->
                                <option value="All Clear" <?php if ($rows['eighthSemester'] == 'All Clear') {
                                                            echo "selected";
                                                        } ?>>All Clear</option>
                                <option value="1 Backlog" <?php if ($rows['eighthSemester'] == '1 Backlog') {
                                                            echo "selected";
                                                        } ?>>1 Backlog</option>
                                <option value="2 Backlog" <?php if ($rows['eighthSemester'] == '2 Backlog') {
                                                            echo "selected";
                                                        } ?>>2 Backlog</option>
                                <option value="3 Backlog" <?php if ($rows['eighthSemester'] == '3 Backlog') {
                                                            echo "selected";
                                                        } ?>>3 Backlog</option>
                                <option value="4 Backlog" <?php if ($rows['eighthSemester'] == '4 Backlog') {
                                                            echo "selected";
                                                        } ?>>4 Backlog</option>
                                <option value="5 Backlog" <?php if ($rows['eighthSemester'] == '5 Backlog') {
                                                            echo "selected";
                                                        } ?>>5 Backlog</option>
                                <option value="6 Backlog" <?php if ($rows['eighthSemester'] == '6 Backlog') {
                                                            echo "selected";
                                                        } ?>>6 Backlog</option>
                                <option value="Not Appeared" <?php if ($rows['eighthSemester'] == 'Not Appeared') {
                                                            echo "selected";
                                                        } ?>>Not Appeared</option>
                            </select>
                            <input type="text" id="Input7" placeholder="Your percentage..." name="mod8sem" value="<?php echo $rows['eighthSemester']; ?>" onselectstart="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        </div>
                    </div>
                </div>
                <div class="file">
                    <ul class="wrapper">
                        <li>
                            <div class="lst-container">                                
                                <img src="images/<?php echo $rows['studentImage']; ?>" alt="Student Image" class="modify_img" width="150px" height="150px">
                                <label for="">Your photo (max size: 2mb)</label>
                                <input type="file" name="new_stu_photo">
                                <input type="hidden" name="old_stu_image" value="<?php echo $rows['studentImage']; ?>">
                            </div>
                        </li>
                        <li>
                            <div class="lst-container">                               
                                <img src="images/<?php echo $rows['feeRecipt']; ?>" alt="" class="modify_img" width="150px" height="150px">
                                <label for="">Your fee recipt (max size: 2mb)</label>
                                <input type="file" name="new_fee_recipt">
                                <input type="hidden" name="old_recipt_image" value="<?php echo $rows['feeRecipt']; ?>">
                            </div>
                        </li>

                        <li>
                            <div class="lst-container">                                
                                <img src="images/<?php echo $rows['studentSignature']; ?>" alt="" class="modify_img" width="150px" height="150px">
                                <label for="">Your signature (max size: 2mb)</label>
                                <input type="file" name="new_stu_signature">
                                <input type="hidden" name="old_signature_image" value="<?php echo $rows['studentSignature']; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
                <input type="submit" name="modify_btn" value="Save Changes" onclick="return phonenumber((document.myForm1.stu_num)) && rollnumber((document.myForm1.stu_roll)) && aadhaarnumber((document.myForm1.stu_aadhaar))">
                
            </form>
    <?php
        }
    } else {
        echo "<span class='text-3d'>404</span>";
                    echo "<span class='text'>No data to show, please fill the student form first to modify your data.</span>";
                    die();
    }
    ?>
</div>

<?php include_once "footer.php" ?>

<script src="javascript/optionSelect.js"></script>
<script src="javascript/caretPosition.js"></script>
<script src="javascript/modifyFormValidation.js"></script>


</body>

</html>