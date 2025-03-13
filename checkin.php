<html>


<?php

session_start();

include 'connect.php';


$id = $_GET['id'];


?>

<body>

<form action  = "user_popularity.php" method = "post">


<input type = "text"  name = "place_id" value = <?php  echo $id ?> hidden >

<br>

Popularity in Percentage:
<input type = "number" min ="0" max = "100" name = "user_pop">

<br><br>

<input type = "submit" value ="Insert Popularity"> 

</form>

</body>

</html>