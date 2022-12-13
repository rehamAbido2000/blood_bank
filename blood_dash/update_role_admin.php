<?php
session_start();
ob_start();
if(isset($_SESSION['admin_ssn'])){ 
// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
$role_id =(int)$_GET['id'];
  $page_name = " - تعديل صلاحيه";
  include 'init.php';

  require './layout/topNav.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
      $roles      = $_POST['roles'];
      $roles_ex = implode("/",$roles);
      $roles_arr = explode("/",$roles);
      
      $formErrors = array ();
      if(empty($name)||strlen($name)<3 ){
          $formErrors[] = "
          <script>
              toastr.error('من فضلك تاكد من ادخال اسم الصلاحيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
          </script>";
          $name_error="border border-danger";
      }
      if(empty($formErrors)){
                 
          update_role($role_id,$name,$roles_ex);
    
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
                  <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة صلاحية جديده للنظام</p>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                  <?php 
                      $the_role_id = $_GET['id'];
                      $role_data = get_rols_with_id($the_role_id);
                  ?>
                      <div style="direction: rtl !important;text-align: right;" class="row m-2">
                      <!--User Name-->
                          <div class="col-md-6 mb-3 col-xs-12">
                              <label for="Name">اسم الصلاحيه</label>
                              <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                  placeholder="ادخل اسم الصلاحيه" value="<?php echo $role_data['role_name'] ?>" name="name" autocomplete="off">
                          </div>
                          
                                  

                          <div style="direction: ltr;" class="col-md-6 mb-3 col-xs-12">
                              <label for="Name">الصلاحيات</label>
                              <?php echo $role_data["role_name"]; ?>
                              <select name="roles[]" class="ui fluid search dropdown" multiple="" id="selected_role">

                              <?php
                                $roles = $role_data['authentications'];
                                $imp_data = explode("/",$roles);

                                $auth = [
                                    
                                    "add_admin"                         =>"اضافة مسئول",
                                    "all_admin"                         =>"تعديل وحزف مسئول",
                                    "add_role"                          =>"اضافة صلاحيه",
                                    "all_role"                          =>"تعديل / حذف صلاحيه",
                                    "add_blood"                         =>"اضافة دم",
                                    "all_blood"                         =>"تعديل / حذف دم",
                                    "add_avilable_blood"                =>"اضافة فصيلة دم متوفره",
                                    "all_avilable_blood"                =>"تعديل / حذف فصيلة دم متوفره",
                                    "add_vaccine"                       =>"اضافة لقاح", 
                                    "all_vaccine"                       =>"تعديل / حذف لقاح",
                                    "add_avilable_vaccine"              =>"اضافة لقاح متوفر",
                                    "all_avilable_vaccine"              => "تعديل / حذف لقاح متوفر",
                                    "add_place"                         =>"اضافة مكان للتبرع",
                                    "all_place"                         =>"تعديل / حذف مكان",
                                    "add_api_user"                      =>"اضافة مستخدم api",
                                    "all_api_users"                     =>"تعديل / حذف مستخدم api",
                                    "add_country"                       =>"اضافة دوله",
                                    "all_country"                       =>"تعديل / حذف دوله",
                                    "add_gov_city"                      =>"اضافة محافظه او مدينه",
                                    "all_gov_city"                      =>"تعديل / حذف محافظه او مدينه",
                                    "add_news"                          =>"اضافة خبر جديد",
                                    "all_news"                          =>"تعديل / حذف خبر جديد",
                                    "add_diseas"                        =>"اضافة مرض",
                                    "all_diseas"                        =>"تعديل / حذف مرض",
                                    "add_reason"                        =>"اضافة سبب للتبرع",
                                    "all_reason"                        =>"تعديل / حذف سبب للتبرع",
                                    "add_req_type"                      =>"اضافة نوع طلب التبرع",
                                    "all_req_type"                      =>"تعديل / حذف نوع طلب التبرع",
                                    "all_patients"                      =>"جميع المرضي",
                                    "all_stories"                       =>"القصص المنشوره",
                                    "going_donners"                     =>"ملبيين طلبات التبرع",
                                    "search_for_patient"                =>"البحث عن مريض",
                                    "payments"                          =>"عمليات الدفع",
                                    "quick_requists"                    =>"الطلبات العاجله",
                                    "qrcode_reader"                     =>"تسليم طلبات الشراء",
                                    "donate_request"                    =>"طلبات التبرع",
                                    "vaccine_request"                   =>"طلبات اللقاحات",
                                    "buying_request"                    =>"طلبات الشراء",
                                    "contact_request"                   =>"طلبات المراسله",
                                
                                ];
                                for($i=0;$i<sizeof($imp_data);$i++){
                                    // for($j=0;$j<sizeof($auth)+110;$j++){
                                    foreach($auth as $key => $value){
                                        if($key == $imp_data[$i]){?>
                                            <option selected value="<?php echo $key;?>"><?php echo $value ?></option>
                                        <?php 
                                        unset($key);
                                        }
                                    }
                                }

                                foreach($auth as $key => $data){?>
                                    <option value="<?php echo $key;?>"><?php echo $data ?></option>
                                <?php
                                }
                                
                              ?>


                              <option value="">الصلاحيات</option>
                              </select>
                          </div>
                      </div>
  
                      <!--btn -> add--->
                      <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الصلاحيات</button>
                  </form>
                  </div>
              </div>
        </div>
      </div>
  </div>
  <?php
  // ================== End Add Role page ======================
  
  
  
  }else{
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
    $page_name = " - تعديل مسئول";
    $script = "add_admin.js";
    include 'init.php';
    // if(isset($_SESSION['role'])){
    require './layout/topNav.php';
    $admin_data = select_admin_by_id('admins',$id);
    $all_city_gov = all_city_gov();
    $all_gov_data = getAllData('governorate');
    $all_role_data = getAllData("role");
    $admin_role = select_by_id('role',$admin_data['role_id']);
    $admin_place = select_by_id('donate_places',$admin_data['work_place']);
    $admin_city = select_by_id('cities',$admin_place['city_id']);
    $admin_gov = select_by_id('governorate',$admin_city['gov_id']);
     
    //password_verify($pass,$rows['password'])
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            @$f_name                = FILTER_VAR( $_POST['f_name'], FILTER_SANITIZE_STRING);
            @$l_name                = FILTER_VAR( $_POST['l_name'], FILTER_SANITIZE_STRING);
            @$email                 = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
            @$admin_ssn             = FILTER_VAR( $_POST['admin_ssn'], FILTER_SANITIZE_NUMBER_INT);
            @$hashed_password       = password_hash($_POST['password'],PASSWORD_DEFAULT);
            @$role                  = FILTER_VAR( $_POST['role'], FILTER_SANITIZE_NUMBER_INT);
            @$gov_id                = FILTER_VAR( $_POST['gov_id'], FILTER_SANITIZE_NUMBER_INT);
            @$city_id               = FILTER_VAR( $_POST['city_id'], FILTER_SANITIZE_NUMBER_INT);
            @$place_id              = FILTER_VAR( $_POST['place_id'], FILTER_SANITIZE_NUMBER_INT);
    
                $formErrors = array ();
                // check the first name
                if(empty($f_name)||strlen($f_name)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال الاسم الاول بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                    </script>";
                    $f_name_error="border border-danger";
                }
                // check the last name
                if(empty($l_name)||strlen($l_name)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال الاسم الاحير بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                    </script>";
                    $l_name_error="border border-danger";
                }
                // check the email
                if(empty($email)||strlen($email)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال البريد الالكتروني بطريقه صحيحه ')
                    </script>";
                    $email_error="border border-danger";
                }
                // check the admin_ssn
                if(strlen((string)$_POST["admin_ssn"])<14 || empty($_POST["admin_ssn"] || !is_numeric($_POST["admin_ssn"]))){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال الرقم القومي بطريقه صحيحه وكامله')
                    </script>";
                    $ssn_error="border border-danger";
                }
                // check the passwprd
                if(empty($_POST['password'])||strlen($_POST['password'])<5 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه (يجب ان تكون اكثر من 5 حروف')
                    </script>";
                    $password_error="border border-danger";
                }
                // check the role
                if(empty($role)){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من اختيارك لصلاحيه')
                    </script>";
                    $role_error="border border-danger";
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
                // check the place
                if(empty($place_id)){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من اختيارك لمكان العمل')
                    </script>";
                    $place_error="border border-danger";
                }
    
    
    
    
                if(empty($formErrors)){  
                    update_admin($f_name,$l_name,$email,$hashed_password,$role,$admin_ssn,$place_id,$id);                
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
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل مسئول موجود فى النظام</p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                    
                        <div style="direction: rtl !important;text-align: right;" class="row m-2">
                        <!--first Name-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="F_name">الأسم الأول</label>
                                <input type="text" class="form-control <?php echo $f_name_error;?>" value="<?php echo $admin_data['admin_first_name'] ?>" id="F_name" placeholder="ادخل الاسم الاول" name="f_name" autocomplete="off">
                            </div>
                        <!--last Name-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="L_name">الأسم الأخير</label>
                                <input type="text" class="form-control <?php echo $l_name_error;?>" value="<?php echo $admin_data['admin_last_name'] ?>" id="L_name" placeholder="ادخل الاسم الاخير" name="l_name" autocomplete="off">
                            </div>
                        <!--Email-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="Email">البريد الالكتروني</label>
                                <input type="email" class="form-control <?php echo $email_error;?>" value="<?php echo $admin_data['email'] ?>" id="Email" placeholder="ادخل البريد الالكتروني " name="email" autocomplete="off">
                            </div>
                        <!--admin ssn-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="ssn">الرقم القومي</label>
                                <input type="number" class="form-control <?php echo $ssn_error;?>" value="<?php echo $admin_data['admin_ssn'] ?>" id="ssn" placeholder="ادخل الرقم القومي " name="admin_ssn" autocomplete="off">
                            </div>
                        <!--password-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="Password">كلمة السر</label>
                                <input type="password" class="form-control <?php echo $password_error;?>" id="Password" placeholder="ادخل كلمة السر " name="password" autocomplete="off">
                            </div>
                            <!--role--->
                            <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                                <label for="role">الصلاحيه</label>
                                <select class="<?php echo $role_error;?> custom-select ui search dropdown" name="role" id="role">
                               
                                    <option selected value="<?php echo $admin_role['id']  ?>"><?php echo $admin_role['role_name']  ?></option>
                                    <?php foreach($all_role_data as $role_data){ 
                                        if($role_data['id'] == $admin_role['id']){
                                            continue;
                                        }else{
                                        ?>
                                        <option value="<?php echo $role_data['id'];?>"><?php echo $role_data["role_name"]; ?></option>
                                        <?php } 

                                        } ?>
                                    </select>
                            </div>
    
    
                            <!-- gov name -->
                            <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3">
                                <label for="gov_id">المحافظه</label>
                                <select id="select_gov" class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id">
                                <option selected value="<?php echo $admin_gov['id']  ?>"><?php echo $admin_gov['name']  ?></option>
                                    <?php foreach($all_gov_data as $gov_data){
                                        if($gov_data['id'] == $admin_gov['id']){
                                            continue;
                                        }else{
                                        ?>
                                        <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                        <?php

                                        }
                                     } ?>
                                </select>
                            </div>
                             <!-- city name -->
                             <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                                <label for="city_id">المدينه</label>
                                <select id="select_city" class=" <?php echo $city_error;?> custom-select ui search dropdown" name="city_id">
                                <option selected value="<?php echo $admin_city['id']  ?>"><?php echo $admin_city['name']  ?></option>
                                </select>
                            </div>
                             <!-- place name -->
                             <div style="text-align: right !important;direction: rtl;margin: auto;" class="col-md-6  mb-4">
                                <label for="city_id">مكان العمل</label>
                                <select id="select_place" class=" <?php echo $place_error;?> custom-select ui search dropdown" name="place_id">
                                <option selected value="<?php echo $admin_place['id']  ?>"><?php echo $admin_place['place_name']  ?></option>
                                
                                </select>
                            </div>
    
    
                        </div>
                        <!--btn -> add--->
                        <button class="btn btn-primary d-block m-auto my-5">اصافة الي المسئولين</button>
                    </form>
                    </div>
                </div>
          </div>
        </div>
    </div>
    
    
    
    <?php
  }}


require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>