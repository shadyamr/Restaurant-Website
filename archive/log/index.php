<?php
include 'includes.php';
if($_SERVER['REQUEST_METHOD']==="POST")
{
    $number=$_POST['number'];
    if($number!=5)
    {
        $log="User entered an incorrect number($number)";
        logger($log);
        echo"$number is incorrect";
    }
    else
    {
        echo"$number is correct";
    }
}
?>
<form method="POST">
    <input type="TEXT" name="number" />
    <input type="SUBMIT"/>
</form>
