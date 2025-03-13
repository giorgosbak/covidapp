<html>

<head>

<link rel="stylesheet" href="mystyle.css">


</head>


<body>



<?php

include 'valid_user.php';

include 'user_menu.php';

?>

<br><br>

<h3> New Covid Case </h3>


<form action = "complete_declare.php" method = "post">

<input type = "date" name = "imerominia">

<br><br>

<input type = "submit" value = "New Covid Case">

</form>


</body>

</html>