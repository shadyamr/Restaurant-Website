<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM breadstock";
$result = mysqli_query($conn, $sql);
?>
<form method="POST" action=>
<select>
<option value="" disabled="" selected="">Select Bread!</option>
<?php  
while($bread = mysqli_fetch_array($result))
{
?>
        <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName']." - ".$bread["BreadPrice"]; ?></option>
        <?php
    }?>  
</select>
<button name="submit" type="submit">Submit</button>
<?php
$testsubmit = $_POST['submit'];
echo $testsubmit;
$test2 = "INSERT INTO somposedsandwich(ChoosenBread) VALUES(".$_POST['submit'].")";
?>
</form>
<br>
<br>
<?php
$sql1 = "SELECT * FROM componentstock";
$result1 = mysqli_query($conn, $sql1);
?>

<select>
<option value="" disabled="" selected="">Select Your First Component!</option>
<?php  
while($vegetable1 = mysqli_fetch_array($result1))
{
?>
        <option value="<?php echo $vegetable1['VegetableName']; ?>"><?php echo $vegetable1['VegetableName']." - ".$vegetable1["VegetablePrice"]; ?></option>
        <?php
    }?></select>
<br>
<br>
<?php
$sql2 = "SELECT * FROM componentstock";
$result2 = mysqli_query($conn, $sql2);
?>

<select>
<option value="" disabled="" selected="">Select Your Second Component!</option>
<?php  
while($vegetable2 = mysqli_fetch_array($result2))
{
?>
        <option value="<?php echo $vegetable2['VegetableName']; ?>"><?php echo $vegetable2['VegetableName']." - ".$vegetable2["VegetablePrice"]; ?></option>
        <?php
    }?></select>
<br>
<br>
<?php
$sql3 = "SELECT * FROM MainStock";
$result3 = mysqli_query($conn, $sql3);
?>

<select>
<option value="" disabled="" selected="">Select Your Main Component!</option>
<?php  
while($main = mysqli_fetch_array($result3))
{
?>
        <option value="<?php echo $main['MainName']; ?>"><?php echo $main['MainName']." - ".$main["MainPrice"]; ?></option>
        <?php
    }?></select>
<br>
<br>
<?php
$sql4 = "SELECT * FROM SauceStock";
$result4 = mysqli_query($conn, $sql4);
?>

<select>
<option value="" disabled="" selected="">Select Your Side Sauce!</option>
<?php  
while($sauce = mysqli_fetch_array($result4))
{
?>
        <option value="<?php echo $sauce['SauceName']; ?>"><?php echo $sauce['SauceName']." - ".$sauce["SaucePrice"]; ?></option>
        <?php
    }?></select>

<?php
if(isset($_POST['BreadName']))
{
    $bread = $_POST['BreadName'];

    $query = "INSERT INTO `somposesandwich`(`ChoosenBread`,`ChoosenComponent1`,`ChoosenComponent2`,`ChoosenMain`,`ChoosenSauce`) VALUES ('$bread','$vegetable1','$vegetable2','$main','$sauce')";
    $query_run = mysqli_query($conn,$query);

    if($result5)
    {
        echo '<script type = "text/javascript"> alert("Data Saved") </script> ';
    }
    else
    {
        echo '<script type = "text/javascript"> alert("Data Not Saved") </script> ';
    }
}
?>
