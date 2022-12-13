<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_ssn'])){ 
// ================== start Add gov page ======================
if(isset($_GET['to']) && strlen($_GET['to'])==3 && $_GET['to'] = "gov"){
    $page_name = " - اضافة محافظه";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(in_array("add_gov_city",$roles)){
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
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM governorate WHERE name = ?");
                $stmt->execute(array($name));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. المحافظه المسجله موجوده بالفعلا مسبقا')
                        </script>";
                }
                else{
                    insert_gov($name);
                }  
            }
        }
        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }
   // }



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
                                placeholder="ادخل اسم المحافظه" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي المحافظات</button>
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
// ================== end Add gov page ======================
// ================== start Add country page ======================
    }elseif(isset($_GET['to']) && strlen($_GET['to'])==7 && $_GET['to'] = "country"){
    $page_name = " - اضافة بلد";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(in_array("add_country",$roles)){
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
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM country WHERE name = ?");
                $stmt->execute(array($name));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. البلد المسجله موجوده بالفعلا مسبقا')
                        </script>";
                }
                else{
                    insert_country($name);
                }  
            }
        }
        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }
   // }



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
                                placeholder="ادخل اسم البلد" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي البلاد</button>
                </form>
                </div>
            </div>
      </div>
    </div>
</div>
<?php
// ================== end Add country page ======================
// ================== end Add city page ======================
    }else{
        echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
    }
    }else{
        $page_name = " - اضافة مدينه";
        include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
        // if(isset($_SESSION['role'])){
            require './layout/topNav.php';
            $all_gov_data = getAllData("governorate");
            if(in_array("add_gov_city",$roles)){
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
            
                    global $con;
                    $stmt = $con->prepare("SELECT * FROM governorate WHERE name = ?");
                    $stmt->execute(array($name));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();
                    if ($count){
                        echo "
                            <script>
                                toastr.error('عفوا .. المدينه المسجله موجوده بالفعلا مسبقا')
                            </script>";
                    }
                    else{
                        insert_city($name,$gov_id);
                    }  
                }
            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
       // }


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
                        <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة مدينه جديده للنظام</p>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                        
                            <div style="direction: rtl !important;text-align: right;" class="row m-2 mb-5">
                            <!--city Name-->
                                <div class="col-md-6  m-auto col-xs-12">
                                    <label for="Name">اسم المدينه</label>
                                    <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                        placeholder="ادخل اسم المدينه" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                                </div>
                                <!-- gov name -->
                                <div style="text-align: right !important;direction: rtl;" class="col-md-6  col-xs-12">
                                <label for="gov">المحافظه</label>
                                <select class="<?php echo $gov_error;?> custom-select ui search dropdown" name="gov_id" id="gov">
                                    <option selected disabled value="">...اختر</option>
                                    <?php foreach($all_gov_data as $gov_data){ ?>
                                        <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>
                           
                            <!--btn -> add--->
                            <button class="btn btn-primary d-block m-auto mt-5">اصافة الي المدن</button>
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
// ================== end Add city page ======================

require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>