<?php include_once "header.php";

if (
    isset($_SERVER['HTTPS']) &&
    $_SERVER['HTTPS'] === 'on'
)
    $link = "https";
else
    $link = "http";

$link .= "://";
$link .= $_SERVER['HTTP_HOST'];
$link .= $_SERVER['PHP_SELF'];
$invite_link = explode('activity.php', $link);
$token = $_SESSION['id'];
$cipher_method = 'aes-128-ctr';
$enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
$enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
$crypted_token = openssl_encrypt($token, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
unset($token, $cipher_method, $enc_key, $enc_iv);
?>

<div id="activity-container">
    <div class="sub-container2">
        <div class="link-container">
            <label for="">Invitation link:</label>
            <?php
            if (!isset($_POST['generate-btn'])) {
                echo "<input type='text' name='input_field' id='myInput' value=''>";
            } else {
                echo "<input type='text' name='input_field' id='myInput' value='$invite_link[0]login.php?id=$crypted_token'>";
            }
            ?>
        </div>
        <div class="btn-container">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="submit" name="generate-btn" value="Generate Invite link">
            </form>
            <input type="button" value="Copy Invite link" onclick="myFunction()">
        </div>
    </div>

    <div class="sub-container1">
        <div class="select-container">

            <form class="sort-form" action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                <ul>
                    <li>
                        <label for="">Sort Record:</label>
                        <select name="sortselect" id="">
                            <option value="All_Records">All Records</option>
                            <option value="All_Clear">All Clear</option>
                            <option value="Backlog">Backlog</option>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Show Record" name="sort-btn">
                    </li>
                </ul>
            </form>
        </div>
        <!-- <div class="export"> -->
        <form class="export-form" action="download.php?<?php echo $_POST['sortselect']; ?>" method="POST">
            <!-- <ul class="exp"> -->
            <!-- <li> -->
            <input type="submit" class="export-btn" value="Export" name="export-btn">
            <!-- </li> -->
            </ul>

        </form>
        <!-- </div> -->
    </div>
</div>
</div>

<div id="main-content">
    <h2>All Records</h2>
    <?php
    include "connection.php";
    $limit = 3;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }    
    $offset = ($page - 1) * $limit;
    if (isset($_POST['sort-btn'])) {
        if ($_POST['sortselect'] == "All_Clear") {
            $sql = "SELECT studentid, firstName, middleName, lastName, rollNumber, branch, semester, phoneNumber from studentdetails where (teacherid = '{$_SESSION['id']}') AND 
            (firstSemester NOT LIKE '__Back%') AND (secondSemester NOT LIKE '__Back%') AND
            (thirdSemester NOT LIKE '__Back%') AND (fourthSemester NOT LIKE '__Back%') AND
            (fifthSemester NOT LIKE '__Back%') AND (sixthSemester NOT LIKE '_Back%') AND
            (seventhSemester NOT LIKE '__Back%') AND (eighthSemester NOT LIKE '__Back%') LIMIT {$offset}, {$limit}";
        } elseif ($_POST['sortselect'] == "Backlog") {
            $sql = "SELECT studentid, firstName, middleName, lastName, rollNumber, branch, semester, phoneNumber from studentdetails where (teacherid = '{$_SESSION['id']}') AND 
            (firstSemester LIKE '__Back%' OR secondSemester LIKE '__Back%' OR
            thirdSemester LIKE '__Back%' OR fourthSemester LIKE '__Back%' OR
            fifthSemester LIKE '__Back%' OR sixthSemester LIKE 'Back%'OR
            seventhSemester LIKE '__Back%' OR eighthSemester LIKE '__Back%') LIMIT {$offset}, {$limit}";
        } else {
            $sql = "SELECT studentid, firstName, middleName, lastName, rollNumber, branch, semester, phoneNumber  FROM studentdetails WHERE teacherid = '{$_SESSION['id']}' LIMIT {$offset}, {$limit}";
        }
    } else {
        $sql = "SELECT studentid, firstName, middleName, lastName, rollNumber, branch, semester, phoneNumber  FROM studentdetails WHERE teacherid = '{$_SESSION['id']}' LIMIT {$offset}, {$limit}";
    }

    // $sql = "SELECT studentid, firstName, middleName, lastName, rollNumber, branch, semester, phoneNumber  FROM studentdetails WHERE teacherid = '{$_SESSION['userid']}'";
    $_result = mysqli_query($conn, $sql) or die("Query failed");
    if (mysqli_num_rows($_result)) {
    ?>
        <table>
            <thead>
                <th>Roll no.</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Semester</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($_result)) { ?>
                    <tr>
                        <td><?php echo $row['rollNumber']; ?></td>
                        <td><?php echo $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName']; ?></td>
                        <td><?php echo $row['branch']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['phoneNumber']; ?></td>
                        <td>
                            <div class="activity">
                                <form action="" method="POST" class="myForm" id="myForm">
                                    <input type="submit" class="btn btn1" value="View" onclick='this.form.action="dashboard.php?<?php echo $row['studentid']; ?>";' name="view-btn">
                                    <input type="submit" class="btn btn2" value="Edit" onclick='this.form.action="modify.php?<?php echo $row['studentid']; ?>";' name="edit-btn">
                                    <input type="submit" class="btn btn3" value="Delete" name="delete-btn" onclick='this.form.action="delete.php?<?php echo $row['studentid']; ?>";'>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } 
    $sql2 = "SELECT * from studentdetails where teacherid = '{$_SESSION['id']}'";
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result2) > 0){
        $total_records = mysqli_num_rows($result2);
       
        $total_pages = ceil($total_records / $limit);
        echo '<div class="pagination">';
        if($page > 1){
            echo '<a href="delete.php?page='.($page - 1).'">&laquo;</a>';
        }
        
        for($i = 1; $i <= $total_pages; $i++){
            if($i == $page){
                $active = "";
            }else{
                $active = "active";
            }
            echo '<a href="delete.php?page='.$i.'" class="active'.$active.'">'.$i.'</a>';
        }
        if($total_pages > $page){
            echo '<a href="delete.php?page='.($page + 1).'">&raquo;</a>';
        }
        
    }
    ?>
    </div>
</div>
<?php include_once "footer.php" ?>
<script src="javascript/copyFunction.js"></script>
</body>

</html>