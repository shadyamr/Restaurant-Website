<?php
    session_start();
    require "components/main/connect.php";
    require "components/main/functions.php";

    $userAcc = new User();
    $user = $userAcc->getUserData($_SESSION["email"]);
?>

<?php
if ($user["Role"] == 1)
{
    header("location: cp/waiter");
}
else if ($user["Role"] == 2)
{
    header("location: cp/qc");
}
else
{
    header("location: home");
}
?>