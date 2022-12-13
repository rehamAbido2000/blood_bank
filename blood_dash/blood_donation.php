<?php    
ob_start();
session_start();   
$page_name = " - جميع طلبات التبرع بالدم";
include "init.php";
if(isset($_SESSION['admin_ssn'])){ 

// if(isset($_SESSION['role'])){
    // if(in_array("all_admin",$data_ex)){
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

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
      if(in_array("donate_request",$roles)){
      
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

            <div class="tableOfHosters table-responsive">
                <main>
              
                    <div class="container-fluid">
                        <h1 style="font-family: 'Cairo', sans-serif !important;" class="mt-5">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع طلبات التبرع بالدم</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع طلبات التبرع بالدم
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
                                            <th>المحافظه </th>      
                                            <th> المدينه</th>
                                            <th> مكان التبرع</th>                   
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
                                            <th>المحافظه </th>      
                                            <th> المدينه</th>
                                            <th> مكان التبرع</th>                   
                                            <th>توقيت الطلب</th>             
                                            <th>قبول الطلب</th>             
                                            <th>رفض الطلب</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_donations = getAllData('blood_donation');
                                           foreach($all_donations as $donation_data){
                                               $patient = select_user_by_id('patients_donors',$donation_data['p_ssn']);
                                               $blood_name = select_by_id('blood_type',$patient['blood_type']);
                                               $city = getData_with_id('cities',$donation_data['city_id']);
                                               $gov = getData_with_id('governorate',$city['gov_id']);
                                               $place = getData_with_id('donate_places',$donation_data['donate_place_id']);
                                            echo"<tr>";
                                                echo "<td>".  $donation_data['id']  	."</td>";
                                                echo "<td>".  $patient['p_first_name'] . " " . $patient['p_last_name']      	."</td>";
                                                echo "<td>". "+20" . $patient['mobile_phone']      	."</td>";
                                                echo "<td>".  $blood_name['name']      	."</td>";
                                                echo "<td>".  $gov['name']      	."</td>";
                                                echo "<td>".  $city['name']      	."</td>";
                                                echo "<td>".  $place['place_name']      	."</td>";
                                                echo "<td>".  $donation_data['time']      	."</td>";
                                                echo "<td>
                                                <a href='update_admin.php?id=".$donation_data['id']."'
                                                class='btn editbtn btn-success m-2 px-3'>قبول</a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=admin&id=".$donation_data['id']."&from=role'
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