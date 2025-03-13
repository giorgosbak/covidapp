<?php



function distance($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;

      return ($miles * 1609.344);

}



include 'connect.php';

include 'valid_user.php';


$sql = "SELECT id, lat,lng FROM place";

$result = $conn->query($sql);

$places = array();

$current_day  = date("l");

$current_hour = date("H") + 1;

$user_lat = $_POST['user_lat'];

$user_lng = $_POST['user_lng'];




while($row = $result->fetch_assoc())
	
	{
		$place_id = $row['id'];
		
		$sql1 = "SELECT pop FROM popularity WHERE id = '$place_id' AND day = '$current_day' AND hour = '$current_hour'";
		
		$result1 =$conn->query($sql1);
		
		$row1 = $result1->fetch_assoc();
		
		$pop1 = $row1['pop'];
		
	    
		//gia tin epomeni ora 
		
		$sql2 = "SELECT pop FROM popularity WHERE id = '$place_id' AND day = '$current_day' AND hour = '$current_hour'+1";
		
		$result2 =$conn->query($sql2);
		
		$row2 = $result2->fetch_assoc();
		
		$pop2 = $row2['pop'];
		
	    
		//gia tin methepomeni ora
		
		$sql3 = "SELECT pop FROM popularity WHERE id = '$place_id' AND day = '$current_day' AND hour = '$current_hour'+2";
		
		$result3 =$conn->query($sql3);
		
		$row3 = $result3->fetch_assoc();
		
		$pop3 = $row3['pop'];
		
		
		  $place = array();
		  
		  array_push($place, floatval($row['lat']));
		  
		  array_push($place, floatval($row['lng']));
		  
		  array_push($place, intval($pop1));
		  
		  array_push($place, intval($pop2));
		  
		  array_push($place, intval($pop3));
		  
		  $apostasi = distance($user_lat, $user_lng, $row['lat'], $row['lng']);
		  
		  
		  array_push($place, intval($apostasi));
		  
		  array_push($place, $place_id);
		  
		  $sql_avg = "SELECT AVG(pop) as average FROM presence WHERE place_id = '$place_id'";
		  
		  $result_avg = $conn->query($sql_avg);
		  
		  $row_avg = $result_avg->fetch_assoc();
		  
		  $average = $row_avg['average'];

          array_push($place, $average);
		  
		  array_push($places,$place);
		
		
	}

  echo json_encode($places);

?>