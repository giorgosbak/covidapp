<?php


include 'connect.php';


$sql = "SELECT COUNT(*) as plithos FROM declaration";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$num_cases = $row['plithos'];

echo "<br>";

echo "<table border ='1'>";

echo "<tr>";

echo "<th>";

echo "Number Of Cases";

echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $num_cases;

echo "</td>";

echo "</tr>";


echo "</table>";

//////////////////////////////////////////////


$sql = "SELECT COUNT(*) as plithos FROM presence";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$num_checkins = $row['plithos'];

echo "<br>";

echo "<table border ='1'>";

echo "<tr>";

echo "<th>";

echo "Number Of Check -  Ins";

echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $num_checkins;

echo "</td>";

echo "</tr>";


echo "</table>";

//////////////////////////////////////////////////////////


$sql = "SELECT presence.dt as pdt, declaration.date_declared  ddt FROM declaration INNER JOIN presence ON declaration.username = presence.username";


$result  = $conn->query($sql);

$counter = 0;

while($row  = $result->fetch_assoc())
	
	{
	   $covid_time = strtotime($row['ddt']);
	   
	   $presence_time = strtotime($row['pdt']);
	   
	   $diafora  = round(($presence_time - $covid_time) / (60 * 60 * 24));

	   
		
		if($diafora >= -7 && $diafora <=14)
			
		
		{
			
			$counter++;
			
		}
		
		
		
	}

echo "<br>";
echo "<br>";
echo "<table border ='1'>";

echo "<tr>";

echo "<th>";

echo "Number Of Vistis of Active Cases";
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $counter;

echo "</td>";

echo "</tr>";


echo "</table>";

///////////////////////////////////////////////////////////////////

$sql = "SELECT place.type as ptype, COUNT(*) as plithos FROM place inner JOIN presence ON place.id = presence.place_id GROUP BY place.type ORDER BY COUNT(*) DESC";

$result = $conn->query($sql);

echo "<br>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
echo "Place Type";

echo "</th>";

echo "<th>";
echo "Number Of Check Ins";

echo "</th>";

echo "</tr>";

while($row = $result->fetch_assoc())
	

	{
		
		echo "<tr>";
		
		echo "<td>";
		
		echo $row['ptype'];
		
		echo "</td>";
		
		echo "<td>";
		
		echo $row['plithos'];
		
		echo "</td>";
		
		echo "</tr>";
		
		
		
	}


echo "</table>";


$sql = "SELECT place.type as ptype, COUNT(*) as plithos FROM place inner JOIN presence ON place.id = presence.place_id INNER JOIN declaration ON declaration.username = presence.username WHERE DATEDIFF(presence.dt,declaration.date_declared) >=-7 AND DATEDIFF(presence.dt,declaration.date_declared)<=14 GROUP BY place.type ORDER BY COUNT(*) DESC";


$result = $conn->query($sql);

echo "<br>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
echo "Place Type";

echo "</th>";

echo "<th>";
echo "Number Of Active Cases";

echo "</th>";

echo "</tr>";

while($row = $result->fetch_assoc())
	

	{
		
		echo "<tr>";
		
		echo "<td>";
		
		echo $row['ptype'];
		
		echo "</td>";
		
		echo "<td>";
		
		echo $row['plithos'];
		
		echo "</td>";
		
		echo "</tr>";
		
		
		
	}


echo "</table>";






?>