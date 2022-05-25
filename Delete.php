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
$dbname = "lab07";
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT * FROM user";
$result = mysqli_query($conn,$query);
if(isset($_POST['save'])){
	$checkbox = $_POST['check'];
	for($i=0;$i<count($checkbox);$i++){
    $del_id = $checkbox[$i]; 
    $sql="DELETE FROM user WHERE Id='".$del_id."'";
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

	<th> Id</th>
	<th>First Name</th>
	<th>Email</th>
	<th>Age</th>
    <th>Delete </th>
	 
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
    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["Id"]; ?>"></td>
	 
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