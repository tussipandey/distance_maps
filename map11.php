<!DOCTYPE html>
<html>
<head>
    <title>
    Markers
    </title>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no">
    <meta charset="utf-8">
    <style>
        html,body{
            height: 100%;
        }
        #map{
            height: 80%;
        }
    </style>
    </head>
    <body>
    <div id="map"></div>
         <div id="current">Mark the two places to find the best route between them</div>
   
       <button type="button" onClick="refreshPage()">Reset</button>
        <button class="btn-success" onclick="showloc();">Find the best route</button>
        <script 
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmDLCp3jbSXe1IQ5znG4JWORLgoIqaIDo">
    </script>
        
    <script>
        var myLatLng = {lat: 12.9716, lng: 77.5946};
        var mapOptions ={
            center:myLatLng,
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        };
        var map = new google.maps.Map(document.getElementById('map'),mapOptions);
        map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
        var markeroptions ={
            position:myLatLng,
            map:map,
            title: "This is Bengaluru",
            draggable:true,
            animation:google.maps.Animation.BOUNCE
        };
        var marker1= new google.maps.Marker(markeroptions);
        
        marker1.setMap(null);
        
        
        
        
        
        

//create array where we store markers
var markers = [];

map.addListener("click", function(event){
var markerOptions = {
position: event.latLng,
//
map: map
};
var marker = new
google.maps.Marker(markerOptions);
//store marker in arra  y
markers.push(marker);
});//show markers stored in the array
function showMarkers(){
for(var i=0; i<markers.length; i++){
markers[i].setMap(map);
    
}
}
        
        
        function showloc(){
            var lat1 =markers[0].getPosition().lat();
            var lng1 = markers[0].getPosition().lng();
            var lat2 =markers[1].getPosition().lat() ;
            var lng2=markers[1].getPosition().lng();
       
        //document.getElementById('current').innerHTML = '<p>Latitude of first city is ' + lat1 +'Longitude of first city is ' + lng1 +'Latitude of seconf city is ' + lat2+'Longitude of second city is ' +lng2  +'</p';
            
        var directionsService = new google.maps.DirectionsService();
    
    var directionsDisplay = new google.maps.DirectionsRenderer();
    
    directionsDisplay.setMap(map);
    
    
       
      var start = new google.maps.LatLng(lat1,lng1);
        var end = new google.maps.LatLng(lat2,lng2);
        
        
        
        var request ={
            origin :start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING,
             avoidTolls: true,
             provideRouteAlternatives: true,
            unitSystem: google.maps.UnitSystem.METRIC
        }
        directionsService.route(request,function(result,status){
                 if(status == google.maps.DirectionsStatus.OK){
            console.log(result);
            window.alert("The travelling distnace is "+ result.routes[0].legs[0].distance.text+".<br/>The travelling time is:"+result.routes[0].legs[0].duration.text+".");
            
            directionsDisplay.setDirections(result);
        }
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
        });
    
    
    
            
            
        }
        function clearMarkers(){
for(var i=0; i<markers.length; i++){
markers[i].setMap(null);
}
}
        function deleteMarkers(){
                  clearMarkers();
markers = [];
}
        
        function refreshPage(){
    window.location.reload();
} 
        </script>
    </body>
</html>