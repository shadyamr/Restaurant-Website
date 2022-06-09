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
$query = "SELECT * FROM user";
$result = mysqli_query($conn,$query);
 

?>
<html>
<form method="post" action="">
<table class="table table-bordered">
<thead>
<tr>

	<th> Id</th>
	<th>First Name</th>
	<th>Email</th>
	<th>Age</th>
  
	 
</tr>
</thead>
<?php
 
while($row = mysqli_fetch_array($result)) 
{
    
?>
<tr>
  
	<td><?= $row['Id']; ?></td>
	<td><?= $row['First Name']; ?></td>
	<td><?=  $row['Email']; ?></td>
	<td><?= $row['Age']; ?></td>
  
	 
</tr>
<?php
 
}
?>
</table>
 
</form>

</body>
</html>
</html>
