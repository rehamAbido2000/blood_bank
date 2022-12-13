<?php
session_start();
ob_start(); 
$page_name = "- اضافة اخبار";
include 'init.php';
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
$roles= explode("/",$role_data['authentications']) ; 
if(isset($_SESSION['admin_ssn'])){ 
require './layout/topNav.php';
if(in_array("add_news",$roles)){
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title      = FILTER_VAR( $_POST['title'], FILTER_SANITIZE_STRING);
    $desc       = FILTER_VAR( $_POST['desc'], FILTER_SANITIZE_STRING);

    if(empty($title)||strlen($title)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال عنوان الخبر بطريقة صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
        $title_error="border border-danger";
    }
    if(empty($desc)||strlen($desc)<20 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال وصف الخبر بطريقة صحيحه (يجب ان يكون اكثر من 20 حروف')
        </script>";
        $desc_error="border border-danger";
    }
    if(empty($formErrors)){



        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];
        $extention_allowed = array("png","jpg","jpeg");   
        @$extention             = strtolower(end(explode(".",$avatar_name)));
        if(in_array($extention,$extention_allowed)){
            $avatar = $title . "_" . rand(0,1000) . "." . $extention ;
            $destination = "img/news/" . $avatar ;

                /*check if info already added*/

                global $con;
                $stmt = $con->prepare("SELECT * blog WHERE title = ?");
                $stmt->execute(array($title));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. الخبر المسجل موجود بالفعل مسبقا')
                        </script>";
                }
                else{
                    // insert_news($title,$desc,$avatar,$_SESSION["id"]);
                    insert_news($title,$desc,$avatar,$_SESSION['admin_ssn']);
                    move_uploaded_file($tmp_name,$destination);
                }  
        }else{
            echo "
            <script>
            toastr.error('امتداد الصورة غير مصرح به')
            </script>";
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة اخبار جديده</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                    <div style="direction: rtl !important;text-align: right;" class="row">
                    <!-- title-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="title">ادخال عنوان الخبر</label>
                            <input  style="padding-top: 19px !important;padding-bottom: 18px !important;" type="text" class="form-control <?php echo $title_error;?>" id="title" 
                                placeholder="ادخل عنوان الخبر" value="<?php if(isset($title)){ echo $title;} ?>" name="title" autocomplete="off">
                        </div>
                    <!--img-->
                        <div class="col-6 mb-3">
                            <label for="img">صورة الخبر</label>
                            <input type="file" class="form-control" required style="padding-bottom: 32px !important;" id="img" name="img" >
                        </div>
                    <!--description-->
                        <div class=" col-12 mb-4">
                            <label for="des">وصف الخبر</label>
                            <textarea id="des" name="desc" class="form-control <?php echo $desc_error;?>" placeholder="ادخل الوصف التفصيلي للخبر :" rows="4" required autocomplete="off"></textarea>
                        </div>  
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الاخبار</button>
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
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();