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
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT * FROM users";
$result = mysqli_query($conn,$query);
if(isset($_POST['save'])){
	$checkbox = $_POST['check'];
	for($i=0;$i<count($checkbox);$i++){
    $del_id = $checkbox[$i]; 
    $sql="DELETE FROM users WHERE ID='".$del_id."'";
	mysqli_query($conn,$sql);
    $message = "Data deleted successfully !";
    echo ($message);
}
}
?>
<html>
<form method="post" action="">
<table class="table table-bordered">
<thead>
<tr>
	<th>ID</th>
	<th>Username</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Role</th>
	<th>Email</th>
</tr>
</thead>
<?php
while($row = mysqli_fetch_array($result)) 
{
?>
<tr>
	<td><?= $row['ID']; ?></td>
	<td><?= $row['Username']; ?></td>
	<td><?= $row['FirstName']; ?></td>
	<td><?= $row['LastName']; ?></td>
	<td><?= $row['Role']; ?></td>
	<td><?= $row['Email']; ?></td>
    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["ID"]; ?>"></td>
	 
</tr>
<?php
 
}
?>
</table>
<p><button type="submit" class="btn btn-success" name="save">DELETE</button></p>
</form>

</body>
</html>
</html>