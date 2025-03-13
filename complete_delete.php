<html>

<body>


 <?php

include 'valid_admin.php';

include 'admin_menu.php';

include 'connect.php';

$del_choice = $_POST["del_choice"];


if($del_choice =="popularity")
	
	{
		
		$sql = "DELETE from popularity";
		
		if ($conn->query($sql) ===TRUE)
			
			{
				echo "Popularity data deleted!!";
				
			}
		
		
		
		
		
	}
	
 elseif ($del_choice =="all")
 
 
	{
		
        $sql = "DELETE from popularity";
		
		if ($conn->query($sql) ===TRUE)
			
			{
				echo "Popularity data deleted!!";
				
				echo "<br>";
				
			}	


        $sql = "DELETE from place";
		
		if ($conn->query($sql) ===TRUE)
			
			{
				echo "Places data deleted!!";
				
			}			
	 
	 
	 
	}




?>


</body>



</html>