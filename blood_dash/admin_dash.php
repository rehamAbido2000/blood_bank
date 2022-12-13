<?php 
session_start();
ob_start();
$page_name = "";
$style="dash_page.css";
$script="dash_page.js";
require "init.php";
require './layout/topNav.php';

if(isset($_SESSION['admin_ssn'])){ 


// $all_users = getAllData("members")
?>
    
    <div id="layoutSidenav">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
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
      var lat = [30.47413,30.671597,31.13830039884395,31.686243389617925];
      var lng = [31.589362,31.588970,29.82639756829841,31.686243389617925];
      
let Results =[];

async function all() {

    // let Response = await fetch(`https://api.themoviedb.org/3/movie/upcoming?api_key=c0d379e9b2fca29da7e3e39703976bc5&language=en-US&page=1`);

    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_donate_places_info/230422052801/all`);
    let allData = await Response.json();
    Results = allData.data;
    for(var j=0;j<=Results.length;j++){
        add_marker({coords:{lat:parseFloat(Results[j]["lat"]),lng:parseFloat(Results[j]["lng"])},content:'<h3>'+ Results[j]["place_name"] +'</h3><hr><p style="width:45%;display:inline-block;float:right;text-align:center">تحت ادارة :- د/ ' + Results[j]["place_manager"] + '</p>' + '<p style="width:45%;display:inline-block;float:left;text-align:center">الاجازه الرسميه :- ' + Results[j]["holiday"] + '</p>' + '<br><br><hr><p style="width:45%;display:inline-block;float:right;text-align:center">يفتح في :- ' + Results[j]["open_at"] + '</p>' + '<p style="width:45%;display:inline-block;float:left;text-align:center">يغلق في  :- ' + Results[j]["close_at"] + '</p>'});
}

    // add_marker({coords:{lat:Results[2]["lat"],lng:Results[2]["lng"]},content:'<h2>asdsadasd</h2><hr><p>hello this is amd</p>'});

};

all();

    //   for(i=0;i<=2;i++){

    //     add_marker({coords:{lat:lat[i],lng:lng[i]},content:'<h2>asdsadasd</h2><hr><p>hello this is amd</p>'});

    //   }
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
        //  google.maps.event.addListener(map,'click',function(event){
        //  var x = document.getElementById("lat");
        //  var y = document.getElementById("long");
        //  location =event.latLng.split(',');
        //  x.value = location[0] ;
        //  x.value = location[1] ;

        //  add_marker({coords:event.latLng})
        //  })



                 // ============== add mark by click by user ================
        google.maps.event.addListener(map,'click',function(event){
        // var par = document.getElementById("p");
        // par.innerHTML = event.latLng;
        var y = event.latLng;
        // console.log(typeof(y.lat));
        var lat = JSON.stringify(y).replace('"lat":' , '').replace('"lng":' , '').replace('}' , '').replace('{' , '').split(",")[0];
        var long = JSON.stringify(y).replace('"lat":' , '').replace('"lng":' , '').replace('}' , '').replace('{' , '').split(",")[1];

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
           
 <?php 
    require './layout/sidNav.php';

 ?>
            <div id="layoutSidenav_content">

            
                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">صحتك</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">لوحة التحكم</li>
                        </ol>

                        <div class="header_cards">
                            <div class="row">

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/blood.svg" alt="blood_donation">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_blood_bags(); ?>
                                            </h3>
                                            <p class="desc">
                                                Blood Bag
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/donners.svg" alt="donners">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_patients_donners(); ?>
                                            </h3>
                                            <p class="desc">
                                                Donner
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/vaccine.svg" alt="blood_donation">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_vaccine(); ?>
                                            </h3>
                                            <p class="desc">
                                                Vaccine
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                        <img style="color:red" src="img/hospital.svg" alt="blood_donation">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_donate_places(); ?>
                                            </h3>
                                            <p class="desc">
                                                Hospital
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- second_row -->
                            <div class="row mt-3">

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/admin.svg" alt="admin">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_admins(); ?>
                                            </h3>
                                            <p class="desc">
                                                Admin
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/news.svg" alt="news">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_news(); ?>
                                            </h3>
                                            <p class="desc">
                                                News
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/payments.svg" alt="payments">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_payments(); ?>
                                            </h3>
                                            <p class="desc">
                                                Payments
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                        <img style="color:red" src="img/quick_Requist.svg" alt="quick_Requist">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_quick_requests(); ?>
                                            </h3>
                                            <p class="desc">
                                               Q Requests
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
              

                <!-- ==============charts============= -->
                <?php $cities = getAllData("cities"); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center">فصائل الدم المتوفره</p>
                                <!-- <select class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id" id="gov">
                                    <option selected disabled value="">...اختر</option>
                                        <?php
                                        foreach($cities as $cities_data){ ?>
                                            <option value="<?php echo $cities_data['id'];?>"><?php echo $cities_data["name"]; ?></option>
                                        <?php } ?>
                                    </select> -->
                                <canvas class="charts" id="myChart1"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center"> اللقاحات المتوفره</p>
                                <canvas class="charts" id="myChart3"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center"> اللقاحات المتوفره</p>
                                <canvas class="charts" id="myChart4"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center"> اللقاحات المتوفره</p>
                                <canvas class="charts" id="myChart5"></canvas>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 row">
                            <button id="btn" style="display: block;margin: 20px auto;margin-top: 50px;" class="custom-map-control-button btn btn-danger">Go To My Location</button>
                            <div id="map" class="col-md-12 mb-3"></div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="charts_container">
                                <p class="text-center"> اماكن بنك الدم في المحافظات</p>
                                <canvas class="charts_circle" id="myChart2"></canvas>
                            </div>
                        </div>
                        
                    </div>



                        <?php
                            $blood = getAllData("blood_type");
                            $vaccine = getAllData("vaccines");
                            $governorates = getAllData("governorate");
                                            $i=0;

                          
                        ?>

                           <script>

                            // ===================== chart 1 =====================
                            const labels = [
                            <?php foreach($blood as $b_type){
                                echo "'" . $b_type["name"] . "'" . ",";
                            }?>
                                
                              ];
                            
                            const data1 = {
                                labels: labels,
                                datasets: [{
                                  label: 'فصائل الدم المتوفره',
                                  backgroundColor: 'rgb(255, 99, 132)',
                                  borderColor: 'rgb(255, 99, 132)',
                                  data: [<?php 
                                  foreach($blood as $b_type){
                                      if(count_blood_bags($b_type["id"])){
                                    echo  count_blood_bags($b_type["id"]) . ",";
                                      }else{
                                          echo 0 . ",";
                                      }
                                }
                                  ?>],
                                }]
                              };

                            // ===================== chart 2 (الدايره) =====================

                            const data2 = {
                            labels: [
                                <?php foreach($governorates as $govs){
                                echo "'" . $govs["name"] . "'" . ",";
                            }?>
                            ],
                            datasets: [{
                                label: 'اللقاحات المتوفره',
                                data: [
                                    <?php 
                                    foreach($governorates as $govs){
                                        $dddata = count_places($govs["id"]);
                                                foreach ($dddata as $data3){
                                                    $data22 = count_places2($data3["id"]);
                                                    foreach($data22 as $final_data){
                                                        $i++;
                                                    }
                                                }
                                        echo $i . ",";
                                        $i=0;
                                            }
                                     
                                    ?>
  

                                ],
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 99, 132)',
                                '#FF4500',
                                '#ADFF2F',
                                '#DCC48E',
                                '#0ff',
                                '#9400D3',
                                '#40E0D0',
                                ],
                                hoverOffset: 4
                            }]
                            };

                            // ===================== chart 3 =====================
                            const labels3 = [
                                <?php foreach($vaccine as $v_data){
                                echo "'" . $v_data["trade_name"] . "'" . ",";
                            }?>
                            ];
                            const data3 = {
                            labels: labels3,
                            datasets: [{
                                label: 'اللقاحات المتوفره',
                                data: [
                                    <?php 
                                    foreach($vaccine as $v_data){
                                        if(count_vaccine($v_data["id"])){
                                        echo count_vaccine($v_data["id"]) . ",";
                                        }else{
                                            echo 0 . ",";
                                        }
                                    }
                                  ?>
                                ],
                                backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                            };

                            // ===================== chart 4 =====================
                            const labels4 = [
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'June',
                                'June',
                                'June',
                                'June',
                            ];
                            const data4 = {
                                labels: labels4,
                                datasets: [{
                                    axis: 'y',
                                label: 'My First Dataset',
                                data: [65, 59, 80, 81, 56, 55, 40,50],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                                }]
                            };


                            // ===================== chart 5 =====================
                            const labels5 = [
                                <?php foreach($blood as $b_type){
                                echo "'" . $b_type["name"] . "'" . ",";
                            }?>
                              ];
                            
                            const data5 = {
                                labels: labels5,
                                datasets: [{
                                label: 'فصائل الدم المتوفره',
                                fill: true,
                                borderColor: 'rgb(40, 146, 253)',
                                backgroundColor: 'rgba(40, 146, 253,.3)',
                                tension: .3,
                                  data: [<?php 
                                  foreach($blood as $b_type){
                                      if(count_blood_bags($b_type["id"])){
                                    echo  count_blood_bags($b_type["id"]) . ",";
                                      }else{
                                          echo 0 . ",";
                                      }
                                }
                                  ?>],
                                }]
                              };

                              </script>

                        <!-- <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    Branch Members
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Commity</th>
                                                <th>College-Name</th>
                                                <th>College-Year</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Commity</th>
                                                <th>College-Name</th>
                                                <th>College-Year</th>                                            </tr>
                                        </tfoot>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </main>
                

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();
