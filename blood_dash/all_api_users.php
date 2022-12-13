<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع مستخدمين البيانات";
include "init.php";
if(isset($_SESSION['admin_ssn'])){ 
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
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    
    $roles= explode("/",$role_data['authentications']) ;
    if(in_array("all_api_users",$roles)){
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

                        <div class="tableOfHosters table-responsive">
                            <a href="add_api_user.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة مستخدم بيانات<i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع مستخدمين البيانات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع مستخدمين البيانات
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
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th>             
                                            <th>كود المستخدم</th>             
                                            <th>أضيف بواسطة</th>             
                                            <th>وقت الاضافة</th>             
                                            <th>تعديل المستخدم</th>             
                                            <th>حذف المستخدم</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th>             
                                            <th>كود المستخدم</th>             
                                            <th>أضيف بواسطة</th>             
                                            <th>وقت الاضافة</th>             
                                            <th>تعديل المستخدم</th>             
                                            <th>حذف المستخدم</th>    
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $api_user = all_api_users();
                                           foreach($api_user as $user_data){
                                            echo"<tr>";
                                                echo "<td>".  $user_data['id']  	."</td>";
                                                echo "<td>".  $user_data['user_name']      	."</td>";
                                                echo "<td>".  $user_data['auth_code']      	."</td>";
                                                echo "<td>".  $user_data['f_name'] . " " . $user_data['l_name']	."</td>";
                                                echo "<td>".  $user_data['time']      	."</td>";
                                                echo "<td>
                                                <a href='update_api_user.php?id=".$user_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=api_users&id=".$user_data['id']."'
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

                </main>

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
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();