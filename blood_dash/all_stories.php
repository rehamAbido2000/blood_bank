<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع القصص ";
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
      if(in_array("all_stories",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

                        <div class="tableOfHosters table-responsive">
                            
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع القصص </li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع القصص 
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
                                            <th> الاسم</th>             
                                            <th>القصه </th>             
                                            <th>حذف القصه</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>الرقم القومي</th>
                                            <th> الاسم</th>             
                                            <th>القصه </th>             
                                            <th>حذف القصه</th>    
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $story = getAllData("stories");
                                           foreach($story as $data){
                                               echo"<tr>";
                                               $p_data = select_user_by_id('patients_donors',$data['p_ssn']);
                                                // echo "<pre>";
                                                // print_r($p_data);
                                                // echo "</pre>";

                                                echo "<td>".  $p_data['p_ssn']      	."</td>";
                                                echo "<td>".  $p_data['p_first_name'] . " " . $p_data['p_last_name'] ."</td>";
                                                echo "<td>".  $data['content']      	."</td>";
                                                
                                                echo "<td>
                                                <a href='delete.php?from=story&id=".$data['id']."'
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