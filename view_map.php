<html>

<head>

<link rel="stylesheet" href="mystyle.css">


<link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
<script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script type="text/javascript">


$(document).ready(function(){
	
	//kodikas gia tin emfanisi tou xarti 
			
	    
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(create_initial_marker);
  } else {
    console.log("Geolocation not supported");
  }


function create_initial_marker(position) {
 var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  
  
   var mapOptions = {
            center: [lat, lng],
            zoom: 10
         }
		 
		 		 
         // Creating a map object
         var map = new L.map('map', mapOptions);
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
  
  
  var marker = L.marker([lat, lng]).addTo(map);

  marker.bindPopup("Your Current Location").openPopup();
  
  
 
   
}
        
	
	
});	

</script>


</head>

<?php

include 'valid_user.php';

include 'user_menu.php';

?>


 <div id = "map" style = "width: 100%; height: 85%"></div>


</html>