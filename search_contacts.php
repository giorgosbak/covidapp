<?php 

include 'connect.php';

session_start();

$myusername =$_SESSION['username'];


$select = "SELECT place_id,dt FROM presence WHERE username = '$myusername'";

$result = $conn->query($select);


$current_dt = date('y-m-d h:i:s');

$current_time = strtotime($current_dt);


echo "<table border ='1'>";

echo "<tr>";

echo "<th>";

echo "Place Name";

echo "</th>";

echo "<th>";

echo "Date and Time";

echo "</th>";

echo "</tr>";



while($row = $result->fetch_assoc())
	

	{
		
		$myplace = $row['place_id'];
		
				
		$place_time = strtotime($row['dt']);
		
		$diafora  = abs(round(($current_time - $place_time) / (60 * 60 * 24)));
		
		
		//an exei ginei check in tis teleytaies 7 imeres 
		if($diafora <=7)
		

        {
            $select2 = "SELECT username, dt FROM presence WHERE place_id = '$myplace' and username <>'$myusername'";
			
			
			$result2 =$conn->query($select2);
			
			//gia olous tous users pou ekanan checkin sto idio simeio
           while($row2 = $result2->fetch_assoc())
			   
			   {
				   
		   $contact_username = $row2['username'];		   
					
					
			$contact_time = strtotime($row2['dt']);
		
		    $diafora_ores = abs(round(($place_time - $contact_time) / (60 * 60 )));
			
			    
				//an vrikontan sto idio simeio me diafora + - 2 orwn 
				if($diafora_ores<=2)
					
					{
					
					 //prepei na elegxthei an einai krousma 
					 
					 $sql3 = "SELECT date_declared FROM declaration WHERE username ='$contact_username' ORDER BY date_declared DESC LIMIT 0,1";
					 
					 $result3 = $conn->query($sql3);
					 
					 $row3 = $result3->fetch_assoc();
					 
					 $date_declared = $row3['date_declared'];
					 
					 $krousma_time = strtotime($date_declared);
					 
					 $diafora_krousma  = abs(round(($current_time - $krousma_time) / (60 * 60 * 24)));

					
					if($diafora_krousma <=7)
						
					
					{
						$sql4 = "SELECT name FROM place WHERE id = '$myplace'";
						
						$result4 = $conn->query($sql4);
						
						$row4 = $result4->fetch_assoc();
						
						$place_name = $row4['name'];
						
						
						echo "<tr>";
						
						echo "<td>";
						
						echo $place_name;
						
						echo "</td>";
						
						echo "<td>";
						
						echo $row['dt'];
						
						echo "</td>";
						
						echo "</tr>";
						
						
					}
						
						
					}

				   
				   
			   }




        }			
		
		
	
		
		
	}


echo "</table>";


?>