<?php    
ob_start();
session_start();
$page_name = " - جميع مراكز بنك الدم";
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
      if(in_array("all_place",$roles)){
      
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

<?php 
// ================== start all gov page ======================

    
        
        ?>
        <div class="tableOfHosters table-responsive">
            <a href="add_donate_places.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة مركز جديد  <i class='bx bxs-user-plus'></i></button></a>
            <main>

    <div class="container-fluid">
        <h1 class="mt-4">مراكز بنك الدم </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active">جميع مراكز بنك الدم</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    جميع مراكز بنك الدم
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
                            <th>رقم المركز</th>
                            <th>اسم المركز</th>             
                            <th>اسم مدير المركز</th>             
                            <th>المحافظه</th>             
                            <th>المدينه</th>             
                            <th>يفتح في</th>             
                            <th>يغلق في</th>             
                            <th>يوم العطله</th>             
                            <th>تعديل</th>             
                            <th>حذف</th>             
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>رقم المركز</th>
                            <th>اسم المركز</th>             
                            <th>اسم مدير المركز</th>             
                            <th>المحافظه</th>             
                            <th>المدينه</th>             
                            <th>يفتح في</th>             
                            <th>يغلق في</th>             
                            <th>يوم العطله</th>             
                            <th>تعديل</th>             
                            <th>حذف</th>  
                        </tr>            
                    </tfoot>
                        <tbody>
                            <?php 
                            $all_places = get_all_donate_places_info();
                            foreach($all_places as $place_data){
                            echo"<tr>";
                                echo "<td>".  $place_data['id']  	."</td>";
                                echo "<td>".  $place_data['place_name']      	."</td>";
                                echo "<td>".  $place_data['place_manager']      	."</td>";
                                echo "<td>".  $place_data['governorate_name']      	."</td>";
                                echo "<td>".  $place_data['city_name']      	."</td>";
                                echo "<td>".  $place_data['open_at']      	."</td>";
                                echo "<td>".  $place_data['close_at']      	."</td>";
                                echo "<td>".  $place_data['holiday']      	."</td>";
                                echo "<td>
                                <a href='update_donate_places.php?id=".$place_data['id']."'
                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                echo "<td>
                                <a href='delete.php?from=places&id=".$place_data['id']."'
                                class='btn deletebtn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                
                                echo "</td>";?>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
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
    // ================== end all gov page ======================


require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();