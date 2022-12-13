<?php
session_start();
ob_start(); 
$script="vaccine_name.js";
if(isset($_SESSION['admin_ssn'])){ 

    // ================== start Add Role page ======================

    if(isset($_GET['to']) && strlen($_GET['to'])==9 && $_GET['to'] = "add_blood"){
        $page_name = " - اضافة فصيلة دم";
        include 'init.php';
        $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
        $roles= explode("/",$role_data['authentications']) ;
        require './layout/topNav.php';
        if(in_array("add_blood",$roles)){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
                
                $formErrors = array ();
                if(empty($name)){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال اسم فصيلة الدم بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                    </script>";
                    $name_error="border border-danger";
                }
                if(empty($formErrors)){
                    /*check if info already added*/

                    global $con;
                    $stmt = $con->prepare("SELECT * FROM blood_type WHERE name = ?");
                    $stmt->execute(array($name));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();
                    if ($count){
                        echo "
                            <script>
                                toastr.error('عفوا .. الفصيله المسجله موجوده بالفعلا مسبقا')
                            </script>";
                    }
                    else{
                        insert_blood($name);
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
                                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة فصيلة دم جديده للنظام</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                                        <!--User Name-->
                                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                            <label for="Name">اسم فصيلة الدم</label>
                                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name"
                                                placeholder="ادخل اسم فصيلة الدم" value="<?php if(isset($name)){ echo $name;} ?>"
                                                name="name" autocomplete="off">
                                        </div>
                                    </div>

                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي فصائل الدم</button>
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
        // ================== End Add Role page ======================


        // ================== Start add admin page ===================

    }elseif(isset($_GET['to']) && strlen($_GET['to'])==12 && $_GET['to'] = "vaccine_name"){
        $page_name = " - اضافة لقاح";
        include 'init.php';
        $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
        $roles= explode("/",$role_data['authentications']) ;
        require './layout/topNav.php';
        if(in_array("all_blood",$roles)){
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
                            /*check if info already added*/
                    
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
                                insert_vaccine_name($sname,$tname);                
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
                                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة اسم لقاح جديد للنظام</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                                        <!--store Name-->
                                        <div class="col-md-6 mb-3 col-xs-12">
                                            <label for="Name">الاسم العلمي ل اللقاح</label>
                                            <input style="padding: 18px;" type="text" class="form-control <?php echo $name_error;?>"
                                                id="Name" placeholder="ادخل الاسم العلمي لللقاح"
                                                value="<?php if(isset($name)){ echo $name;} ?>" name="sname" autocomplete="off">
                                        </div>
                                        <div class="col-md-6 mb-3 col-xs-12">
                                            <label for="Name">الاسم التجاري ل اللقاح</label>
                                            <input style="padding: 18px;" type="text" class="form-control <?php echo $name_error;?>"
                                                id="Name" placeholder="ادخل الاسم التجاري لللقاح"
                                                value="<?php if(isset($name)){ echo $name;} ?>" name="tname" autocomplete="off">
                                        </div>


                                    </div>

                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">اصافة اسم لقاح جديد</button>
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
    }elseif(isset($_GET['to']) && strlen($_GET['to'])==18 && $_GET['to'] = "add_avilable_blood"){
        $page_name = " - اضافة فصيله دم متوفره";
        include 'init.php';
        $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
        $roles= explode("/",$role_data['authentications']) ;
        require './layout/topNav.php';
        if(in_array("add_avilable_blood",$roles)){
            $all_blood_type = getAllData("blood_type");
            $all_places = getAllData("donate_places");
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




                        
                        insert_avilable_blood($blood_id,$place,$amount,$price,$_SESSION['admin_ssn']);                
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
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction:ltr;"
                                            class="col-md-6 col-xs-12">
                                            <label for="blood_type"> فصيلة الدم </label>
                                            <select class="<?php echo $blood_error;?> custom-select ui search dropdown"
                                                name="blood_type" id="blood_type">
                                                <option selected disabled value="">...اختر</option>
                                                <?php foreach($all_blood_type as $blood_data){ ?>
                                                <option value="<?php echo $blood_data['id'];?>"><?php echo  $blood_data["name"];?>
                                                </option>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!--places-->
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                            class="col-md-6 col-xs-12">
                                            <label for="place">مكان توفر فصيلة الدم</label>
                                            <select class="<?php echo $place_error;?> custom-select ui search dropdown" name="place"
                                                id="place">
                                                <option selected disabled value="">...اختر</option>
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
                                                placeholder="ادخل الكميه " value="<?php if(isset($amount)){ echo $amount;} ?>"
                                                name="amount" autocomplete="off">
                                        </div>
                                        <!--vaccine price-->
                                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                            <label for="Price">السعر للكيس الواحد </label>
                                            <input style="padding: 18px;" type="text"
                                                class="form-control <?php echo $price_error;?>" id="Price"
                                                placeholder="ادخل السعر  " value="<?php if(isset($price)){ echo $price;} ?>"
                                                name="price" autocomplete="off">
                                        </div>


                                    </div>

                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي فصائل الدم المتوفره</button>
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
        $page_name = " - اضافة لقاح";
        include 'init.php';
        $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

        $roles= explode("/",$role_data['authentications']) ;
        // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(in_array("add_vaccine",$roles)){
            $all_vaccines_name = getAllData("vaccines");
            $all_countries = getAllData("country");
            $all_places = getAllData("donate_places");

            //password_verify($pass,$rows['password'])
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                @$vac_name_id    = FILTER_VAR( $_POST['sname'],  FILTER_SANITIZE_NUMBER_INT);
                @$country        = FILTER_VAR( $_POST['country'], FILTER_SANITIZE_NUMBER_INT);
                @$place          = FILTER_VAR( $_POST['place'], FILTER_SANITIZE_NUMBER_INT);
                @$amount         = FILTER_VAR( $_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
                @$price          = FILTER_VAR( $_POST['price'], FILTER_SANITIZE_NUMBER_INT);

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




                        
                        insert_vaccine($vac_name_id,$country,$place,$amount,$price,$_SESSION["admin_ssn"]);                
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
                            <a href="add_blood_vaccine.php?to=vaccine_name"> <button style="padding: 7px 25px;" type="button"
                                    name="add" class="btn btn-success ml-4 mt-2">اضافة اسم لقاح جديد <i
                                        class='bx bxs-user-plus'></i></button></a>
                            <div class="container mainAddForm">
                                <img class="addMemberMainImg pt-5 " style="width: 80px;margin: auto;display: block;"
                                    src="img/addMember.png">
                                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة اللقاحات المتوفره للنظام</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-5">
                                        <!--store Name-->
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction:ltr;"
                                            class="col-md-6 col-xs-12">
                                            <label for="tname"> الاسم التجاري ل اللقاح</label>
                                            <select class="<?php echo $name_error;?> custom-select ui search dropdown" name="tname"
                                                id="tname">
                                                <option selected disabled value="">...اختر</option>
                                                <?php foreach($all_vaccines_name as $vaccine_data){ ?>
                                                <option value="<?php echo $vaccine_data['id'];?>">
                                                    <?php echo  $vaccine_data["trade_name"]  ;?></option>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                                            <label for="sname">الاسم العلمي ل اللقاح</label>
                                            <select id="sname" class=" <?php echo $name_error;?> custom-select ui search dropdown"
                                                name="sname">
                                                <option selected disabled value="">...اختر الاسم التجاري اولا</option>
                                            </select>
                                        </div>
                                        <!--country of made-->
                                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;"
                                            class="col-md-6 col-xs-12">
                                            <label for="country">بلد المنشأ</label>
                                            <select class="<?php echo $country_error;?> custom-select ui search dropdown"
                                                name="country" id="country">
                                                <option selected disabled value="">...اختر</option>
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
                                                <option selected disabled value="">...اختر</option>
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
                                                placeholder="ادخل الكميه " value="<?php if(isset($amount)){ echo $amount;} ?>"
                                                name="amount" autocomplete="off">
                                        </div>
                                        <!--vaccine price-->
                                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                            <label for="Price">السعر للجرعه الواحد</label>
                                            <input style="padding: 18px;" type="text"
                                                class="form-control <?php echo $price_error;?>" id="Price"
                                                placeholder="ادخل سعر الجرعه " value="<?php if(isset($price)){ echo $price;} ?>"
                                                name="price" autocomplete="off">
                                        </div>


                                    </div>

                                    <!--btn -> add--->
                                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي اللقاحات المتوفره</button>
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
    require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
    ob_end_flush();?>