<html>

<?php

include 'valid_admin.php';

include 'admin_menu.php';

?>

<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script>


$( document ).ready(function() {
    
	$.ajax({
                url:'admin_stats.php',

                type:'post',
                
                success:function(response){
                   

                    $("#count_cases").html(response);
				   

                }
            });
		
});	


</script>


</head>


<body>

<div id = "count_cases">  </div>


</body>






</html>