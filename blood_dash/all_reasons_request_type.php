<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع اسباب التبرع / انواع طلبات التبرع";
include "init.php";
if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
// if(isset($_SESSION['role'])){
    // if(in_array("all_admin",$data_ex)){
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
      if(in_array("all_req_type",$roles) || in_array("all_reason",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

            
            <?php 
                    if(isset($_GET['to']) && strlen($_GET['to'])==6 && $_GET['to'] = "reason"){
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_reasons_requests_type.php?to=reason">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة سبب للتبرع  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع اسباب التبرع</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع اسباب التبرع
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
                                            <th>رقم السبب</th>
                                            <th>سبب التبرع</th>             
                                            <th>تعديل السبب</th>             
                                            <th>حذف السبب</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم السبب</th>
                                            <th>سبب التبرع</th>             
                                            <th>تعديل السبب</th>             
                                            <th>حذف السبب</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $reasons = getAllData("donate_reasons");
                                           foreach($reasons as $reason_data){
                                            echo"<tr>";
                                                echo "<td>".  $reason_data['id']  	."</td>";
                                                echo "<td>".  $reason_data['reason']      	."</td>";
                                                echo "<td>
                                                <a href='update_reasons_requests_type.php?to=reason&id=".$reason_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=reasons&id=".$reason_data['id']."'
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

                    <?php }else{ ?>

                        <div class="tableOfHosters table-responsive">
                            <a href="add_reasons_requests_type.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة نوع طلب التبرع  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع انواع طلبات التبرع</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع انواع طلبات التبرع
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
                                            <th>رقم نوع الطلب</th>
                                            <th>نوع الطلب</th>             
                                            <th>تعديل نوع الطلب</th>             
                                            <th>حذف نوع الطلب</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم نوع الطلب</th>
                                            <th>نوع الطلب</th>             
                                            <th>تعديل نوع الطلب</th>             
                                            <th>حذف نوع الطلب</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $req_type = getAllData("request_blood_type");
                                           foreach($req_type as $req_type_data){
                                            echo"<tr>";
                                                echo "<td>".  $req_type_data['id']  	."</td>";
                                                echo "<td>".  $req_type_data['type']      	."</td>";
                                                echo "<td>
                                                <a href='update_reasons_requests_type.php?to=req_type&id=".$req_type_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=request_type&id=".$req_type_data['id']."'
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

                    <?php }?>
                </main>

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
    ?>
</div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();