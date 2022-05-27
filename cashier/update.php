<?php
 include "Menu.php";
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "restaurant";
 session_start();
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_POST['submit'])) {
    $sql="UPDATE user set First Name='" . $_POST['first_name'] . "',Email='" . $_POST['email'] . "',Age='" . $_POST['age'] . "' WHERE Id='" .  $_GET['userid'] . "'";
 
    mysqli_query($conn,$sql);
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM user WHERE Id='" . $_GET['userid'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update Employee Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
 
</div>

First Name: <br>
<input type="text" name="first_name" class="txtField" value="<?php echo $row['First Name']; ?>">
<br>
 
Email:<br>
<input type="text" name="email" class="txtField" value="<?php echo $row['Email']; ?>">
<br>

Password: <br>
 
<input type="text" name="age"  value="<?php echo $row['Password']; ?>">
<br>
<input type="submit" name="submit" value="Submit" class="buttom">
</form>
</body>
</html>
