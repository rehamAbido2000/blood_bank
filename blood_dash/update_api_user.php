<?php
session_start();
ob_start();
  $page_name = " - تعديل الاخبار";
  include 'init.php';
  if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
  // if(isset($_SESSION['role'])){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("update_api_users",$roles)){

    $api_user_id = $_GET['id'];
    $api_user_data = getData_with_id("api_users",$api_user_id);
    require './layout/topNav.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $user_name      = FILTER_VAR( $_POST['user_name'], FILTER_SANITIZE_STRING);
        $auth_code       = $_POST['auth_code'];
    
        if(empty($user_name)||strlen($user_name)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال اسم المستخدم بطريقة صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $user_name_error="border border-danger";
        }
        if(empty($formErrors)){
            // insert_api_user($user_name,$auth_code,$_SESSION["id"]);
            update_api_user($user_name,$auth_code,$_SESSION['admin_ssn'],$api_user_id);
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
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل مستخدم للبيانات </p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <?php 
                
                date_default_timezone_set('Africa/Cairo');
                $date = date("y-m-d-H-i-s");
                $exc_date = explode("-",$date);
                shuffle($exc_date);               
                ?>
                    <div style="direction: rtl !important;text-align: right;" class="row">
                    <!-- username-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="user_name">ادخال اسم المستخدم</label>
                            <input  style="padding-top: 19px !important;padding-bottom: 18px !important;" type="text" class="form-control <?php echo $user_name_error;?>" id="user_name" 
                                placeholder="ادخل اسم المستخدم" value="<?php if(isset($user_name)){ echo $user_name;}else{echo $api_user_data["user_name"];} ?>" name="user_name" autocomplete="off">
                        </div>
                    <!-- user_authentication code-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="user_name">كود المستخدم</label>
                            <input style="padding-top: 19px !important;padding-bottom: 18px !important;" type="number" class="form-control" id="auth_code" 
                            readonly value="<?php echo $api_user_data["auth_code"] ?>" name="auth_code" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي مستخدمين البيانات</button>
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
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>