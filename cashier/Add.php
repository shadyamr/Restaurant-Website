<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab07";


$conn = new mysqli($servername, $username, $password, $dbname);

$emailError="";

if(isset($_POST['Submit'])){  
	 
    $email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);
    if ($email == true) {
    
      } else {
        echo("$email is not a valid email address");
      }
     if( strlen($_POST["Password"])<6)
     {
        echo("Password Not valid");
     }
  
 

if (filter_var($_POST["Age"], FILTER_VALIDATE_INT) ==true) {
 
} else {
  echo("Integer is not valid");
}
 
        
		$sql="insert into user(First Name,Email,Password,Age) values(".$_POST['Name']."','".$_POST["Email"]."','".$_POST["Password"]."',,'".$_POST["Age"]."')";
	 	$result=mysqli_query($conn,$sql);
		 
 
}
?>
<?php include "menu.php";?>

 
<form action="" method="post">
  Name:<br>
  <input type="text" name="Name"><br> 
  Email:<br>
  <input type="text" name="Email"> <br> 
  Password:<br>
  <input type="Password" name="Password"><br>
  Age:<br>
  <input type="Password" name="Age"><br>
  <input type="submit" value="Submit" name="Submit">
 
</form>
