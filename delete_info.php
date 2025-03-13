<html>


<body>


 <?php

include 'valid_admin.php';

include 'admin_menu.php';

?>

<br>
<br>

<form action = "complete_delete.php" method = "post">

<input type = "radio" name = "del_choice" value = "popularity"> Delete only popularity data

<br>
<br>

<input type = "radio" name = "del_choice" value = "all"> Delete all Data

<br>

<br>

<input type = "submit" value = "Continue">


</form>



</body>


</html>