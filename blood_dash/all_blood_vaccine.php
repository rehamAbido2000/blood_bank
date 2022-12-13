<?php    
ob_start();
session_start();   
$page_name = " - حميع فصائل الدم / اللقاحات";

include "init.php";
if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
// if(isset($_SESSION['role'])){
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

            
            <?php 
                    if(isset($_GET['to']) && strlen($_GET['to'])==9 && $_GET['to'] = "add_blood"){
      if(in_array("all_blood",$roles)){

                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_blood_vaccine.php?to=add_blood">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة فصيلة دم  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع فصائل الدم</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع فصائل الدم
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
                                            <th>رقم فصيلة الدم</th>
                                            <th>اسم فصيلة الدم</th>             
                                            <th>تعديل فصيلة</th>             
                                            <th>حذف فصيله</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم فصيلة الدم</th>
                                            <th>اسم فصيلة الدم</th>             
                                            <th>تعديل فصيلة</th>             
                                            <th>حذف فصيله</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_blood_type = getAllData("blood_type");
                                           foreach($all_blood_type as $blood_data){
                                            echo"<tr>";
                                                echo "<td>".  $blood_data['id']  	."</td>";
                                                echo "<td>".  $blood_data['name']      	."</td>";
                                                echo "<td>
                                                <a href='update_vaccine_blood.php?id=".$blood_data['id']."&to=add_blood'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?id=".$blood_data['id']."&from=blood_type'
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

                    <?php }else{
                        echo "
                        <script>
                        toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
                        </script>";
                        header("Refresh:1;url=admin_dash.php");
                    }}else{
      if(in_array("all_vaccine",$roles)){
        ?>
                        <div class="tableOfHosters table-responsive">
                        <a href="add_blood_vaccine.php?to=vaccine_name">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة اسم لقاح جديد  <i class='bx bxs-user-plus'></i></button></a>
                        <main>

                    <div class="container-fluid">
                    <h1 class="mt-4">بنك الدم</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">لوحة التحكم</li>
                        <li class="breadcrumb-item active">جميع اسماء اللقاحات</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                                جميع اسماء اللقاحات
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
                                    <th>الاسم التجاري ل اللقاح</th>
                                    <th>الاسم العلمي ل اللقاح</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>            
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>الاسم التجاري ل اللقاح</th>
                                    <th>الاسم العلمي ل اللقاح</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>  
                                    </tr>            
                                </tfoot>
                                    <tbody>
                                       <?php 
                                        $all_vaccines = getAllData("vaccines");
                                        foreach($all_vaccines as $vaccine_data){
                                         echo"<tr>";
                                             echo "<td>".  $vaccine_data['trade_name']  	."</td>";
                                             echo "<td>".  $vaccine_data['scientific_name']      	."</td>";
                                             echo "<td>
                                             <a href='update_vaccine_blood.php?id=".$vaccine_data['id']."&to=vaccine_name'
                                             class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                             echo "<td>
                                             <a href='delete.php?from=vaccines&id=".$vaccine_data['id']."'
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
                    }else{
                        echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
                    }} ?>
                </main>

          </div>
        </div>
      </div>
    </div>
</div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();