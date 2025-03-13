<html> 
 
 <?php

include 'valid_admin.php';

include 'admin_menu.php';

?>
 
 <br><br><br>
 
 Upload Data:
 <br>
 <form action="upload_data.php" method="post" enctype="multipart/form-data">
       <input type="file" name="placesfile" >
       <input type="submit" value="Upload File">
</form>

<br>
<br>

<a href = "delete_info.php"> Delete Places' Information  </a>


</html>