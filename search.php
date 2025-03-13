<html>

<head>

<link rel="stylesheet" href="mystyle.css">


<link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
<script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script type="text/javascript">




$(document).ready(function(){
	
	var map;
	
	//kodikas gia tin emfanisi tou xarti 
			
	    
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(create_initial_marker);
  } else {
    console.log("Geolocation not supported");
  }


function create_initial_marker(position) {
	
	document.getElementById('map2').style.display = 'none';
 var lat = position.coords.latitude;
 
  var lng = position.coords.longitude;
  
  //orizo to prasino eikonidio gia ton marker
  var green = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

  //orio to portokali eikonidio gia ton marker
  var orange = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
  
  //orizo to kokkino eikonidio gia ton marker
 var red = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
}); 
  
  
  
   var mapOptions = {
            center: [lat, lng],
            zoom: 15
         }
		 
		 		 
         // Creating a map object
         map = new L.map('map', mapOptions);
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
  
  
  var marker = L.marker([lat, lng]).addTo(map);

  marker.bindPopup("Your Current Location").openPopup();
  
  
  
  $.ajax({
                url:'mypoints.php',
				
		        data: {user_lat: lat, user_lng:lng},

			
               type:'post',
			   

                
                success:function(response){
					
					
					//kalo tin json parse etsi oste na metatrepso to json array se javascript array
					 var result = JSON.parse(response);
					 
					 //console.log(result);
					 
					 for (var i=0;i<result.length;i++)
					 
					 {
						 
						 var current_pop = result[i][2];
						 
						 
						 if (current_pop <= 32)
							 
						 
						 {
							 
							 
						  var marker = L.marker([result[i][0], result[i][1]], {icon: green}).addTo(map);

                            if ( result[i][5] > 2000)
								
								{
								
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters" + "<br>"+ "Average Popluarity From Users:"+result[i][7]);

								}
								
								
								else
									
									{
										var myurl = "checkin.php?id="+result[i][6];
										
							          marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters" + "<br>" + 
									 "<a href ="+myurl+  ">"+ "Available Checkin </a>"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

										
										
									}
							 
							 
							 
						 }
						 
						 
						 else if (current_pop > 32 && current_pop <=65)
							 
						 
						 {
							 
							  var marker = L.marker([result[i][0], result[i][1]], {icon: orange}).addTo(map);

                           
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

    	 
							 
							 
							 
							 
						 }
						 
						 
						 else 
							 
						 
						 {
							 
							 var marker = L.marker([result[i][0], result[i][1]], {icon: red}).addTo(map);

                           
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

    	 
							  
							 
						 }
						 
						 
						  
						  
						 
					 }
					 
					 

                }
            });
	
	
  
  
  
 
   
}

//searching me vasi kapoion typo


$("#search").click(function(){
	
	
 document.getElementById('map').style.display = 'none';
 
  document.getElementById('map2').style.display = 'block';


 	
	
	if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(update_map);
  } else {
    console.log("Geolocation not supported");
  }


function update_map(position) {
 var lat = position.coords.latitude;
 
  var lng = position.coords.longitude;
  
  //orizo to prasino eikonidio gia ton marker
  var green = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

  //orio to portokali eikonidio gia ton marker
  var orange = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
  
  //orizo to kokkino eikonidio gia ton marker
 var red = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
}); 
  
  
  
   var mapOptions = {
            center: [lat, lng],
            zoom: 15
         }
		 
		 map.remove();
		 		 
         // Creating a map object
         map = new L.map('map2', mapOptions);
		 
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
  
  
  var marker = L.marker([lat, lng]).addTo(map);

  marker.bindPopup("Your Current Location").openPopup();
  
  
  
  $.ajax({
                url:'mypoints_type.php',
			
			   
			   data: {mytype: $( "#mytype" ).val(), user_lat:lat, user_lng:lng},

			
               type:'post',

                
                success:function(response){
					
					console.log(response);
					
					//kalo tin json parse etsi oste na metatrepso to json array se javascript array
					 var result = JSON.parse(response);
					 
					 
					 for (var i=0;i<result.length;i++)
					 
					 {
						 
						 var current_pop = result[i][2];
						 
						 
						 if (current_pop <= 32)
							 
						 
						 {
							 
							 
						  var marker = L.marker([result[i][0], result[i][1]], {icon: green}).addTo(map);

                            if ( result[i][5] > 2000)
								
								{
								
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters" + "<br>"+ "Average Popluarity From Users:"+result[i][7]);

								}
								
								
								else
									
									{
										var myurl = "checkin.php?id="+result[i][6];
										
							          marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters" + "<br>" + 
									 "<a href ="+myurl+  ">"+ "Available Checkin </a>"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

										
										
									}
							 
							 
							 
						 }
						 
						 
						 else if (current_pop > 32 && current_pop <=65)
							 
						 
						 {
							 
							  var marker = L.marker([result[i][0], result[i][1]], {icon: orange}).addTo(map);

                           
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

    	 
							 
							 
							 
							 
						 }
						 
						 
						 else 
							 
						 
						 {
							 
							 var marker = L.marker([result[i][0], result[i][1]], {icon: red}).addTo(map);

                           
						    marker.bindPopup("Poplularity Now:"+result[i][2] + "%"+ "<br>" + "Popularity in 1 hour:"+ result[i][3]+ "%" + "<br>" + "Popularity in 2 hours:"+result[i][4]+"%"+  "<br>"+"Distance From User:"+result[i][5] + " meters"+ "<br>"+ "Average Popluarity From Users:"+result[i][7]);

    	 
							  
							 
						 }
						 
						 
						  
						  
						 
					 }
				
					 
					 

                }
            });
	
	
  
  
  
 
   
}
	
	           
        
    });	

        	
	
});	

</script>


</head>

<?php

//include 'valid_user.php';

include 'user_menu.php';

?>


 <div id = "map" style = "width: 100%; height: 85%"></div>
 
  <div id = "map2" style = "width: 100%; height: 85%"></div>

 
 
 
 <br><br>
 
 Please Insert Type of Place:
 <br>
 
 <input type = "text" id = "mytype" name = "mytype" required>
 
 <br><br>
 <input type = "submit" id = "search" value = "Search For Places">


</html>