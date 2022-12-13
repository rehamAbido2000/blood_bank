<?php
session_start();
ob_start();
  $page_name = " - تعديل مراكز بنك الدم";
  $script = "add_place.js";
  include 'init.php';
  if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
  $all_gov_data = getAllData('governorate');
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("update_place",$roles)){

    $donate_place_id = $_GET['id'];
    $place_data = get_all_donate_places_info_with_place_id($donate_place_id);
    // $place_data=select_by_id("donate_places",$donate_place_id);
    require './layout/topNav.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$name                      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
        @$manager                   = FILTER_VAR( $_POST['manager'], FILTER_SANITIZE_STRING);
        @$gov_id                    = FILTER_VAR( $_POST['gov_id'], FILTER_SANITIZE_NUMBER_INT);
        @$city_id                   = FILTER_VAR( $_POST['city_id'], FILTER_SANITIZE_NUMBER_INT);
        @$start_at                  = $_POST['start_at'];
        @$close_at                  = $_POST['close_at'];
        @$holiday                   = FILTER_VAR( $_POST['holiday'], FILTER_SANITIZE_STRING);
        @$lat                       = $_POST['lat'];
        @$long                      = $_POST['long'];
    
        $formErrors = array ();
        // check the name
        if(empty($name)||strlen($name)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الاسم بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $name_error="border border-danger";
        }
        // check the manager name
        if(empty($manager)||strlen($manager)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال اسم المدير بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $manager_error="border border-danger";
        }
        // check the start at
        if(empty($start_at)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من موعد البدء')
            </script>";
            $start_at_error="border border-danger";
        }
        // check the gov
        if(empty($gov_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من اختيارك للمحافظه')
            </script>";
            $gov_error="border border-danger";
        }
        // check the city
        if(empty($city_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من اختيارك للمدينه')
            </script>";
            $city_error="border border-danger";
        }
        // check the close at
        if(empty($close_at)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال موعد الانتهاء')
            </script>";
            $close_at_error="border border-danger";
        }
        // check the lat
        if(empty($lat)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من اختيارك للموقع')
            </script>";
            $lat_error="border border-danger";
        }
        // check the long
        if(empty($long)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من اختيارك للموقع')
            </script>";
            $long_error="border border-danger";
        }
        // check the holiday
        if(empty($holiday)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال ايام العطلات')
            </script>";
            $holiday_error="border border-danger";
        }

        if(empty($formErrors)){
            update_donate_place($name,$manager,$city_id,$start_at,$close_at,$holiday,$lat,$long,$donate_place_id); 
        }

    }
        if (isset($formErrors)){ 
        foreach($formErrors as $error){
            echo $error;
        }
    }
    ?>
    <script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-ruX7KN2DIje10nYcJnv6ggqWScZeKrY&callback=initMap&v=weekly"
async
></script> 
    <div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
      require_once "./includes/template/footer.php";
    ?> 
        <div id="layoutSidenav_content">
            <div class="container-fluid ">
                <div class="allContent">
                <div class="container mainAddForm">
                    <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                    <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل بيانات مركز بنك الدم</p>
                    <form method="POST" style="margin-bottom: 60px;" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                <div style="direction: rtl !important;text-align: right;" class="row m-2 mb-5">
               
                <div class="row">
                    <!--User Name-->
                    <div class="col-md-6 mb-3">
                        <label for="name">اسم المكان</label>
                        <input type="text" class="form-control <?php echo $name_error;?>" id="name" 
                            placeholder="ادخل اسم المكان" value="<?php if(isset($name)){ echo $name;}else{echo $place_data["place_name"];} ?>" name="name" autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="manager">اسم مدير المكان</label>
                        <input type="text" class="form-control <?php echo $manager_error;?>" id="manager" 
                            placeholder="ادخل اسم مدير المكان" value="<?php if(isset($manager)){ echo $manager;}else{echo $place_data["place_manager"];} ?>" name="manager" autocomplete="off">
                    </div>
                     <!-- gov name -->
                     <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3">
                        <label for="gov_id">المحافظه</label>
                        <select class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id" id="select_gov">
                            <option selected disabled value=""><?php echo "المحافظه :- " . $place_data["governorate_name"]; ?></option>
                            <?php foreach($all_gov_data as $gov_data){ ?>
                                <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                     <!-- gov name -->
                     <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                        <label for="city_id">المدينه</label>
                        <select class=" <?php echo $city_error;?> custom-select ui search dropdown" name="city_id" id="select_city">
                            <option selected disabled value=""><?php echo "المدينه :- " . $place_data["city_name"]; ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 m-auto pb-4">
                        <label for="start_at">يفتح في</label>
                        <input type="time" class="form-control <?php echo $start_at_error;?>" value="<?php echo $place_data["open_at"];?>" id="start_at" 
                              name="start_at" autocomplete="off">
                    </div>
                    <div class="col-md-6 m-auto pb-4">
                        <label for="close_at">يغلق في </label>
                        <input type="time" class="form-control <?php echo $close_at_error;?>" value="<?php echo $place_data["close_at"];?>" id="close_at" 
                              name="close_at" autocomplete="off">
                    </div>
                    <div class="col-md-6 m-auto pb-4">
                        <label for="holiday">الاجازه </label>
                        <select class="<?php echo $holiday_error;?> custom-select ui search dropdown" name="holiday" id="holiday">
                            <option selected disabled value=""><?php echo "الاجازه :- " . $place_data["holiday"]; ?></option>
                                <option value="السبت">السبت</option>
                                <option value="الاحد">الاحد</option>
                                <option value="الاثنين">الاثنين</option>
                                <option value="الثلاثاء">الثلاثاء</option>
                                <option value="الاربعاء">الاربعاء</option>
                                <option value="الخميس">الخميس</option>
                                <option value="الجمعه">الجمعه</option>

                                
                        </select>
                    </div>
                </div>


                <div class="col-md-12 col-sm-12 row">
                    <?php include "map.php"; ?>
                    <button id="btn" class="custom-map-control-button">Go To My Location</button>
                    <div id="map" class="col-md-12 mb-3"></div>
                <div class="col-md-6 mb-3 m-auto col-xs-12">
                        <input hidden type="text" class="form-control <?php echo $lat_error;?>" id="lat" 
                            placeholder=" الاحداثي العرضي" value="<?php if(isset($lat)){ echo $lat;} ?>" name="lat" autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3 m-auto col-xs-12">
                        <input hidden type="text" class="form-control <?php echo $long_error;?>" id="long" 
                            placeholder=" الاحداثي الطولي" value="<?php if(isset($long)){ echo $long;} ?>" name="long" autocomplete="off">
                    </div>
                </div>
            </div>
                <!--btn -> add--->
                <button class="btn btn-primary d-block m-auto mt-5 mb-5" id="add_place">تعديل مركز التبرع</button>
            </form>
                    </div>
                </div>
          </div>
        </div>
    </div>
  <?php
      }else{
        echo "
        <script>
        toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
        </script>";
        header("Refresh:1;url=admin_dash.php");
      }    
}else{
        header("Location:admin_dash.php");
    }
}else{
    header("Location:index.php");
}
ob_end_flush();?>