 // realtime for governorrates

 $(document).ready(function(){
  $("#select_gov").change(function(){
      let req = new XMLHttpRequest();         //make ajax request
      req.open("POST","gov_city_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
      //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
      let key = $("#select_gov").val();
      req.send("gov_id="+key+"&hamada=hamada");
      req.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
              $("#select_city").html(this.responseText);

              let req = new XMLHttpRequest();         //make ajax request
              req.open("POST","gov_city_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
              req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
              //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
              let key = $("#select_city").val();
              req.send("city_id="+key);
              req.onreadystatechange = function(){
                  if(this.readyState == 4 && this.status == 200){
                      $("#select_place").html(this.responseText);
                      if(this.responseText==""){
                          $("#select_place").html("<option selected disabled>اخترالمدينه اولا</option>")
                      }
                  }
              }


          }
      }
  })

    
  
  // responseText دا بيكون فيه الداتا او الحاجه الي محطوطه في ملف ال php التاني
  
  
})









    let map, infoWindow;

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 30.673561, lng: 31.589362 },
        zoom: 8,
      });
    
    //   var lat = [30.47413,30.671597,31.13830039884395];
    //   var lng = [31.589362,31.588970,29.82639756829841];
    
    //   for(i=0;i<=2;i++){
    
    //     add_marker({coords:{lat:lat[i],lng:lng[i]},content:'<h2>asdsadasd</h2><hr><p>hello this is amd</p>'});
    
    //   }
    
    var button = document.getElementById("btn");
      button.addEventListener("click",function(e){
          e.preventDefault();
      })
    
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
        // var par = document.getElementById("p");
        // par.innerHTML = event.latLng;
        var y = event.latLng;
        // console.log(typeof(y.lat));
        var lat = JSON.stringify(y).replace('"lat":' , '').replace('"lng":' , '').replace('}' , '').replace('{' , '').split(",")[0];
        var long = JSON.stringify(y).replace('"lat":' , '').replace('"lng":' , '').replace('}' , '').replace('{' , '').split(",")[1];
        document.getElementById("lat").value = lat;
        document.getElementById("long").value = long;
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
      infoWindow.setContent("<h6 style='text-align:center;color:red'>Location found.</h6>");
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

