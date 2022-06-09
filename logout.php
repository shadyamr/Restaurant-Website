<?php
    require 'components/main/functions.php';
    session_start();
    $logout = new Logout();
    $logout->logout();
?>