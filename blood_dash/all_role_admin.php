<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع الصلاحيات / المسئولين";
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
      

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

            
            <?php 
                    if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
                        if(in_array("all_role",$roles)){
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_role_admin.php?to=role">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة صلاحيه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الصلاحيات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الصلاحيات
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
                                            <th>رقم الصلاحيه</th>
                                            <th>اسم الصلاحيه</th>             
                                            <th>الصلاحيات</th>             
                                            <th>تعديل الصلاحيه</th>             
                                            <th>حذف الصلاحيه</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الصلاحيه</th>
                                            <th>اسم الصلاحيه</th>
                                            <th>الصلاحيات</th>
                                            <th>تعديل الصلاحيه</th>             
                                            <th>حذف الصلاحيه</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_roles = getAllData("role");
                                           foreach($all_roles as $role_data){
                                            echo"<tr>";
                                                echo "<td>".  $role_data['id']  	."</td>";
                                                echo "<td>".  $role_data['role_name']      	."</td>";
                                                $data_ex = explode("/",$role_data['authentications']);
                                                $data_im = implode("  ,  ",$data_ex);
                                                echo "<td>".  $data_im     	."</td>";
                                                echo "<td>
                                                <a href='update_role_admin.php?to=role&id=".$role_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=role&id=".$role_data['id']."'
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
                    }
                        ?>

                    <?php }else{
      if(in_array("all_admin",$roles)){
                        
                        ?>

                        <div class="tableOfHosters table-responsive">
                            <a href="add_role_admin.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة مسئول  <i class='bx bxs-user-plus'></i></button></a>
                            <main>

                        <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المسئولين</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المسئولين
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
                                            <th>اسم المسئول</th>       
                                            <th>البريد الالكتروني</th>      
                                            <th>الصلاحيه</th>
                                            <th>مكان العمل</th>      
                                            <th>تعديل البيانات</th>             
                                            <th>حذف البيانات</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>الرقم القومي</th>
                                            <th>اسم المسئول</th>
                                            <th>البريد الالكتروني</th>
                                            <th>الصلاحيه</th>
                                            <th>مكان العمل</th>      
                                            <th>تعديل البيانات</th>             
                                            <th>حذف البيانات</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_admin = getAllData("admins");
                                           foreach($all_admin as $admin_data){
                                            echo"<tr>";
                                                echo "<td>".  $admin_data['admin_ssn']  	."</td>";
                                                echo "<td>".  $admin_data['admin_first_name'] . " " .  $admin_data['admin_last_name']    	."</td>";
                                                echo "<td>".  $admin_data['email']  	."</td>";
                                                $admin_role = select_by_id("role" ,$admin_data['role_id']);
                                                echo "<td>".  $admin_role['role_name']  	."</td>";
                                                $admin_place = select_by_id("donate_places" ,$admin_data['work_place']);
                                                echo "<td>".  $admin_place['place_name']  	."</td>";
                                                echo "<td>
                                                <a href='update_role_admin.php?id=".$admin_data['admin_ssn']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=admins&id=".$admin_data['admin_ssn']."'
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
                    }}?>
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