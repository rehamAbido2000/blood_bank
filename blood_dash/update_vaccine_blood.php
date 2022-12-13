<?php
session_start();
ob_start();
$script="vaccine_name.js";
if(isset($_SESSION['admin_ssn'])){ 
/*
==========================  
  تعديل صلاحيه
==========================
*/
if(isset($_GET['to']) && strlen($_GET['to'])==9 && $_GET['to'] = "add_blood"){
    $page_name = " - تعديل صلاحيه";
    include 'init.php';
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']) ;
    $blood_id = $_GET['id'];
    $blood = getData_with_id("blood_type",$blood_id);
    require './layout/topNav.php';
    if(in_array("all_role",$roles)){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
            $formErrors = array ();
            if(empty($name)){
                $formErrors[] = "
                <script>
                toastr.error('من فضلك تاكد من ادخال اسم الفصيله بطريقه صحيحه )
                </script>";
                $name_error="border border-danger";
            }
            if(empty($formErrors)){
                update_blood($blood_id,$name);
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
                            <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة فصيلة دم جديده للنظام</p>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                <div style="direction: rtl !important;text-align: right;" class="row m-2">
                                    <!--User Name-->
                                    <div class="col-md-6 mb-3 m-auto col-xs-12">
                                        <label for="Name">اسم فصيلة الدم</label>
                                        <input type="text" class="form-control <?php echo $name_error;?>" id="Name"
                                            placeholder="ادخل اسم فصيلة الدم" value="<?php echo $blood['name'] ?>" name="name"
                                            autocomplete="off">
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
    }else{
        echo "
        <script>
        toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
        </script>";
        header("Refresh:1;url=admin_dash.php");
    }

/*
==========================  
  تعديل اسم اللقاح
==========================
*/

}elseif(isset($_GET['to']) && strlen($_GET['to'])==12 && $_GET['to'] = "vaccine_name"){
    $page_name = " - تعديل اسم القاح";
    include 'init.php';
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']) ;
    require './layout/topNav.php';
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
        $vaccine_data=select_by_id("vaccines",$id);
        if(in_array("all_vaccine_name",$roles)){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sname           = FILTER_VAR( $_POST['sname'], FILTER_SANITIZE_STRING);
                $tname           = FILTER_VAR( $_POST['tname'], FILTER_SANITIZE_STRING);
                $formErrors = array ();
                if(empty($sname) || empty($tname)){
                    $formErrors[] = "
                    <script>
                    toastr.error('من فضلك تاكد من ادخال اسم اللقاح بطريقه صحيحه ')
                    </script>";
                    $name_error="border border-danger";
                }
                if(empty($formErrors)){
                    global $con;
                    $stmt = $con->prepare("SELECT * FROM vaccines WHERE scientific_name = ?,trade_name = ?");
                    $stmt->execute(array($sname,$tname));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();
                    if ($count){
                        echo "
                        <script>
                        toastr.error('عفوا .. اسم اللقاح المسجل موجود بالفعلا مسبقا')
                        </script>";
                    }
                    else{
                        update_vaccine_name($sname,$tname,$id);              
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
                                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل اسم القاح للنظام</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                                        <!--store Name-->
                                        <div class="col-md-6 mb-3 col-xs-12">
                                            <label for="Name">الاسم العلمي لللقاح</label>
                                            <input style="padding: 18px;" type="text" class="form-control <?php echo $name_error;?>"
                                            id="Name" placeholder="ادخل الاسم العلمي لللقاح"
                                            value="<?php echo $vaccine_data['scientific_name'] ?>" name="sname"
                                            autocomplete="off">
                                        </div>
                                        <div class="col-md-6 mb-3 col-xs-12">
                                            <label for="Name">الاسم التجاري لللقاح</label>
                                            <input style="padding: 18px;" type="text" class="form-control <?php echo $name_error;?>"
                                            id="Name" placeholder="ادخل الاسم التجاري لللقاح"
                                            value="<?php echo $vaccine_data['trade_name'] ?>" name="tname" autocomplete="off">
                                        </div>
                                    </div>
                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم اللقاح</button>
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
    }

/*
==========================  
  تعديل فصيلة الدم المتوفره
==========================
*/

}elseif(isset($_GET['to']) && strlen($_GET['to'])==18 && $_GET['to'] = "add_avilable_blood"){
    $page_name = " - تعديل فصيله دم متوفره";  
    include 'init.php';
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']) ;
    require './layout/topNav.php';
    $all_blood_type = getAllData("blood_type");
    $all_places = getAllData("donate_places");
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
        $avilable_blood_data=select_by_id("avilable_blood",$id);
        $selected_blood = getData_with_id('blood_type',$avilable_blood_data['blood_type_id']);
        $selected_place = getData_with_id('donate_places',$avilable_blood_data['place_id']);
        if(in_array("all_avilable_blood",$roles)){

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                @$blood_id        = FILTER_VAR( $_POST['blood_type'], FILTER_SANITIZE_NUMBER_INT);
                @$place          = FILTER_VAR( $_POST['place'], FILTER_SANITIZE_NUMBER_INT);
                @$amount         = FILTER_VAR( $_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
                @$price          = FILTER_VAR( $_POST['price'], FILTER_SANITIZE_NUMBER_INT);

                $formErrors = array ();
                if(empty($blood_id)){
                    $formErrors[] = "
                    <script>
                    toastr.error('من فضلك تاكد من ادخال فصيله دم متوفره ')
                    </script>";
                    $blood_error="border border-danger";
                }
                if(empty($place)){
                    $formErrors[] = "
                    <script>
                    toastr.error('من فضلك تاكد من اختيار مكان توفر فصيله دم متوفره')
                    </script>";
                    $place_error="border border-danger";
                }
                if(empty($amount)){
                    $formErrors[] = "
                    <script>
                    toastr.error('من فضلك تاكد من اختيار الكميه ')
                    </script>";
                    $amount_error="border border-danger";
                }
                if(empty($price)){
                    $formErrors[] = "
                    <script>
                    toastr.error('من فضلك تاكد من اختيار السعر ')
                    </script>";
                    $price_error="border border-danger";
                }
                update_avilable_blood($id,$blood_id,$place,$amount,$price,$_SESSION["admin_ssn"]);                
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
                                <img class="addMemberMainImg pt-5 " style="width: 80px;margin: auto;display: block;"
                                src="img/addMember.png">
                                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة فصيلة متوفره جديده للنظام
                                </p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                    <div style="direction: rtl !important;text-align: right;" class="row m-2 mb-5">
                                        <!--store Name-->
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                            class="col-md-6 col-xs-12">
                                            <label for="blood_type"> فصيله الدم</label>
                                            <select class="<?php echo $country_error;?> custom-select ui search dropdown"
                                            name="blood_type" id="blood_type">
                                                <option selected value="<?php echo $selected_blood['id'] ?>">
                                                <?php echo $selected_blood['name']?></option>
                                                <?php $type =getData_with_id('blood_type',$avilable_blood_data['blood_type_id']);
                                                $place =getData_with_id('donate_places',$avilable_blood_data['place_id']);
                                                foreach($all_blood_type as $blood_data){ 
                                                if($blood_data['id'] == $selected_blood['id']){
                                                continue;
                                                }
                                                ?>
                                                <option value="<?php echo $blood_data['id'];?>"><?php echo $blood_data["name"]; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!--places-->
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                        class="col-md-6 col-xs-12">
                                            <label for="place">مكان توفر فصيله الدم</label>
                                            <select class="<?php echo $place_error;?> custom-select ui search dropdown" name="place"
                                            id="place">
                                                <option selected value="<?php echo $selected_place['id'] ?>">
                                                <?php echo $selected_place['place_name'] ?></option>
                                                <?php foreach($all_places as $place_data){ 
                                                if($place_data['id'] == $selected_place['id']){
                                                continue;
                                                }
                                                ?>
                                                <option value="<?php echo $place_data['id'];?>">
                                                <?php echo $place_data["place_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!--vaccine amount-->
                                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                            <label for="Amount">الكميه</label>
                                            <input style="padding: 18px;" type="number"
                                            class="form-control <?php echo $amount_error;?>" id="Amount"
                                            placeholder="ادخل الكميه " value="<?php echo $avilable_blood_data['amount'] ?>"
                                            name="amount" autocomplete="off">
                                        </div>
                                        <!--vaccine price-->
                                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                            <label for="Price">السعر للكيس الواحد </label>
                                            <input style="padding: 18px;" type="text"
                                            class="form-control <?php echo $price_error;?>" id="Price"
                                            placeholder="ادخل السعر  " value="<?php echo $avilable_blood_data['price'] ?>"
                                            name="price" autocomplete="off">
                                        </div>
                                    </div>

                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">تعديل فصيله الدم المتوفره</button>
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
    }

}else{
$page_name = " - تعديل لقاح";
include 'init.php';
$_SESSION['role'] =1;
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';


$all_countries = getAllData("country");
$all_places = getAllData("donate_places");
$all_vaccines_name = getAllData("vaccines");

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id =(int)$_GET['id'];
    $vaccine_data=select_by_id("avilable_vaccines",$id);
    $vac_name = select_by_id('vaccines',$vaccine_data['vaccine_id']);
    if(in_array("all_avilable_vaccine",$roles)){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $vac_name_id     = FILTER_VAR( $_POST['vac_name'], FILTER_SANITIZE_NUMBER_INT);
            $country         = FILTER_VAR( $_POST['country'], FILTER_SANITIZE_NUMBER_INT);
            $place           = FILTER_VAR( $_POST['place'], FILTER_SANITIZE_NUMBER_INT);
            $amount          = FILTER_VAR( $_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
            $price           = FILTER_VAR( $_POST['price'], FILTER_SANITIZE_NUMBER_INT);
            $formErrors = array ();
            if(empty($vac_name_id)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم اللقاح ')
                </script>";
                $name_error="border border-danger";
            }
            if(empty($country)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيار بلد المنشأ لل لقاح ')
                </script>";
                $country_error="border border-danger";
            }
            if(empty($place)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيار مكان توفر اللقاح')
                </script>";
                $place_error="border border-danger";
            }
            if(empty($amount)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيار كميه اللقاح')
                </script>";
                $store_error="border border-danger";
            }
            if(empty($price)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيار سعر اللقاح')
                </script>";
                $store_error="border border-danger";
            }




            update_avilable_vaccine($id,$vac_name_id,$country,$place,$amount,$price,$_SESSION["admin_ssn"]);
            // update_avilable_vaccine($country,$place,$amount,$price,$_SESSION["admin_ssn"],$id,$vac_name_id);                
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
                            <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل لقاح للنظام</p>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                <div style="direction: rtl !important;text-align: right;" class="row m-2">
                                    <!--store Name-->
                                    <div style="margin-bottom: 30px !important;text-align: right !important;direction:ltr;"
                                        class="col-md-6 col-xs-12">
                                        <label for="tname"> الاسم التجاري لللقاح</label>
                                        <select class="<?php echo $name_error;?> custom-select ui search dropdown"
                                            name="vac_name" id="tname">
                                            <option selected value="<?php echo $vac_name['id'] ?>">
                                                <?php echo $vac_name['trade_name'] ?></option>
                                            <?php foreach($all_vaccines_name as $vaccines_data){ ?>
                                            <option value="<?php echo $vaccines_data['id'];?>">
                                                <?php echo  $vaccines_data["trade_name"]  ;?></option>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                                        <label for="sname">الاسم العلمي للقاح</label>
                                        <select id="sname" class=" <?php echo $name_error;?> custom-select ui search dropdown"
                                            name="vac_name">
                                            <option selected value="<?php echo $vac_name['id'] ?>">
                                                <?php echo $vac_name['scientific_name'] ?></option>
                                        </select>
                                    </div>
                                    <!--country of made-->
                                    <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                        class="col-md-6 col-xs-12">
                                        <label for="country">بلد المنشأ</label>
                                        <select class="<?php echo $country_error;?> custom-select ui search dropdown"
                                            name="country" id="country">
                                            <?php $country =getData_with_id('country',$vaccine_data['country_id']);
                                            $place =getData_with_id('donate_places',$vaccine_data['vaccine_place_id']);
                                            //$admin_data =select_admin_by_id('admins',$vaccine_data['admin_ssn']); ?>
                                            <?php foreach($all_countries as $country_data){ ?>
                                            <option value="<?php echo $country_data['id'];?>">
                                                <?php echo $country_data["name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!--places-->
                                    <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                        class="col-md-6 col-xs-12">
                                        <label for="place">مكان توفر اللقاح</label>
                                        <select class="<?php echo $place_error;?> custom-select ui search dropdown" name="place"
                                            id="place">
                                            <?php foreach($all_places as $place_data){ ?>
                                            <option value="<?php echo $place_data['id'];?>">
                                                <?php echo $place_data["place_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!--vaccine amount-->
                                    <div class="col-md-6 mb-3 m-auto col-xs-12">
                                        <label for="Amount">الكميه</label>
                                        <input style="padding: 18px;" type="number"
                                            class="form-control <?php echo $amount_error;?>" id="Amount"
                                            placeholder="ادخل الكميه " value="<?php echo $vaccine_data['amount'] ?>"
                                            name="amount" autocomplete="off">
                                    </div>
                                    <!--vaccine price-->
                                    <div class="col-md-6 mb-3 m-auto col-xs-12">
                                        <label for="Price">السعر للجرعه الواحد</label>
                                        <input style="padding: 18px;" type="text"
                                            class="form-control <?php echo $price_error;?>" id="Price"
                                            placeholder="ادخل سعر الجرعه " value="<?php  echo $vaccine_data['price'] ?>"
                                            name="price" autocomplete="off">
                                    </div>


                                </div>

                                <!--btn -> add--->
                                <button class="btn btn-primary d-block m-auto mt-5"> تعديل اللقاح</button>
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
    }
}

require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>