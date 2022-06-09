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
    if(in_array($fileActualExt, $allowed)){
    if($fileError === 0) // check for file error uploads
    {
        if($fileSize < 1000000){
        $fileNewName = uniqid('',true).".".$fileActualExt //Gives the file a unique ID so nothing gets replaced.
        $fileDestination = 'file/'.$fileNewName;
        move_uploaded_file($fileTmpName,$fileDestination); //Moves the file from its temporary location to our file destination.
        } else {
            echo "Your file is too big!";
        }
    } else{
        echo "There was an error uploading this file, please try again!";
    }
    } else {
        echo "ERROR! This type of file is not allowed!";
    }
}
?>   
