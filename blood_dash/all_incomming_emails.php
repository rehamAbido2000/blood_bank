<?php
    ob_start(); 
    session_start();
    $page_name = " - جميع الرسائل الوارده";
    $style = "messages_page.css";
    require_once "init.php";
    if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 
    // if(isset($_SESSION['role'])){
    require './layout/topNav.php';
    ?>
    <div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
      if(in_array("contact_request",$roles)){

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">
    <div class="container mb-3">
        <img style="display: block;margin: auto;margin-top:50px;margin-bottom:20px" class="add_admin" src="img/icons8-unread-messages-48.png" alt="add_admin">
        <h3 style="font-family: 'Cairo', sans-serif !important;" class="text-center mt-2 mb-3">مرحبا بك في لوحة التحكم الخاصه بالموقع</h3>
        <p class="text-center">من خلال هذه الصفحه يمكنك رؤية جميع الرسائل الوارده</p>

        <?php $allData = getAllData("contact");?>
<div class="row mt-5">
        <?php foreach ($allData as $all_messages){ ?>
<div class="col-md-6">
            <div class="ui cards mb-3 text-center">
                <div class="card">
                    <div class="content">
                    <img style="margin: 20px 0;width:30%" src="img/check.gif" alt="sender">
                    <div class="header pb-3">
                        <?php echo $all_messages["subject"];?>
                    </div>
                    <div class="meta">
                    <?php echo $all_messages["time"];?>
                    </div>
                    <div class="meta">
                    <?php echo $all_messages["sender_email"];?>
                    </div>
                    <div class="meta mb-3">
                    <?php echo "+20" . $all_messages["phone"];?>
                    </div>
                    <div style="overflow-y: auto;height: 70px;" class="description pb-3">
                        <?php echo $all_messages["message"];?>
                    </div>
                    </div>
                    <div class="extra content">
                    <div class="ui two buttons">
                       <a class="ui basic red button" style="text-decoration: none !important;color:#db2828!important" href="delete.php?from=messages&id=<?php echo $all_messages["id"]?>&table=messages"> Delete </a>
                    </div>
                    </div>
                    </div>
                </div>
        </div>
        <?php } ?>
        </div>

            <?php if (count_users("id","contact") == 0){?>
                <p style="margin-top: 100px;font-weight: 700;font-size: 30px;" class="text-danger text-center">* There is No Message To Show *</p>
            <?php } ?>

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
// }else{
//         header("location:signin.php");
//     }
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();