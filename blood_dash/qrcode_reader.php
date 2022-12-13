<?php
session_start();
ob_start(); 
$page_name = "-  تسليم الطلبات";
$style = "dash-buy-blood.css";
global $name;
global $order;
global $place_name;
global $amount;
global $ex_code;
$name = "لا يوجد";
$order = "لا يوجد";
$place_name = "لا يوجد";
$amount = "لا يوجد";
include 'init.php';




$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
$roles= explode("/",$role_data['authentications']) ; 
if(isset($_SESSION['admin_ssn'])){ 
    require './layout/topNav.php';
    if(in_array("qrcode_reader",$roles)){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])){
        if($ex_code[0] == "blood"){
          $stmt = $con->prepare("DELETE FROM purchase_order WHERE id = :order_id");
        $stmt->bindParam(":order_id" , $_POST['order_id']);
        $stmt->execute();
        header("Location:qrcode_reader.php");
        }else{
          $stmt = $con->prepare("DELETE FROM order_vaccine WHERE order_id = :order_id");
          $stmt->bindParam(":order_id" , $_POST['order_id']);
          $stmt->execute();
          header("Location:qrcode_reader.php");

        }
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qrcode'])){
        $qrcode      = FILTER_VAR( $_POST['qrcode'], FILTER_SANITIZE_STRING);
        $ex_code =explode(' | ',$qrcode);
        echo $ex_code[0];
        echo $ex_code[1];
        if($ex_code[0] == "blood"){
          $api_url = 'https://blood-bank.life/api/api/v1/purchase_order/530504012422/all';
          $json_data = file_get_contents($api_url);
          $response_data = json_decode($json_data);
          $order_data = $response_data->data;
          foreach($order_data as $data){
            if($data->id == $ex_code[1]){
              $id = $data->id;
              $ssn = $data->p_id;
              $type = $data->blood_type;
              $place = $data->delivered_place;
              $amount = $data->amount;
            }
          }
          $p_url = 'https://blood-bank.life/api/api/v1/all_patients_donners_info/530504012422/all';
          $p_json_data = file_get_contents($p_url);
          $p_response_data = json_decode($p_json_data);
          $p_data = $p_response_data->data;
          foreach($p_data as $data){
            if($data->p_ssn == $ssn){
              $name = $data->p_first_name . " " . $data->p_last_name;
            }
          }
          $blood_url = 'https://blood-bank.life/api/api/v1/blood_type/530504012422/all';
          $blood_json_data = file_get_contents($blood_url);
          $blood_response_data = json_decode($blood_json_data);
          $blood_data = $blood_response_data->data;
          foreach($blood_data as $data){
            if($data->id == $type){
              $order = $data->name;
            }
          }
          $place_url = 'https://blood-bank.life/api/api/v1/donate_places/530504012422/all';
          $place_json_data = file_get_contents($place_url);
          $place_response_data = json_decode($place_json_data);
          $place_data = $place_response_data->data;
          foreach($place_data as $data){
            if($data->id == $place){
              $place_name = $data->place_name;
            }
          }
          

        }else{
          $api_url = 'https://blood-bank.life/api/api/v1/order_vaccine/530504012422/all';
          $json_data = file_get_contents($api_url);
          $response_data = json_decode($json_data);
          $order_data = $response_data->data;
          foreach($order_data as $data){
            if($data->order_id == $ex_code[1]){
              $id = $data->order_id;
              $ssn = $data->p_ssn;
              $vaccine = $data->vaccine_id;
              $place = $data->delivered_place;
              $amount = $data->amount;
            }
          }
          $p_url = 'https://blood-bank.life/api/api/v1/all_patients_donners_info/530504012422/all';
          $p_json_data = file_get_contents($p_url);
          $p_response_data = json_decode($p_json_data);
          $p_data = $p_response_data->data;
          foreach($p_data as $data){
            if($data->p_ssn == $ssn){
              $name = $data->p_first_name . " " . $data->p_last_name;
            }
          }
          $vaccine_url = 'https://blood-bank.life/api/api/v1/avilable_vaccines/530504012422/all';
          $vaccine_json_data = file_get_contents($vaccine_url);
          $vaccine_response_data = json_decode($vaccine_json_data);
          $vaccine_data = $vaccine_response_data->data;
          foreach($vaccine_data as $data){
            if($data->id == $vaccine){
              $vaccine_id = $data->vaccine_id;
            }
          }
          $vaccine_name_url = 'https://blood-bank.life/api/api/v1/vaccines/530504012422/all';
          $vaccine_name_json_data = file_get_contents($vaccine_name_url);
          $vaccine_name_response_data = json_decode($vaccine_name_json_data);
          $vaccine_name_data = $vaccine_name_response_data->data;
          foreach($vaccine_name_data as $data){
            if($data->id == $vaccine_id){
              $order= $data->trade_name . " [ " . $data->scientific_name . " ] ";
            }
          }
          $place_url = 'https://blood-bank.life/api/api/v1/donate_places/530504012422/all';
          $place_json_data = file_get_contents($place_url);
          $place_response_data = json_decode($place_json_data);
          $place_data = $place_response_data->data;
          foreach($place_data as $data){
            if($data->id == $place){
              $place_name = $data->place_name;
            }
          }
          
        }
        
      }
        ?>
        <script src="layout/js/html5-qrcode.min.js"></script>
