<html>

<head>

<link rel="stylesheet" href="mystyle.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>


$( document ).ready(function() {
    
	$.ajax({
                url:'search_contacts.php',

                type:'post',
                
                success:function(response){
                   

                    $("#result").html(response);
				   

                }
            });
		
});	


</script>


</head>





<body>

<?php

include 'valid_user.php';

include 'user_menu.php';

?>

<br>

<br>



<div id = "result"> </div>

</body>







</html>