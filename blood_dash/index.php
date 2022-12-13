<?php 
    @session_start();
    $page_name = " - تسجيل الدخول   ";
    $style='login.css';
    include "init.php";
    if(isset($_SESSION['admin_ssn'])){
        header("Location:admin_dash.php");
    }else{
    if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $admin_ssn = filter_var($_POST["ssn"] , FILTER_SANITIZE_EMAIL);
    $hased = $_POST['password'];
    if(strlen((string)$_POST["ssn"])<14 || empty($_POST["ssn"] || !is_numeric($_POST["ssn"]))){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال الرقم القومي بطريقه صحيحه وكامله')
        </script>";
        $ssn_error="border border-danger ssn_border";
    }
    if(empty($_POST['password'])||strlen($_POST['password'])<5 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه (يجب ان تكون اكثر من 5 حروف')
        </script>";
        $password_error="border border-danger ssn_border";
    }
    if(empty($formErrors)){
    check_admin($admin_ssn,$hased);
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="container-fuild">
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="sign-in-form" style="direction: rtl;">
                <img style="width: 10%;display: block;margin: 20px auto" src="img/admin_login.svg" alt="admin_login">
                <h2 class="title"> تسجيل الدخول</h2>
                <div class="input-field <?php echo $ssn_error;?>">
                <i class="fas fa-envelope"></i>
                <input type="text" value="<?php if(isset($admin_ssn)){ echo $admin_ssn;} ?>" name="ssn" placeholder="الرقم القومي" />
                </div>
                <div class="input-field <?php echo $password_error; ?>">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="الرقم السري" />
                </div>
                <input type="hidden" name="state" value="تسجيل الدخول">
                <input type="submit" value="تسجيل الدخول" class="btn solid" />
                
            </form>
        </div>
    </div>
    <div class="col-md-6 order-first login-img d-md-block d-none ">
        <img src="img/undraw_dashboard_re_3b76.svg" class="w-75 ml-5" alt="logo">
    </div>
</div>


<?php }?>