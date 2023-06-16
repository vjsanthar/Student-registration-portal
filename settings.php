<?php
include "header.php";
if(isset($_POST['update-btn'])){

    $oldPassword = md5($_POST['password']);
    


if($_SESSION['role'] == 0){
    $sql = "SELECT sruserid from studentregistration WHERE sruserid = '{$_POST['oldUserId']}' AND srpassword = '{$oldPassword}'";
}else{
    $sql = "SELECT truserid from teacherregistration WHERE truserid = '{$_POST['oldUserId']}' AND trpassword = '{$oldPassword}'";
}
$result = mysqli_query($conn,$sql) or die("Query Failed");

print_r(mysqli_num_rows($result));
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    if($_SESSION['role'] == 0){
        $sql1 = "UPDATE studentregistration SET sruserid = '{$_POST['newUserId']}' WHERE sruserid = '{$_POST['oldUserId']}'";
    }else{
       $sql1 = "UPDATE teacherregistration SET truserid = '{$_POST['newUserId']}' WHERE truserid = '{$_POST['oldUserId']}'";
    }
}else{
    echo "<script>alert('Wrong Credentials');</alert>";
}

$result1 = mysqli_query($conn,$sql1);
echo "<script>alert('Sucessfull');</script>";
}

?>
<div class="setting_container">
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
<ul id="wrapper">
    <li>
    <label for="">Old userid</label>
    <input type="text" name="oldUserId">
    </li>
    <li><label for="">New userid</label>
    <input type="text" name="newUserId">
    </li>
    <li><label for="">Password</label>
    <input type="password" name="password">
    </li>
    <li>
        <input type="submit" value="Update" name="update-btn">
    </li>
</ul>
</form>
</div>
<?php
include "footer.php";
?>