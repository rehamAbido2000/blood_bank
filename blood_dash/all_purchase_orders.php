<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع طلبات اللقاحات";
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
      if(in_array("buying_request",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

            <div class="tableOfHosters table-responsive">
                <!-- <a href="add_role_admin.php?to=role">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة صلاحيه  <i class='bx bxs-user-plus'></i></button></a> -->
                <main>
              
                    <div class="container-fluid">
                        <h1 style="font-family: 'Cairo', sans-serif !important;" class="mt-5">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع طلبات الشراء</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع طلبات الشراء
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
                                            <th>رقم الطلب</th>
                                            <th>اسم صاحب الطلب</th>             
                                            <th>هاتف صاحب الطلب</th>             
                                            <th>فصيلة الدم</th>             
                                            <th>الكميه المطلوبه</th>      
                                            <th>الكمية المتوفره</th>                   
                                            <th>توقيت الطلب</th>             
                                            <th>قبول الطلب</th>             
                                            <th>رفض الطلب</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>اسم صاحب الطلب</th>
                                            <th>هاتف صاحب الطلب</th>
                                            <th>فصيلة الدم</th>
                                            <th>الكميه المطلوبه</th>
                                            <th>الكمية المتوفره</th>
                                            <th>توقيت الطلب</th>
                                            <th>قبول الطلب</th>             
                                            <th>رفض الطلب</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_v_req = all_purchase_orders();
                                           foreach($all_v_req as $vac_requests){
                                            echo"<tr>";
                                                echo "<td>".  $vac_requests['id']  	."</td>";
                                                echo "<td>".  $vac_requests['patient_first_name'] . " " . $vac_requests['patient_last_name']      	."</td>";
                                                echo "<td>". "+20" . $vac_requests['patient_phone']      	."</td>";
                                                echo "<td>".  $vac_requests['blood_name']      	."</td>";
                                                echo "<td>".  $vac_requests['amount']      	."</td>";
                                                echo "<td>".  $vac_requests['blood_amount']      	."</td>";
                                                echo "<td>".  $vac_requests['time']      	."</td>";
                                                echo "<td>
                                                <a href='update_admin.php?id=".$vac_requests['id']."'
                                                class='btn editbtn btn-success m-2 px-3'>قبول</a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=purchase_order&id=".$vac_requests['id']."'
                                                class='btn deletebtn btn-danger m-2 px-3'>رفض</a> " . "</td>";
                                
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