<style>
table, th, td {
  border: 1px solid black;
}

</style>
<?php
 include "Menu.php";
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "restaurant";
 session_start();
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 $query = "SELECT * FROM users";
 $result = mysqli_query($conn,$query);
 
?>
<!DOCTYPE html>
<html>
<head>  
</head>
<body>
<table>
<tr>
<td>First Name</td>
<td>Last Name</td>
<td>Username</td>
<td>Email</td>
<td>Password</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
 
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
	<td><?= $row['FirstName']; ?></td>
	<td><?= $row['LastName']; ?></td>
	<td><?= $row['Username']; ?></td>
	<td><?= $row['Email']; ?></td>
	<td><?= $row['Pass']; ?></td>
<td><a href="UpdateAction.php?userid=<?php echo $row["ID"]; ?>">Update</a></td>
</tr>
<?php
$i++;
}
?>
</table>
</body>
</html>