<?php    
ob_start();
session_start();
$page_name = " - جميع المحافظات والمدن";
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
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

        <?php 
                // ================== start all gov page ======================

                    if(isset($_GET['to']) && strlen($_GET['to']) == 3 && $_GET['to'] = "gov"){
      if(in_array("all_gov_city",$roles)){
                        
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_gov_city.php?to=gov">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة محافظه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">المحافظات </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المحافظات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المحافظات
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
                                            <th>رقم المحافظه</th>
                                            <th>اسم المحافظه</th>             
                                            <th>تعديل</th>             
                                            <th>حذف</th>             
                                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المحافظه</th>
                                            <th>اسم المحافظه</th> 
                                            <th>تعديل</th>             
                                            <th>حذف</th>      
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_govs = getAllData("governorate");
                                           foreach($all_govs as $gov_data){
                                            echo"<tr>";
                                                echo "<td>".  $gov_data['id']  	."</td>";
                                                echo "<td>".  $gov_data['name']      	."</td>";
                                                echo "<td>
                                                <a href='update_gov_city.php?id=".$gov_data['id']."&to=gov'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=gov&id=".$gov_data['id']."'
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
                    // ================== end all gov page ======================
                    // ================== start all country page ======================
                                           }else{
                                            echo "
                                            <script>
                                            toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
                                            </script>";
                                            header("Refresh:1;url=admin_dash.php");
                                           }
                    }elseif(isset($_GET['to']) && strlen($_GET['to'])==7 && $_GET['to'] = "country"){
      if(in_array("all_country",$roles)){

                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_gov_city.php?to=country">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة بلد  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">البلاد </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع البلاد</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع البلاد
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
                                            <th>رقم البلد</th>
                                            <th>اسم البلد</th>        
                                            <th>تعديل</th>             
                                            <th>حذف</th>           
                                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم البلد</th>
                                            <th>اسم البلد</th> 
                                            <th>تعديل</th>             
                                            <th>حذف</th>      
                                              
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_countries = getAllData("country");
                                           foreach($all_countries as $country_data){
                                            echo"<tr>";
                                                echo "<td>".  $country_data['id']  	."</td>";
                                                echo "<td>".  $country_data['name']      	."</td>";
                                                echo "<td>
                                                <a href='update_gov_city.php?id=".$country_data['id']."&to=country'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=country&id=".$country_data['id']."'
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
                    // ================== end all country page ======================
                    // ================== start all city page ======================
                                           }else{
                                            echo "
                                            <script>
                                            toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
                                            </script>";
                                            header("Refresh:1;url=admin_dash.php");
                                           }
                    }else{
      if(in_array("all_gov_city",$roles)){

                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_gov_city.php?to=city">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة مدينه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">المدن </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المدن</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المدن
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
                                            <th>رقم المدينه</th>
                                            <th>اسم المدينه</th>  
                                            <th>اسم المحافظه</th>     
                                            <th>تعديل</th>             
                                            <th>حذف</th>              
                                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المدينه</th>
                                            <th>اسم المدينه</th>
                                            <th>اسم المحافظه</th>   
                                            <th>تعديل</th>             
                                            <th>حذف</th>      
                                              
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_cities = getAllData("cities");
                                           foreach($all_cities as $city_data){
                                                // echo "<td>".  $city_data['name']      	."</td>";
                                               $gov_name = getData_with_id("governorate",$city_data['gov_id']);
                                            echo"<tr>";
                                                echo "<td>".  $city_data['id']  	."</td>";
                                                echo "<td>".  $city_data['name']      	."</td>";
                                                echo "<td>".  $gov_name['name']      	."</td>";
                                                echo "<td>
                                                <a href='update_gov_city.php?id=".$city_data['id']."&gov=".$city_data['gov_id']."&to=city'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=city&id=".$city_data['id']."'
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
                    // ================== end all city page ======================
                                           }else{
                                            echo "
                                            <script>
                                            toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
                                            </script>";
                                            header("Refresh:1;url=admin_dash.php");
                                           }
                    }

                    ?>
    </div>
      </div>
        </div>






<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();