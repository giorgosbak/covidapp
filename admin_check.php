<html>



<body>

<?php

session_start();

include 'connect.php';


$uname = $_POST["username"];

$pass =$_POST["password"];


$sql = "SELECT COUNT(*) as total FROM admin WHERE username = '$uname' and password = '$pass'";


$result = $conn->query($sql);

//ginetai prokomisi tou apotelesmatos sisxetismeno apo tin vasi
$row = $result->fetch_assoc();

$total = $row['total'];

//an o admin einai egkyros
if($total>0)
	
	{
		$_SESSION["admin"] = 1;
		
		//ginetai redirect sto admin_index.php
        header("Location: admin_index.php");
		
		
	}


else
	
	{
		//ginetai redirect sto admin_login.php
		
		        header("Location: admin_login.php");

		
		
	}


?>


</body>


</html>