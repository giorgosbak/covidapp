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




?>