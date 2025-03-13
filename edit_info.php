<html>

<head>

<link rel="stylesheet" href="mystyle.css">


</head>

<body>


<?php

include 'valid_user.php';

include 'user_menu.php';

include 'connect.php';

$nusername = $_POST["username"];

$npassword = $_POST["password"];

$old_username = $_SESSION["username"];


$sql = "UPDATE user SET username = '$nusername', password = '$npassword' WHERE username ='$old_username'";

if($conn->query($sql)===TRUE)
	
	{
		$_SESSION["username"] = $nusername;
		
		echo "Update was completed";
		
	}

else
	
	{
		echo "Error in Updating Profile";
		
	}



?>


</body>

</html>