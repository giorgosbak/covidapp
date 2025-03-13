<html>

<body>

 <?php

include 'valid_admin.php';

include 'connect.php';

include 'admin_menu.php';


$places_file =  $_FILES['placesfile']['name'];


//edo ginetai i fortsi tou arxeiou 
$string = file_get_contents($places_file);



$mod_date=date("Y-m-d H:i:s.", filemtime($places_file));

echo $mod_date;

echo "<br>";


//to metatrapei se json morfi
$places = json_decode($string, true);

//to string gia to insert
$sql = "INSERT INTO place VALUES";

$sql_pop = "INSERT INTO popularity VALUES";


//diatrexoume ton pinaka me ta places 
for($i=0;$i<count($places);$i++)

{
	
	$mystr ="";
	
	

//pairnoume tis plirofories pou xreiazomaste (id,name, address, type, lat, lng)
$id = $places[$i]['id'];


$name = $places[$i]['name'];


$address = $places[$i]['address'];


$type = $places[$i]['types'][0];


$lat = floatval($places[$i]['coordinates']['lat']);



$lng = floatval($places[$i]['coordinates']['lng']);


//vriskoume ean yparxei place me to idio id stin vasi 

 $place_exists = "SELECT COUNT(*) as plithos FROM place WHERE id = '$id'";
 
 $result_exists = $conn->query($place_exists);
 
 $row_exists = $result_exists->fetch_assoc();
 
 $total = $row_exists['plithos'];
 
 //an den yparxei tote ginetai insert stin vasi
 if ($total == 0)
	 
	 {


 //an den eimaste sto teleytaio stoixeio tou pinaka 
 if($i!=count($places) -1)
	 
	 {

//vazoume stin eggrafi komma( giati tha akolouthisei kai alli eggrafi)		 
		 
 $mystr="('$id','$name','$address','$type','$lat','$lng'),";
 
	 }
	 
	 //diaforetika den vazoume komma
	 else
		 
		 {
			
          $mystr="('$id','$name','$address','$type','$lat','$lng')";
			
			 
		 }

//ginetai i sinenosi gia na mpei kai ayti i eggrafi sto insert pou tha ekteletei
$sql = $sql.$mystr;

	 }

for($j=0;$j<7;$j++)
	

	{
		
		$day = $places[$i]['populartimes'][$j]['name'];
		
		
		$popularity = $places[$i]['populartimes'][$j]['data'];
		
		
		for($k=0;$k<24;$k++)
			
			{
				$my_str_pop = "";
				
			   $pop = $popularity[$k];
			   
			   
			   //psaxnoume na vroume ean prepei na ginei i eggrafi insert i update
			   
			   
			   $sql_mod = "SELECT last_modified FROM popularity WHERE id = '$id' and day = '$day' and hour = '$k'";
			   
			   $result_mod = $conn->query($sql_mod);
			   
			   
			   
			   //ean den yparxei eggrafi gia to popularity, tote prepei na ginei insert
			   if ($result_mod->num_rows ==0)
				   
				   {
			   
			   if($i==count($places) -1 && $j==6 && $k ==23)
				   
				   {
			   
			   $my_str_pop ="('$id','$day','$k','$pop','$mod_date')";
			   
				   }
				   
				else
					
					{
					 
					 $my_str_pop ="('$id','$day','$k','$pop','$mod_date'),";

						
					}
             
			 $sql_pop = $sql_pop.$my_str_pop;
				
			}
			
			//an yparxei eggrafi, tha prepei na elegksoume to last_modified gia na doume an prepei 
			
			//na ginei to update i oxi 
			else
				
			
			{
			  $row_mod = $result_mod->fetch_assoc();
			   
			  $last = $row_mod['last_modified'];
			  
			  if ($mod_date > $last)
				  
				  {
					  $sql_update = "UPDATE popularity SET last_modified = '$mod_date' WHERE id = '$id' and day = '$day' and hour = '$k'";
					  
					  $conn->query($sql_update);
					  
				  }
			  
				
			
			}
		
		
	}



}

}

$conn->query($sql);
	 	 
	 
$conn->query($sql_pop);
	 
 
echo "<br><br>";


echo "Upload was completed successfully";
 



?>

<br><br>

<a href = "manage_data.php"> Go Back to Manage Data </a>

</body>

</html>