<?php
session_start();
ob_start();
if(isset($_SESSION['admin_ssn'])){ 
// ================== start update reasons page ======================

if(isset($_GET['to']) && isset($_GET['id']) && is_numeric($_GET['id']) && strlen($_GET['to'])==6 && $_GET['to'] = "reason"){
  $page_name = " - تعديل سبب للتبرع";
  include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
  // if(isset($_SESSION['role'])){
    $reason_id = $_GET['id'];
    $reason_data = getData_with_id("donate_reasons",$reason_id);
    require './layout/topNav.php';
    if(in_array("all_reasons_requests",$roles)){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $reason      = FILTER_VAR( $_POST['reason'], FILTER_SANITIZE_STRING);
    
        if(empty($reason)||strlen($reason)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال السبب بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $reason_error="border border-danger";
        }
        if(empty($formErrors)){
            /*check if info already added*/
    
            global $con;
            $stmt = $con->prepare("SELECT * donate_reasons WHERE reason = ?");
            $stmt->execute(array($reason));
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
            if ($count){
                echo "
                    <script>
                        toastr.error('عفوا .. السبب المسجل موجود بالفعل مسبقا')
                    </script>";
            }
            else{
                update_reason($reason,$reason_id);
            }  
        }
    }
        if (isset($formErrors)){ 
        foreach($formErrors as $error){
            echo $error;
        }
    }
    ?>
    <div id="layoutSidenav">     
        <?php 
          require './layout/sidNav.php';
    
        ?> 
        <div id="layoutSidenav_content">
            <div class="container-fluid ">
                <div class="allContent">
                <div class="container mainAddForm">
                    <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                    <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل سبب التبرع </p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                    
                        <div style="direction: rtl !important;text-align: right;" class="row">
                        <!-- reason-->
                            <div style="margin-bottom:15px !important;" class="col-md-6 m-auto col-xs-12">
                                <label for="reason">ادخال سبب التبرع</label>
                                <input type="text" class="form-control <?php echo $reason_error;?>" id="reason" 
                                    placeholder="ادخل سبب التبرع" value="<?php if(isset($reason)){ echo $reason;}else{echo $reason_data["reason"]; } ?>" name="reason" autocomplete="off">
                            </div>
                        </div>
    
                        <!--btn -> update--->
                        <button class="btn btn-primary d-block m-auto mt-5">تعديل سبب التبرع</button>
                    </form>
                    </div>
                </div>
          </div>
        </div>
    </div>
  <?php
  // ================== End update reasons page ======================
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}
  }elseif(isset($_GET['to']) && isset($_GET['id']) && is_numeric($_GET['id']) && strlen($_GET['to'])==1 && $_GET['to'] = "req_type"){



    $page_name = " - تعديل نوع طلب الدم";
    include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
    // if(isset($_SESSION['role'])){
      $req_id = $_GET['id'];
      $request_type_data = getData_with_id("request_blood_type",$req_id);
      require './layout/topNav.php';
      if(in_array("all_reasons_requests_type",$roles)){

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          $req_type      = FILTER_VAR( $_POST['req_type'], FILTER_SANITIZE_STRING);
      
          if(empty($req_type)||strlen($req_type)<3 ){
              $formErrors[] = "
              <script>
                  toastr.error('من فضلك تاكد من ادخال السبب بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
              </script>";
              $req_type_error="border border-danger";
          }
          if(empty($formErrors)){
              /*check if info already added*/
      
              global $con;
              $stmt = $con->prepare("SELECT * request_blood_type WHERE type = ?");
              $stmt->execute(array($req_type));
              $rows = $stmt->fetch(PDO::FETCH_ASSOC);
              $count = $stmt->rowCount();
              if ($count){
                  echo "
                      <script>
                          toastr.error('عفوا .. السبب المسجل موجود بالفعل مسبقا')
                      </script>";
              }
              else{
                  update_req_type($req_type,$req_id);
              }  
          }
      }
          if (isset($formErrors)){ 
          foreach($formErrors as $error){
              echo $error;
          }
      }
      ?>
      <div id="layoutSidenav">     
          <?php 
            require './layout/sidNav.php';
      
          ?> 
          <div id="layoutSidenav_content">
              <div class="container-fluid ">
                  <div class="allContent">
                  <div class="container mainAddForm">
                      <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                      <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                      <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل نوع طلب التبرع</p>
                      <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                      
                          <div style="direction: rtl !important;text-align: right;" class="row">
                          <!-- reason-->
                              <div style="margin-bottom:15px !important;" class="col-md-6 m-auto col-xs-12">
                                  <label for="req_type">ادخال نوع طلب التبرع</label>
                                  <input type="text" class="form-control <?php echo $req_type_error;?>" id="req_type" 
                                      placeholder="ادخل نوع طلب التبرع" value="<?php if(isset($req_type)){ echo $req_type;}else{echo $request_type_data["type"]; } ?>" name="req_type" autocomplete="off">
                              </div>
                          </div>
      
                          <!--btn -> update--->
                          <button class="btn btn-primary d-block m-auto mt-5">تعديل نوع طلب التبرع</button>
                      </form>
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
  }else{
      header("Location:admin_dash.php");
  }


require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>