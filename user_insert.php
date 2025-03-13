<html>


<body>


<?php

include 'connect.php';

$uname = $_POST["username"];

$pass = $_POST["password"];

$email = $_POST["email"];

$sql = "INSERT INTO user VALUES('$uname','$pass', '$email')";

if($conn->query($sql)===TRUE)
	
	{
		echo "You registered with success!!!!";
		
		echo "<br><br>";
		
		echo "<a href='user_login.php'> Go to Login Page </a>";
		
		
	}
	
  else


  {
     echo "Error in registration";
	 
	 
	 echo "<br><br>";

     
     echo "<a href='user_register.php'> Go to Registration Page </a>";

  }	  



?>

</body>

</html>