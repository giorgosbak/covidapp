<html>

<body>

<?php

include 'valid_user.php';

include 'user_menu.php';

include 'connect.php';


$declared = $_POST["imerominia"];

$myuser =$_SESSION['username'];

$sql ="SELECT date_declared FROM declaration WHERE username ='$myuser'";

$result = $conn->query($sql);


$declared_time = strtotime($declared);


$current = date("Y-m-d");
		 
		 
$current_time = strtotime($current);
		 
$dif = $current_time - $declared_time;
		 
$dif_days = $dif/(60*60*24);


 //an den exei ksanadilosei pote oti einai krousma
 if($result->num_rows==0)
	 
	 {
		 
		 
		 //exei dosei mellontiki imerominia
		 if($dif_days < 0)
			 
			 {
				 
				 echo "You are not allowed to insert date > current";
				 
			 }
			 
		 //exei dosei palia megaliteri twn 14 imerwn

         elseif($dif_days>14)

		 {
            
             echo "You cannot be declared as a covid case (14 days from now)";

         }		

		 
           else 


           {
               $sql2 = "INSERT INTO declaration VALUES ('$myuser','$declared')";
			   
			   if ($conn->query($sql2) === TRUE)
				   
				   {
					   
					   echo "You have been declared as a covid case";
					   
				   }

			   
		   }		 
		 
		 
	 }
	 
	 
	 
	 else
		 
	 
	 {
		 $row = $result->fetch_assoc();
		 
		 $date_in_db = $row['date_declared'];
		 
		 $date_in_db_time = strtotime($date_in_db);
		 
		 $dif_db = $declared_time - $date_in_db_time;
		 
		 $dif_days_db = $dif_db/ (60*60*24);
		 
		 if($dif_days_db <=14)
			 
			 {
				 
				 echo "You have already been declared as covid case (14 days interval)";
				 
				 
				 
				 
			 }
			 
		 else
			 
			 {
				 if($dif_days < 0)
			 
			 {
				 
				 echo "You are not allowed to insert date > current";
				 
			 }
			 
		 //exei dosei palia megaliteri twn 14 imerwn

         elseif($dif_days>14)

		 {
            
             echo "You cannot be declared as a covid case (14 days from now)";

         }		
				 	 
				 
				 else 
					 
					 {
				 
				 $sql3 = "UPDATE declaration SET date_declared = '$declared' WHERE username = '$myuser'";
				 
				 if($conn->query($sql3)===TRUE)
					 
					 {
						 echo "Date of declaration updated!";
						 
					 }
					 
					 }
				 
				 
			 }
		 
		 
	 }



?>




</body>

</html>