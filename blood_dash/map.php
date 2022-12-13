<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
        width:100%;
        height: 500px;
        margin: auto;
        border-radius: 25px;
        }

        
    </style> 
  </head>
  <body>
 

  <script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-ruX7KN2DIje10nYcJnv6ggqWScZeKrY&callback=initMap&v=weekly"
  async
></script>
<script>
    let map, infoWindow;
    function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 30.673561, lng: 31.589362 },
            zoom: 8,
          });
          var lat = [30.47413,30.671597,31.13830039884395];
          var lng = [31.589362,31.588970,29.82639756829841];

          for(i=0;i<=2;i++){

            add_marker({coords:{lat:lat[i],lng:lng[i]},content:'<h2>asdsadasd</h2><hr><p>hello this is amd</p>'});

          }
        // ============== function to add mark in map ================
        function add_marker(props){
        var marker = new google.maps.Marker({
        // position:{lat:27,lng:30},
        position:props.coords,
        map:map,
        icon:'./img/blood-donation.png',
        content:'<h1>hello</h1>'
        });
        if(props.content){
        var infoWindow = new google.maps.InfoWindow({
            content:props.content
        });
        marker.addListener('click',function(){
            infoWindow.open(map,marker);
        })
        }
    }
    // ============== add mark by click by user ================
             google.maps.event.addListener(map,'click',function(event){
             var x = document.getElementById("lat");
             var y = document.getElementById("long");
             location =event.latLng.split(',');
             x.value = location[0] ;
             x.value = location[1] ;

             add_marker({coords:event.latLng})
             })
               // ============== select current location ================
  infoWindow = new google.maps.InfoWindow();

const locationButton = document.getElementById("btn");

locationButton.addEventListener("click", () => {
  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent("Location found.");
        infoWindow.open(map);
        map.setCenter(pos);
      },
      () => {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
});

}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
</script>
  </body>
</html>