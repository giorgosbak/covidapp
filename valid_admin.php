<?php


session_start();

if($_SESSION["admin"]!=1)
	
	{
		
		header("Location: admin_login.php");
		
		
	}



?>