<?php 

//ksekinaei to session
session_start();

//kanei unset oles tis session metavlites
session_unset();


//katastrafei to session
session_destroy();

header("Location: index.php");


?>