<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_ssn'])){ 
$style="addMember.css";

 
// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
$page_name = " - اضافة صلاحيه";
include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
// if(in_array("all_admin",$data_ex)){}
require './layout/topNav.php';
if(in_array("add_role",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    $roles      = $_POST['roles'];
    $roles_ex = implode("/",$roles);
    $formErrors = array ();
    if(empty($name)||strlen($name)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال اسم الصلاحيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
        $name_error="border border-danger";
    }
    if(empty($formErrors)){
        /*check if info already added*/

        global $con;
        $stmt = $con->prepare("SELECT * FROM role WHERE role_name = ?");
        $stmt->execute(array($name));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count){
            echo "
                <script>
                    toastr.error('عفوا .. اسم الصلاحيه المسجله موجوده بالفعلا مسبقا')
                </script>";
        }
        else{
            insert_role($name,$roles_ex);
        }  
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
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--User Name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="Name">اسم الصلاحيه</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم الصلاحيه" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                        </div>

                        <div style="direction: ltr;" class="col-md-6 mb-3 col-xs-12">
                            <label for="Name">الصلاحيات</label>
                            <select name="roles[]" class="ui fluid search dropdown" multiple="">
                                <option value="">الصلاحيات</option>
                                <option value="add_admin">اضافة مسئول</option>
                                <option value="all_admin">تعديل وحزف مسئول</option>
                                <option value="add_role">اضافة صلاحيه</option>
                                <option value="all_role">تعديل / حذف صلاحيه</option>
                                <option value="add_blood">اضافة دم</option>
                                <option value="all_blood">تعديل / حذف دم</option>
                                <option value="add_avilable_blood">اضافة فصيلة دم متوفره</option>
                                <option value="all_avilable_blood">تعديل / حذف فصيلة دم متوفره</option>
                                <option value="add_vaccine">اضافة لقاح</option>
                                <option value="all_vaccine">تعديل / حذف لقاح</option>
                                <option value="add_avilable_vaccine">اضافة لقاح متوفر</option>
                                <option value="all_avilable_vaccine"> تعديل / حذف لقاح متوفر</option>
                                <option value="add_place">اضافة مكان للتبرع</option>
                                <option value="all_place">تعديل / حذف مكان</option>
                                <option value="add_api_user">اضافة مستخدم api</option>
                                <option value="all_api_users">تعديل / حذف مستخدم api</option>
                                <option value="add_country">اضافة دوله</option>
                                <option value="all_country">تعديل / حذف دوله</option>
                                <option value="add_gov_city">اضافة محافظه او مدينه</option>
                                <option value="all_gov_city">تعديل / حذف محافظه او مدينه</option>
                                <option value="add_news">اضافة خبر جديد</option>
                                <option value="all_news">تعديل / حذف خبر جديد</option>
                                <option value="add_diseas">اضافة مرض</option>
                                <option value="all_diseas">تعديل / حذف مرض</option>
                                <option value="add_reason">اضافة سبب للتبرع</option>
                                <option value="all_reason">تعديل / حذف سبب للتبرع</option>
                                <option value="add_req_type">اضافة نوع طلب التبرع</option>
                                <option value="all_req_type">تعديل / حذف نوع طلب التبرع</option>
                                <option value="all_patients">جميع المرضي</option>
                                <option value="all_stories">القصص المنشوره</option>
                                <option value="going_donners">ملبيين طلبات التبرع</option>
                                <option value="search_for_patient">البحث عن مريض</option>
                                <option value="payments">عمليات الدفع</option>
                                <option value="quick_requists">الطلبات العاجله</option>
                                <option value="donate_request">طلبات التبرع</option>
                                <option value="vaccine_request">طلبات اللقاحات</option>
                                <option value="buying_request">طلبات الشراء</option>
                                <option value="contact_request">طلبات المراسله</option>
                                <option value="qrcode_reader">تسليم طلبات الشراء</option>
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
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}

// ================== Start add admin page ===================

}else{
$page_name = " - اضافة مسئول";
$script = "add_admin.js";
include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_city_gov = all_city_gov();
$all_gov_data = getAllData('governorate');
$all_role_data = getAllData("role");

//password_verify($pass,$rows['password'])
if(in_array("add_admin",$roles)){

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
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM admins WHERE email = ?");
                $stmt->execute(array($email));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. البريد الالكتروني المسجل موجود بالفعلا مسبقا')
                        </script>";
                }
                else{
                    insert_admin($f_name,$l_name,$email,$hashed_password,$role,$admin_ssn,$place_id);                
                }  
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة مسئول جديد للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--first Name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="F_name">الأسم الأول</label>
                            <input type="text" class="form-control <?php echo $f_name_error;?>" value="<?php if(isset($f_name)){ echo $f_name;} ?>" id="F_name" placeholder="ادخل الاسم الاول" name="f_name" autocomplete="off">
                        </div>
                    <!--last Name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="L_name">الأسم الأخير</label>
                            <input type="text" class="form-control <?php echo $l_name_error;?>" value="<?php if(isset($l_name)){ echo $l_name;} ?>" id="L_name" placeholder="ادخل الاسم الاخير" name="l_name" autocomplete="off">
                        </div>
                    <!--Email-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="Email">البريد الالكتروني</label>
                            <input type="email" class="form-control <?php echo $email_error;?>" value="<?php if(isset($email)){ echo $email;} ?>" id="Email" placeholder="ادخل البريد الالكتروني " name="email" autocomplete="off">
                        </div>
                    <!--admin ssn-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="ssn">الرقم القومي</label>
                            <input type="number" class="form-control <?php echo $ssn_error;?>" value="<?php if(isset($admin_ssn)){ echo $admin_ssn;} ?>" id="ssn" placeholder="ادخل الرقم القومي " name="admin_ssn" autocomplete="off">
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
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_role_data as $role_data){ ?>
                                    <option value="<?php echo $role_data["id"];?>"><?php echo $role_data["role_name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>


                        <!-- gov name -->
                        <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3">
                            <label for="gov_id">المحافظه</label>
                            <select id="select_gov" class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id">
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_gov_data as $gov_data){ ?>
                                    <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                         <!-- city name -->
                         <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                            <label for="city_id">المدينه</label>
                            <select id="select_city" class=" <?php echo $city_error;?> custom-select ui search dropdown" name="city_id">
                                <option selected disabled value="">...اختر المحافظه اولا</option>
                            </select>
                        </div>
                         <!-- place name -->
                         <div style="text-align: right !important;direction: rtl;margin: auto;" class="col-md-6  mb-4">
                            <label for="city_id">مكان العمل</label>
                            <select id="select_place" class=" <?php echo $place_error;?> custom-select ui search dropdown" name="place_id">
                                <option selected disabled value="">...اختر المدينه اولا</option>
                            
                            </select>
                        </div>


                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي المسئولين</button>
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





    require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
    ob_end_flush();?>
