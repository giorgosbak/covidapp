<?php 

include 'valid_user.php';

include 'connect.php';


$myuser= $_SESSION['username'];


$select = "SELECT place.name as pname, presence.dt as ptime FROM place INNER JOIN presence ON place.id = presence.place_id WHERE presence.username = '$myuser'";

$select2 = "SELECT date_declared FROM declaration WHERE username = '$myuser'";


$result = $conn->query($select);

$result2 = $conn->query($select2);

echo "<table>";

echo "<tr>";

echo "<td>";

echo "<table border='1'>";

echo "<tr>";

echo "<th colspan ='2'>";

echo "CheckIns History";

echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<th>";

echo "Place Name";

echo "</th>";

echo "<th>";

echo "Date & Time";

echo "</th>";


while($row = $result->fetch_assoc())
	
	{
		echo "<tr>";
		
		echo "<td>";
		
		echo $row['pname'];
		
		echo "</td>";
		
		echo "<td>";
		
		echo $row['ptime'];
		
		echo "</td>";
		
		echo "</tr>";
		
	}
echo "</table>";

echo "</td>";

echo "<td>";

////////////////////////////////////////


echo "<table border='1'>";

echo "<tr>";

echo "<th colspan ='1'>";

echo "Covid History";

echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<th>";

echo "Date";

echo "</th>";


while($row2 = $result2->fetch_assoc())
	
	{
		echo "<tr>";
		
		
		echo "<td>";
		
		echo $row2['date_declared'];
		
		echo "</td>";
		
		echo "</tr>";
		
	}

echo "</table>";


echo "</td>";


echo "</tr>";

echo "</table>";



?>