<?php    
session_start();
ob_start();
$page_name = " -  فصائل الدم والقاحات المتوفره";
include "init.php";
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
if(isset($_SESSION['admin_ssn'])){ 
$roles= explode("/",$role_data['authentications']) ; 
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
             if(isset($_GET['to']) && strlen($_GET['to'])==18 && $_GET['to'] = "add_availble_blood"){
      if(in_array("all_avilable_blood",$roles)){

        ?>
       
                        <div class="tableOfHosters table-responsive">
                            <a href="add_blood_vaccine.php?to=add_avilable_blood">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة فصائل دم متوفره  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">الفصائل المتوفره </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الفصائل المتوفره</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الفصائل المتوفره
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
                                        <th>اسم فصيله الدم  </th>
                                        <th>المكان</th>
                                        <th>تم إضافته بواسطه</th>
                                        <th>الكميه</th>
                                        <th>السعر</th>
                                        <th>الوقت</th>
                                        <th>تعديل</th>
                                        <th>حذف</th>
                                                         
                                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>اسم فصيله الدم  </th>
                                        <th>المكان</th>
                                        <th>تم إضافته بواسطه</th>
                                        <th>الكميه</th>
                                        <th>السعر</th>
                                        <th>الوقت</th>
                                        <th>تعديل</th>
                                        <th>حذف</th>
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_available_blood = getAllData("avilable_blood");
                                           foreach($all_available_blood as $blood_data){
                                               $place =getData_with_id('donate_places',$blood_data['place_id']);
                                               $admin_data =select_admin_by_id('admins',$blood_data['admin_ssn']);
                                               $blood_name =select_by_id('blood_type',$blood_data['blood_type_id']);
                                                 	
                                            echo"<tr>";
                                                echo "<td>".  $blood_name['name']  	."</td>";
                                                echo "<td>".  $place['place_name']      	."</td>";
                                                echo "<td>".  $admin_data['admin_first_name'] . " " .  $admin_data['admin_last_name']    	."</td>";
                                                echo "<td>".  $blood_data['amount']      	."</td>";
                                                echo "<td>".  $blood_data['price']  	."</td>";
                                                echo "<td>".  $blood_data['time']      	."</td>";
                                                echo "<td>
                                                <a href='update_vaccine_blood.php?id=".$blood_data['id']."&to=add_avilable_blood'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=avilable_blood&id=".$blood_data['id']."'
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
             }else{ 
      if(in_array("all_avilable_vaccine",$roles)){
                 
                 ?>
                <div class="tableOfHosters table-responsive">
                            <a href="add_blood_vaccine.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة لقاح متوفر  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">اللقاحات </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع اللقاحات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع اللقاحات
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
                                        <th>الاسم التجاري للقاح</th>
                                        <th>الاسم العلمي للقاح</th>
                                        <th>بلد المنشأ</th>
                                        <th>مكان اللقاح</th>
                                        <th>تم إضافته بواسطه</th>
                                        <th>الكميه</th>
                                        <th>السعر</th>
                                        <th>الوقت</th>            
                                        <th>تعديل</th>            
                                        <th>حذف</th>            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>الاسم التجاري للقاح</th>
                                        <th>الاسم العلمي للقاح</th>
                                        <th>بلد المنشأ</th>
                                        <th>مكان اللقاح</th>
                                        <th>تم إضافته بواسطه</th>
                                        <th>الكميه</th>
                                        <th>السعر</th>
                                        <th>الوقت</th>  
                                        <th>تعديل</th>  
                                        <th>حذف</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                            $all_vaccines = getAllData("avilable_vaccines");
                                            foreach($all_vaccines as $vaccine_data){
                                                $vaccine =getData_with_id('vaccines',$vaccine_data['vaccine_id']);
                                                $country =getData_with_id('country',$vaccine_data['country_id']);
                                                $place =getData_with_id('donate_places',$vaccine_data['vaccine_place_id']);
                                                $admin_data =select_admin_by_id('admins',$vaccine_data['admin_ssn']);
                                             echo"<tr>";
                                                 echo "<td>".  $vaccine['trade_name']."</td>";
                                                 echo "<td>".  $vaccine['scientific_name']      	."</td>";
                                                 echo "<td>".  $country['name']  	."</td>";
                                                 echo "<td>".  $place['place_name']      	."</td>";
                                                 echo "<td>".  $admin_data['admin_first_name'] . " " .  $admin_data['admin_last_name']    	."</td>";
                                                 echo "<td>".  $vaccine_data['amount']      	."</td>";
                                                 echo "<td>".  $vaccine_data['price']  	."</td>";
                                                 echo "<td>".  $vaccine_data['time']      	."</td>";
                                                 echo "<td>
                                                 <a href='update_vaccine_blood.php?id=".$vaccine_data['id']."'
                                                 class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                 echo "<td>
                                                 <a href='delete.php?from=avilable_vaccine&id=".$vaccine_data['id']."'
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
            }}

                    




require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();