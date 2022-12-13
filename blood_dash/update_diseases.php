<?php
session_start();
ob_start();
    $page_name = " - تعديل مرض";
    include 'init.php';
    if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
    // if(isset($_SESSION['role'])){
        require './layout/topNav.php';
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
      if(in_array("update_disease",$roles)){

            $id =(int)$_GET['id'];
            echo $id;
            $diseases_data=select_by_id("diseases",$id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    
            $formErrors = array ();
            if(empty($name)||strlen($name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم المرض بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            if(empty($formErrors)){
                 
                    update_diseases($name,$id);
                
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل مرض  موجود فى النظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                            <label for="Name">اسم المرض</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم المرض" value="<?php  echo $diseases_data['diseases']; ?>" name="name" autocomplete="off">
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم المرض</button>
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


    //}
// ================== end update diseases page ======================
}else{
    header("Location:index.php");
}

ob_end_flush();