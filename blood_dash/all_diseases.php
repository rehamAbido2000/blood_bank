<?php    
ob_start();
session_start();
$page_name = " - جميع الامراض";
include "init.php";
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

if(isset($_SESSION['admin_ssn'])){ 
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
      if(in_array("all_diseas",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

<?php 
// ================== start all gov page ======================

    
        
        ?>
        <div class="tableOfHosters table-responsive">
            <a href="add_diseases.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة المرض  <i class='bx bxs-user-plus'></i></button></a>
            <main>

    <div class="container-fluid">
        <h1 class="mt-4">الامراض </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active">جميع الامراض</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    جميع الامراض
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
                            <th>رقم المرض</th>
                            <th>اسم المرض</th>
                            <th> تعديل المرض</th>
                            <th>  حذف المرض</th>             
                                        
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>رقم المرض</th>
                            <th>اسم المرض</th>
                            <th> تعديل المرض</th>
                            <th>  حذف المرض</th>
                                
                        </tr>            
                    </tfoot>
                        <tbody>
                            <?php 
                            $all_diseases = getAllData("diseases");
                            foreach($all_diseases as $diseases_data){
                            echo"<tr>";
                                echo "<td>".  $diseases_data['id']  	."</td>";
                                echo "<td>".  $diseases_data['diseases']      	."</td>";
                                echo "<td>
                                <a href='update_diseases.php?id=".$diseases_data['id']."'
                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                echo "<td>
                                <a href='delete.php?from=diseases&id=".$diseases_data['id']."'
                                class='btn deletebtn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                
                                echo "</td>";?>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php }else{
            echo "
            <script>
            toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
            </script>";
            header("Refresh:1;url=admin_dash.php");
            }?>
    </div>

    <?php
    
    // ================== end all gov page ======================


require_once "./includes/template/footer.php";
}else{
    header("Location:admin_login.php");
}
ob_end_flush();