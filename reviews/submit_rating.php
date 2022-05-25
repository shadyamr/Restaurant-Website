<?php

$conn = new PDO("mysql:host=localhost;dbname=review_table", "root", "");

if(isset($_POST["rating_data"]))
{

	$data = array(
		':user_name'    =>	$_POST["user_name"],
		':user_rating'  =>  $_POST["rating_data"],
		':user_review'  =>  $_POST["user_review"],
		':datetime'	    =>  time()
	);

	$query = "INSERT INTO review_table 
	(user_name, user_rating, user_review, datetime) 
	VALUES (:user_name, :user_rating, :user_review, :datetime)
	";

	$stat = $conn->prepare($query);

	$stat->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}
?>
