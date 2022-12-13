<?php
session_start();
ob_start();
$page_name = " - البحث عن مريض";
include "init.php";
if(isset($_SESSION['admin_ssn'])){
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
if(in_array("search_for_patient",$roles)){
if(isset($_GET['to']) && strlen($_GET['to'])==6 && $_GET['to'] = "update"){
    require './layout/topNav.php';?>
    <div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent mb-5">
    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $p_ssn = $_POST['ssn'];
        $p_diseases = select_user_by_id('patient_diseases',$p_ssn);
        $p_data = select_user_by_id('patients_donors',$p_ssn);
        $all_diseases=getAllData("diseases");
        $p_city = select_by_id("cities" ,$p_data['city_id']);
        $p_gov = select_by_id("governorate" ,$p_city['gov_id']);
        $p_blood = select_by_id("blood_type" ,$p_data['blood_type']);
        $p_gender = select_by_id("gender" ,$p_data['gender_id']);
        $all_p_diseases=getData_with_p_ssn("patient_diseases",$p_data['p_ssn']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['empty']) ){
            if($_POST['empty'] != 'empty'){
                $count = count_patient($p_diseases['p_ssn'],'patient_diseases',$p_ssn);
                for($i=0;$i<$count;$i++){
                    $diseases[]=select_by_id('diseases',$p_diseases['disiease_id']);
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['diseases']) ){
            $up_diseases = $_POST['diseases'];
            update_patient_diseases($p_data['p_ssn'],$up_diseases,$_SESSION['admin_ssn']);

        }


        ?>
        <a href="add_diseases.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5"> اضافة مرض جديد  <i class='bx bxs-user-plus'></i></button></a>
                            
              
        <div id="layoutSidenav">     
     
    
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل بعض بيانات المرضى فى النظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    
                        <!--User Name-->
                        <div class="col-md-12 mb-3 m-auto col-xs-12">
                                <label for="Name">الاسم</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_data['p_first_name'] . " " . $p_data['p_last_name'] ; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">البريد الإلكتروني</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_data['email']; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">رقم الهاتف الاول</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_data['mobile_phone']; ?>" name="name" autocomplete="off">
                        </div>

<!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">رقم الهاتف الثاني</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_data['home_phone']; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">فصيله الدم</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_blood['name']; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">العمر</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo getAge($p_data['birthday']); ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">الجنس</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_gender['type']; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">المحافظه</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_gov['name']; ?>" name="name" autocomplete="off">
                        </div>
                        <!--User Name-->
                        <div class="col-md-6 mb-3 m-auto col-xs-12">
                                <label for="Name">المدينه</label>
                                <input type="text"disabled class="form-control " id="Name" 
                                    value="<?php  echo $p_city['name']; ?>" name="name" autocomplete="off">
                        </div>
                        <input type="text" name="ssn" hidden value="<?php echo $p_data['p_ssn'] ?>">
                         <!--role--->
                         <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-12 col-xs-12">
                            <label for="diseases">المرض</label>
                            <!-- <?php $counter =count($all_p_diseases);
                            ?> -->
                            <select class="ui fluid search dropdown" multiple="" name="diseases[]" id="diseases">
                               
                                
                                <?php 
                                
                                foreach($all_p_diseases as $data){
                                    foreach($all_diseases as $diseases_data){ 
                                        if($diseases_data['id'] == $data['disiease_id']){?>

                                            <option selected value="<?php echo $diseases_data['id'];?>"><?php echo $diseases_data["diseases"]; ?></option>
                                            
                                            <?php 
                                            unset($diseases_data['id']);
                                
                                        }
                                    }
                                    if($counter < 0){
                                        break;
                                    }else{
                                        $counter--;
                                    }

}
                                foreach($all_diseases as $data){?>
                                    <option value="<?php echo $data['id'];?>"><?php echo $data['diseases'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                        </div>

                        <!--  -->
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">تعديل بيانات المرض</button>
                </form>
            </div>
        </div>
        </div>
        </div>
      </div>
    </div>
<?php


}}else{
    require './layout/topNav.php';
?>
    <style>
        .columns {
            float: unset !important;
            display: block;
            margin:20px auto !important;

        }
    </style>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">
        <div class="tableOfHosters table-responsive">
                            
                            

                            <div class="container-fluid">
                            <h1 class="mt-4">بنك الدم</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item">لوحة التحكم</li>
                                <li class="breadcrumb-item active">جميع المرضي والمتبرعين</li>
                            </ol>
    
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                        جميع المرضي والمتبرعين
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="toolbar" class="select">
                                            <select style="display: none;" class="form-control">
                                            </select>
                                        </div>
                                        <table class="table table-bordered text-center" data-show-export="true"
                                        data-toolbar="#toolbar" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>الرقم القومي</th>
                                                <th>اسم المريض</th>       
                                                <th>البريد الالكتروني</th>
                                                <th>فصيلة الدم</th>
                                                <th>العمر</th>
                                                <th>الجنس</th>
                                                <th>المحافظه</th>
                                                <th>المدينه</th>   
                                                <th>المرض</th>      
                                                <th>رقم الهاتف الأول</th>
                                                <th>رقم الهاتف الثاني</th>      
                                                <th>تعديل البيانات</th>             
                                                <th>حذف البيانات</th>             
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>الرقم القومي</th>
                                                <th>اسم المريض</th>       
                                                <th>البريد الالكتروني</th>
                                                <th>فصيلة الدم</th>

<th>العمر</th>
                                                <th>الجنس</th>
                                                <th>المحافظه</th>
                                                <th>المدينه</th>
                                                <th>المرض</th>      
                                                <th>رقم الهاتف الأول</th>
                                                <th>رقم الهاتف الثاني</th>      
                                                <th>تعديل البيانات</th>             
                                                <th>حذف البيانات</th>     
                                            </tr>            
                                        </tfoot>
                                            <tbody>
                                               <?php 
                                               global $id;
                                               $all_patient = getAllData("patients_donors");
                                               foreach($all_patient as $patient_data){
                                                echo"<tr>";
                                                    echo "<td>".  $patient_data['p_ssn']    ."</td>";
                                                    echo "<td>".  $patient_data['p_first_name'] . " " .  $patient_data['p_last_name']      ."</td>";
                                                    echo "<td>".  $patient_data['email']    ."</td>";
                                                    $p_blood = select_by_id("blood_type" ,$patient_data['blood_type']);
                                                    echo "<td>".  $p_blood['name']    ."</td>";
                                                    echo "<td>".   getAge($patient_data['birthday'])   ."</td>";
                                                    $p_gender = select_by_id("gender" ,$patient_data['gender_id']);
                                                    echo "<td>".  $p_gender['type']   ."</td>";
                                                    $p_city = select_by_id("cities" ,$patient_data['city_id']);
                                                    $p_gov = select_by_id("governorate" ,$p_city['gov_id']);
                                                    echo "<td>".  $p_gov['name']    ."</td>";
                                                    echo "<td>".  $p_city['name']    ."</td>";
                                                    $diseases = getData_with_p_ssn("patient_diseases" ,$patient_data['p_ssn']);
                                                    if(!empty($diseases)){
                                                        echo "<td>";  
                                                        foreach($diseases as $d_data){
                                                            $disease = select_by_id("diseases" ,$d_data['disiease_id']);
                                                            echo $disease['diseases'] ." / ";
                                                        }
                                                            // print_r($diseases);
                                                        echo "</td>";
                                                    }else{
                                                        echo "<td>لا يوجد مرض   </td>";?>
                                                        
                                                   <?php }
                                                    echo "<td>".  $patient_data['mobile_phone']    ."</td>";
                                                    echo "<td>".  $patient_data['home_phone']    ."</td>";
                                                    if(empty($diseases)){
                                                        echo "<td>";
                                                        ?>
                                                        <form method="POST" action="<?php echo 'search_for_patient.php?to=update' ?>">

<input type="text" name="ssn" hidden value="<?php echo $patient_data['p_ssn'] ?>">
                                                        <input type="text" name="empty" hidden value="<?php echo 'empty' ?>">
                                                            <button class="btn btn-primary d-block m-auto mt-5">  إضافه مرض</button>
                                                        </form>
                                                        <?php 
                                                        echo "</td>";

                                                    }else{
                                                        echo "<td>";
                                                        ?>
                                                        <form method="POST" action="<?php echo 'search_for_patient.php?to=update' ?>">
                                                            <input type="text" name="ssn" hidden value="<?php echo $patient_data['p_ssn'] ?>">
                                                            <input type="text" name="empty" hidden value="<?php echo 'full' ?>">
                                                            <button class="btn btn-primary d-block m-auto mt-5">تعديل بيانات المرض</button>
                                                        </form>
                                                        <?php 
                                                        echo "</td>";

                                                    }
                                                    echo "<td>
                                                    <a href='delete.php?from=patient&id=".$patient_data['p_ssn']."&from=patient'
                                                    class='btn deletebtn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                                    
                                                    echo "</td>";?>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php 
// ================== start all gov page ======================

    
        
       
}}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}

?>




<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();