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

if(isset($_POST['save'])){
    $sql="SELECT * from user WHERE Email='".$_POST['old']."'";
    $result = mysqli_query($conn,$sql);

    echo"<table >

    <tr>
    
        <th> Id</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Age</th>
      
         
    </tr>";
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

}
?>
<html>
<form method="post" action="">
Email Mail:
<input type="text" name="old">
 
<p><button type="submit" class="btn btn-success" name="save">Search</button></p>

</html>
