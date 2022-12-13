<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - ملبين طلبات التبرع   ";
include "init.php";
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 

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
      if(in_array("going_donners",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

                        <div class="tableOfHosters table-responsive">
                            
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">ملبين طلبات التبرع   </li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                ملبين طلبات التبرع   
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
                                        <th>رقم الطلب   </th>
                                        <th>اسم المرسل  </th>
                                        <th>المكان</th>
                                        <th>فصيله الدم</th>
                                        <th>عدد الاكياس</th>
                                        <th>المتطوعين</th>
                                        <th>الرساله</th>
                                        <th>الوقت</th>
                                                         
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>رقم الطلب   </th>
                                        <th>اسم المرسل  </th>
                                        <th>المكان</th>
                                        <th>فصيله الدم</th>
                                        <th>عدد الاكياس</th>
                                        <th>المتطوعين</th>
                                        <th>الرساله</th>
                                        <th>الوقت</th>
                                              
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_requests = getAllData("quick_request");
                                           foreach($all_requests as $request_data){
                                               $place = select_by_id('donate_places',$request_data['place_id']);
                                               $user_data =select_user_by_id('patients_donors',$request_data['p_ssn']);
                                               $blood = select_by_id('blood_type',$request_data['blood_type']);


                                              
                                                 	
                                            echo"<tr>";
                                                 echo "<td>".  $request_data['id']      	."</td>";
                                                echo "<td>".  $user_data['p_first_name'] . " " .  $user_data['p_last_name']    	."</td>";
                                                echo "<td>".  $place['place_name']  	."</td>";
                                                
                                                echo "<td>".  $blood['name']  	."</td>";
                                                echo "<td>".  $request_data['blood_bags_number']  	."</td>";
                                                $donners = getAllData('going_donners');
                                                echo "<td>" ;
                                                $x=0;
                                                foreach($donners as $data){
                                                    if($data['request_id'] == $request_data['id']){
                                                        $donner_data =select_user_by_id('patients_donors',$data['donner_id']);
                                                        echo "[" . $donner_data['p_first_name'] ." ".$donner_data['p_last_name'] ." => ". $donner_data['mobile_phone'] ."]<br>";
                                                        $x++;
                                                    }
                                                }
                                                if($x == 0){
                                                    echo "لم يتطوع احد بعد";
                                                }
                                                echo "</td>";
                                                echo "<td>".  $request_data['message']  	."</td>";
                                                
                                                
                                                echo "</td>";
                                                echo "<td>".  $request_data['time']      	."</td>";
                                               
                                
                                                echo "</tr>";?>
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

<?php }else{
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