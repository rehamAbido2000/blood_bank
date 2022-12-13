<?php
session_start();
ob_start(); 
$style="addMember.css";
if(isset($_SESSION['admin_ssn'])){


// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==6 && $_GET['to'] = "reason"){
$page_name = "- اضافة سبب للتبرع";
include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
if(in_array("add_reason",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $reason      = FILTER_VAR( $_POST['reason'], FILTER_SANITIZE_STRING);

    if(empty($reason)||strlen($reason)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال السبب بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
        $reason_error="border border-danger";
    }
    if(empty($formErrors)){
        /*check if info already added*/

        global $con;
        $stmt = $con->prepare("SELECT * FROM donate_reasons WHERE reason = ?");
        $stmt->execute(array($_POST['reason']));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count){
            echo "
                <script>
                    toastr.error('عفوا .. السبب المسجل موجود بالفعل مسبقا')
                </script>";
        }
        else{
            insert_reason($reason);
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
                    <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;"
                        src="img/addMember.png">
                    <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة سبب جديد للتبرع للنظام</p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                        <div style="direction: rtl !important;text-align: right;" class="row">
                            <!-- reason-->
                            <div style="margin-bottom:15px !important;" class="col-md-6 m-auto col-xs-12">
                                <label for="reason">ادخال سبب التبرع</label>
                                <input type="text" class="form-control <?php echo $reason_error;?>" id="reason"
                                    placeholder="ادخل سبب التبرع" value="<?php if(isset($reason)){ echo $reason;} ?>"
                                    name="reason" autocomplete="off">
                            </div>
                        </div>

                        <!--btn -> add--->
                        <button class="btn btn-primary d-block m-auto mt-5">اصافة الي اسباب التبرع</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// ================== End Add Role page ======================


// ================== Start add admin page ===================
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}
}else{
    $page_name = " - اضافة نوع طلب الدم";
    include 'init.php';
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']);
    require './layout/topNav.php';
    if(in_array("add_req_type",$roles)){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $req_type      = FILTER_VAR( $_POST['req_type'], FILTER_SANITIZE_STRING);
    
        if(empty($req_type)||strlen($req_type)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال نوع الطلب بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $req_type_error="border border-danger";
        }
        if(empty($formErrors)){
            /*check if info already added*/
    
            global $con;
            $stmt = $con->prepare("SELECT * FROM request_blood_type WHERE type = ?");
            $stmt->execute(array($_POST['req_type']));
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
            if ($count){
                echo "
                    <script>
                        toastr.error('عفوا .. السبب المسجل موجود بالفعل مسبقا')
                    </script>";
            }
            else{
                insert_req_type($req_type);
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
                    <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;"
                        src="img/addMember.png">
                    <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة نوع طلب دم جديد للنظام</p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                        <div style="direction: rtl !important;text-align: right;" class="row m-2">
                            <!-- req_type-->
                            <div style="margin-bottom: 15px !important;" class="col-md-6 m-auto col-xs-12">
                                <label for="req_type">ادخال نوع طلب التبرع</label>
                                <input type="text" class="form-control <?php echo $req_type_error;?>" id="req_type"
                                    placeholder="ادخل نوع الطلب" value="<?php if(isset($req_type)){ echo $req_type;} ?>"
                                    name="req_type" autocomplete="off">
                            </div>
                        </div>

                        <!--btn -> add--->
                        <button class="btn btn-primary d-block m-auto mt-5">اضافة الي انواع طلبات التبرع</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    }
else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}

}



    require_once "./includes/template/footer.php";
    
}else{
    header("Location:index.php");
}
    ob_end_flush();?>