<style>
    .font-lg{
        font-size:1.5rem;
        font-weight:600;
        margin: 10px 0;
    }
    .font-lg + h3{
        background:#ff3f62;
        color:#fff;
        width:200px;
        margin-right:40px;
        border-radius:10px;
        padding: 5px 10px;
        text-align:center;
    }
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  #reader{
    margin-top:10%!important;
    height: 100%!important;
    width:100%!important;
    border:none!important;
  }
  #reader__header_message{
      margin-top:52px !important;
  }
  #reader__scan_region{
      padding:20px;
      overflow: hidden!important;
  }
  
  #reader__scan_region video{
      width:90%;
  }
  #reader__dashboard_section #reader__dashboard_section_csr div button{
    background: #ff3f62!important;
    color: #fff!important;
    border-radius: 10px!important;
    border: none!important;
    padding: 10px 20px!important;
    margin: 10px 5px!important;
  }
  #reader__dashboard_section_swaplink{
      margin: 20px!important;
      text-decoration:none!important;
      font-size:17px!important;
      font-weight:600!important;
  }
  span{
    font-size:1.1rem!important;
      float: right!important;
      padding:5px 15px!important;
     
  }
  span a{
    text-decoration:none!important;
      color: #ff3f62!important;
      font-size:1.5rem!important;
      font-weight:600!important;
  }
  span#reader__status_span{
      float:left!important;
      padding:5px 15px!important;
    
  }
  .row{
    display:flex;
  }
  #reader div:first-child{
      height: 50px!important;
  }
  #reader__dashboard_section_swaplink{
      display:block!important;
  }
  #reader__dashboard_section_csr span button{
    background: #ff3f62!important;
    color: #fff!important;
    border-radius: 10px!important;
    border: none!important;
    padding: 10px 20px!important;
    margin: 10px 5px!important;
  }
  #request.btn.btn-send.my-2 و#request1{
    font-size:1.5rem!important;
    /* margin-left:20px!important; */
  }
</style>
<div id="layoutSidenav">
    <?php 
      require './layout/sidNav.php';

    ?> 
    <div id="layoutSidenav_content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12 my-sm-3">
            <div style="width:500px;background:#fff;border-radius:10px;" id="reader"></div>
              </div>
                <div class="col-md-6 col-sm-12 " style="padding:30px;text-decoration: rtl;">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    
                    <h1 class="mb-5">استلام الطلبات</h1>
                    <input type="text" id="result" name="qrcode" class="d-none my-5">
                    <div class="details mt-5 row justify-content-center">
                        <h2 class="col-12 text-center my-3"><?php echo $name;
                        ?></h2>
                        <label for="" class="font-lg text-center">الطلب</label>
                        <h3 class="mb-3 col-12 py-2 "><?php echo $order; ?></h3>
                        <label for="" class="font-lg text-center">مكان الاستلام</label>
                        <h3 class="mb-3 col-12 py-2 "><?php echo $place_name; ?></h3>
                        <label for="" class="font-lg">الكميه</label>
                        <h3 class="mb-3 col-12 py-2 "><?php echo $amount; ?></h3>
                        <button id="request" type="submit" class="btn btn-send my-2 mx-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">عرض البيانات  </button>
                      </form>
                      <form action="finish_order.php" method="post">
                      <input type="text" name="order_id" class="d-none" value="<?php echo $ex_code[1] ?>">
                        <button id="request1" type="submit" class="btn btn-send my-2 mx-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">تم الاستلام   </button>
                        
                  </form>
                      
                </div>
              </div>
            </div>
            <script type="text/javascript">
              
            // To Check The Amount Of Blood  Bags
            


            
              
            

                
            // }
            function onScanSuccess(qrCodeMessage) {
                document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
                console.log(qrCodeMessage);
                document.getElementById("result").value = qrCodeMessage;
            }
            function onScanError(errorMessage) {
              //handle scan error
            }
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanError);



            </script>
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