<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_ssn'])){ 
// ================== start update gov page ======================
if(isset($_GET['to']) && strlen($_GET['to'])==3 && $_GET['to'] = "gov"){

    $page_name = " - تعديل محافظه";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("all_gov_city",$roles)){

            $id =(int)$_GET['id'];
            
            $gov_data=select_by_id("governorate",$id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    
            $formErrors = array ();
            if(empty($name)||strlen($name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم المحافظه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            if(empty($formErrors)){
                 
                    update_gov($name,$id);
                
            }

            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
            ?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
        <div class="container-fluid ">
            <div class="allContent">
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة محافظه جديده للنظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                            <label for="Name">اسم المحافظه</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم المحافظه" value="<?php  echo $gov_data['name']; ?>" name="name" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم المحافظات</button>
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
        }}


    //}
// ================== end update gov page ======================
// ================== start update country page ======================

}elseif(isset($_GET['to']) && strlen($_GET['to'])==7 && $_GET['to'] = "country"){

    $page_name = " - تعديل بلد";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("all_country",$roles)){

            $id =(int)$_GET['id'];
            echo $id;
            $country_data=select_by_id("country",$id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    
            $formErrors = array ();
            if(empty($name)||strlen($name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم البلد بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            if(empty($formErrors)){
                 /*check if info already added*/
        
                 
                    update_country($name,$id);
                  
            }

            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
            ?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
        <div class="container-fluid ">
            <div class="allContent">
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة بلد جديده للنظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                            <label for="Name">اسم البلد</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم البلد" value="<?php  echo $country_data['name']; ?>" name="name" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم البلد</button>
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
        }}


    //}
// ================== end update country page ======================
// ================== start update city page ======================

}else{

    $page_name = " - تعديل مدينه";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        $all_gov_data = getAllData("governorate");

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("all_gov_city",$roles)){
            
            $id =(int)$_GET['id'];
            echo $id;
            $city_data=select_by_id("cities",$id);
            $city_gov_data=select_by_id("governorate",$_GET['gov']);

            print_r($gov_data);
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
                $gov_id    = FILTER_VAR( $_POST['gov_id'], FILTER_SANITIZE_STRING);
                $formErrors = array ();
                if(empty($name)||strlen($name)<3 ){
                    $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم المدينه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            if(empty($formErrors)){
                 /*check if info already added*/
        
                
                    update_city($name,$gov_id,$id);
                  
            }

            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
            ?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
        <div class="container-fluid ">
            <div class="allContent">
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة بلد جديده للنظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--city Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                            <label for="Name">اسم البلد</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم البلد" value="<?php  echo $city_data['name']; ?>" name="name" autocomplete="off">
                        </div>
                        <!-- gov name -->
                        <div style="text-align: right !important;direction: rtl;" class="col-md-6  col-xs-12">
                            <label for="gov">المحافظه</label>
                            <select class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id" id="gov">
                                <option selected  value="<?php echo $_GET['gov'] ?>"><?php  $city_gov_data['name'] ?></option>
                                <?php foreach($all_gov_data as $gov_data){ ?>
                                    <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                    </div>
                    

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم البلد</button>
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
        }}


    //}

// ================== end update city page ======================
}









require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>