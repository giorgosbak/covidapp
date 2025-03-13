<html>



<body>

<?php

session_start();

include 'connect.php';


$uname = $_POST["username"];

$pass =$_POST["password"];


$sql = "SELECT COUNT(*) as total FROM user WHERE username = '$uname' and password = '$pass'";


$result = $conn->query($sql);

//ginetai prokomisi tou apotelesmatos sisxetismeno apo tin vasi
$row = $result->fetch_assoc();

$total = $row['total'];

//an o user einai egkyros
if($total>0)
	
	{
		//arxikopoiw mia session metavliti pou dilonei oti prokeitai gia egkyro user
		
		$_SESSION["user"] = 1;
		
		$_SESSION["username"] = $uname;
		
		//ginetai redirect sto user_index.php
        header("Location: user_index.php");
		
		
	}


else
	
	{
		//ginetai redirect sto user_login.php
		
		        header("Location: user_login.php");

		
		
	}


?>


</body>


</html>