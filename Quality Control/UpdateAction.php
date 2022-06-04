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
    $sql="UPDATE users set FirstName='" . $_POST['first_name'] . "',Email='" . $_POST['email'] . "',Username='" . $_POST['Username'] . "',LastName='". $_POST['LastName'] . "',Pass='". $_POST['password'] ."' WHERE ID='" .  $_GET['userid'] ;
 
    mysqli_query($conn,$sql);
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM users WHERE ID='" . $_GET['userid'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update Users Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
 
</div>

First Name: <br>
<input type="text" name="first_name" class="txtField" value="<?php echo $row['FirstName']; ?>">
<br>
 
Last Name:<br>
<input type="text" name="LastName" class="txtField" value="<?php echo $row['LastName']; ?>">
<br>

Username: <br>
<input type="text" name="Username" class="txtField" value="<?php echo $row['Username']; ?>">
<br>
 
Email: <br>
<input type="text" name="email" class="txtField" value="<?php echo $row['Email']; ?>">
<br>

Password: <br>
<input type="text" name="password" class="txtField" value="<?php echo $row['Pass']; ?>">
<br>


<input type="submit" name="submit" value="Submit" class="buttom">
</form>
</body>
</html>