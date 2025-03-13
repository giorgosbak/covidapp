<?php

session_start();

include 'connect.php';

$myusername = $_SESSION['username'];

$id = $_POST['place_id'];

$pop = $_POST['user_pop'];

$insert = "INSERT INTO presence VALUES ('$myusername','$id',NOW(), '$pop')";


if($conn->query($insert)===TRUE)
	
	{
		echo "You checked in this Place!!";
		
		
	}
	
 
 else 
	 
 
 {
	 echo "Error in making check in!";
	 
	 
 }






?>