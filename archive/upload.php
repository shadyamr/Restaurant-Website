<?php
if (isset($_POST['submit'])){
    $file = $_FILES['national_id'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName); //Breaks the string so we can get the file extention e.g: png, pdf, etc
    $fileActualExt = strtolower(end($fileExt)); //converts the file type to lower case letters.
    
    $allowed = array('jpeg','jpg','png','pdf');
?>
