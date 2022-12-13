<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="login.css";
$script="login.js";
include "init.php";
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
$all_blood_type = getAllData("blood_type");
$all_gov_data = getAllData('governorate');
$all_gender = getAllData('gender');
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["state"]) && $_POST["state"] == "signin"  )
{

    $p_ssn = filter_var($_POST["signin_ssn"] , FILTER_SANITIZE_EMAIL);
    $hased = $_POST['signin_password'];
    if(strlen((string)$_POST["signin_ssn"])<14 || empty($_POST["signin_ssn"] || !is_numeric($_POST["signin_ssn"]))){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال الرقم القومي بطريقه صحيحه وكامله')
        </script>";
        $ssn_error="border border-danger ssn_border";
    }
    if(empty($_POST['signin_password'])||strlen($_POST['signin_password'])<5 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه (يجب ان تكون اكثر من 5 حروف')
        </script>";
        $password_error="border border-danger ssn_border";
    }
    if(empty($formErrors)){
        check_patient($p_ssn,$hased);
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["state"]) && $_POST["state"] == "signup" ){
    $p_ssn = filter_var($_POST["p_ssn"] , FILTER_SANITIZE_STRING);
        $f_name = filter_var($_POST["f_name"] , FILTER_SANITIZE_STRING);
        $l_name = filter_var($_POST["l_name"] , FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"] , FILTER_SANITIZE_EMAIL);
        $tel1 = filter_var($_POST["tel1"] , FILTER_SANITIZE_STRING);
        $tel2 = filter_var($_POST["tel2"] , FILTER_SANITIZE_STRING);
        $blood_type = filter_var($_POST["blood"] , FILTER_SANITIZE_STRING);
        $gov = filter_var($_POST["Gov_id"] , FILTER_SANITIZE_STRING);
        $city_id = filter_var($_POST["city_id"] , FILTER_SANITIZE_EMAIL);
        $gender_id = filter_var($_POST["gender"] , FILTER_SANITIZE_STRING);
        $birthday = filter_var($_POST["birthday"] , FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["password"] , FILTER_SANITIZE_STRING);
        $hash = password_hash($password , PASSWORD_DEFAULT);
        echo $blood_type ."////" .$city_id;
    /*check if info already added*/

    global $con;
    $stmt = $con->prepare("SELECT * FROM patients_donors WHERE p_ssn = ?");
    $stmt->execute(array($p_ssn));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        echo "
            <script>
                toastr.error('عفوا هذا الرقم القومي موجود بالفعل.')
            </script>";
    }
    else{
        if(empty($f_name)||empty($l_name)||strlen($f_name)<3 ||strlen($l_name)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الاسم بطريقة صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $name_error="border border-danger";
        }
        if(empty($p_ssn)||strlen($p_ssn)<14 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الرقم القومي بطريقة صحيحه (يجب ان يكون مكون من 14 رقم')
            </script>";
            $ssn_error="border border-danger";
        }
        if(empty($password)||strlen($password)<5 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الرقم السري بطريقة صحيحه (يجب ان يكون اكثر من 5 رمز')
            </script>";
            $password_error="border border-danger";
        }
        if(empty($email)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال  البريد الالكتروني بطريقة صحيحه ')
            </script>";
            $email_error="border border-danger";
        }
        if(empty($tel1)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال رقم الهاتف بطريقة صحيحه ')
            </script>";
            $tel1_error="border border-danger";
        }
        if(empty($tel2)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال رقم الهاتف بطريقة صحيحه ')
            </script>";
            $tel2_error="border border-danger";
        }
        if(empty($blood_type)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال فصيله الدم بطريقة صحيحه ')
            </script>";
            $blood_error="border border-danger";
        }
        if(empty($gov)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال المحافظه بطريقة صحيحه ')
            </script>";
            $gov_error="border border-danger";
        }
        if(empty($city_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال المدينه بطريقة صحيحه ')
            </script>";
            $city_error="border border-danger";
        }
        if(empty($gender_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال النوع بطريقة صحيحه ')
            </script>";
            $gender_error="border border-danger";
        }
        if(empty($birthday)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال تاريخ الميلاد بطريقة صحيحه ')
            </script>";
            $birthday_error="border border-danger";
        }
        if(empty($formErrors)){

            if($gender_id == 1){
                $img="man.png";
            }else{
                $img="woman.png";

            }
            insert_patient($p_ssn,$f_name,$l_name,$email,$tel1,$tel2,$hash,$blood_type,$birthday,$gender_id,$img,$city_id);
        }        
        
    }
}

if (isset($formErrors)){ 
    foreach($formErrors as $error){
        echo $error;
    }
}
?>
    <!-- Start Navbar -->
    <nav id="navbar-clone" class="navbar py-3">
        <div class="container">
            <a href="index.php" class="logo">
                <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                <div>
                    <h3>بنك الدم المصرى</h3>
                    <small>اتصل</small>
                </div>
            </a>
            <ul class="links d-xl-flex d-none">
                <li><a href="index.php">الصفحة الرئيسية</a></li>
                <li><a href="volunteer.php">المتطوعين</a></li>
                <li><a href="lifeFeed.php">طلبات دم عاجلة</a></li>
                <li>
                    <a href="Donate_Money.php" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">تبرع<i class="fas fa-angle-down me-2"></i></a>
                    <ul class="dropdown-menu box" aria-labelledby="offcanvasNavbarDropdown">
                        <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>    
                        <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                    </ul>
                </li>
                <li>
                    <a href="about.php" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">أكثر<i class="fas fa-angle-down me-2"></i></a>
                    <ul class="dropdown-menu box" aria-labelledby="offcanvasNavbarDropdown">
                        <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                        
                        
                        <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                        <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                        <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">تواصل معنا</a></li>
            </ul>

            <div class="btns d-xl-block d-none">
                <?php if(isset($_SESSION['p_ssn'])){
                    ?>
                    
                     <a href="logout.php" class="btn">تسجيل الخروج</a>
                     <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
                <?php }else{
                    ?>
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    
                <?php }
                ?>
            </div>
            <div class="bars d-xl-none d-block">
                <i class="fas fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
            </div>
        </div>
    </nav>

    <nav  class="navbar py-3 ">
        <div class="container">
            <a href="index.php" class="logo">
                <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
                <div>
                    <h3>بنك الدم المصرى</h3>
                    <small>اتصل</small>
                </div>
            </a>
            <ul class="links d-xl-flex d-none">
                <li><a href="index.php">الصفحة الرئيسية</a></li>
                <li><a href="volunteer.php">المتطوعين</a></li>
                <li><a href="lifeFeed.php">طلبات دم عاجلة</a></li>
                <li>
                    <a href="Donate_Money.php" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">تبرع<i class="fas fa-angle-down me-2"></i></a>
                    <ul class="dropdown-menu shadow-lg" aria-labelledby="offcanvasNavbarDropdown">
                        <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>
                        <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                    </ul>
                </li>
                <li>
                    <a href="about.php" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">أكثر<i class="fas fa-angle-down me-2"></i></a>
                    <ul class="dropdown-menu shadow-lg" aria-labelledby="offcanvasNavbarDropdown">
                        <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                        
                        
                        <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                        <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                        <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">تواصل معنا</a></li>
            </ul>

            <div class="btns d-xl-block d-none">
            <?php if(isset($_SESSION['p_ssn'])){
                    ?>
                    
                     <a href="logout.php" class="btn">تسجيل الخروج</a>
                     <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
                <?php }else{
                    ?>
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    
                <?php }
                ?>
            </div>

            <div class="bars d-xl-none d-block">
                <i class="far fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
                
                <div class="offcanvas bg-white offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header box">
                        <div class="logo">
                            <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                            <h3>بنك الدم المصرى</h3>
                        </div>
                    <i class="far fa-times" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></i>    
                    </div>
                    <div class="offcanvas-body">
                        <div></div>

                        <div>
                            <ul class="canv_links flex-column text-dark mb-5">
                                <li><a href="index.php"><i class="fas fa-home ms-2"></i>الصفحة الرئيسية</a></li>
                                <li><a href="volunteer.php"><i class="fas fa-users ms-2"></i>المتطوعين</a></li>
                                <li><a href="lifeFeed.php"><i class="fas fa-heartbeat ms-2"></i>طلبات دم عاجلة </a></li>
                                <li class="position-relative">
                                    <a href="Donate_Money.php" id="offcanvasNavbarDropdown" class="one" role="button" data-bs-toggle="dropdown" aria-expanded="false" ><i class="fas fa-donate ms-2"></i>تبرع<i class="fas fa-angle-down one me-2"></i></a>
                                    <ul class="dropdown-menu shadw" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>
                                        <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                                    </ul>
                                </li>
                                <li class="position-relative">
                                    <a href="about.php" id="offcanvasNavbarDropdown" class="two" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-info-circle ms-2"></i>أكثر<i class="fas fa-angle-down two me-2"></i></a>
                                    <ul class="dropdown-menu shadw" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                                        
                                        
                                        <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                                        <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                                        <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.php"><i class="fab fa-facebook-messenger ms-2"></i>تواصل معنا</a></li>
                            </ul>

                            <div class="btns">
                            <?php if(isset($_SESSION['p_ssn'])){
                    ?>
                    
                     <a href="logout.php" class="btn">تسجيل الخروج</a>
                     <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
                <?php }else{
                    ?>
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    
                <?php }
                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
        <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->

    <main>
        <!-- SignIn and Forget password -->
        <section class=" sign-In-box main-box shadow-lg back-gradient ">
            <div class="master-img-signIn d-lg-flex d-none">
                <div class="title text-white mt-5">
                    <h3 class="fs-1  mb-2 text-center">بنك الدم المصرى</h3>
                    <p>انضم إلى مجتمعنا الرائع وابدأ في إنقاذ الأرواح . يمكنك أن تصبح بطلاً غير معروف لشخص ما ولكن كل بطل مهم</p>
                </div>
                <img src="img/main_box/1.png" alt="people donate with blood">
            </div>

            <div id="main_box_signIn">
                <div class="login-box">
                    <div class="login-form-slider overflow-hidden">
                        <!-- login slide start -->
                        <div class="login-slide p-xl-5 py-5 login-slide-padd">
                            <div class="login-slide-content">
                                <h3 class="text-gradiant mb-2">تسجيل الدخول</h3>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                <input type="hidden" name="state" value="signin">
                                    <div class="form-group user-name-field">
                                        <input type="number" class="form-control" name="signin_ssn" placeholder=" ادخل الرقم القومي  ">
                                        <div class="field-icon"><i class="fas fa-user"></i></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="signin_password" class="form-control" placeholder="كلمة السر">
                                        <div class="field-icon"><i class="fas fa-key-skeleton"></i></div>
                                    </div>
                                    <div class="form-group sign-in-btn">
                                        <input type="submit" class="submit back-gradient" value="تسجيل الدخول">
                                    </div>
                                    <a href="forget_password.php?to=forget" class="forgot-password-click text-gradiant">هل نسيت كلمة السر ؟</a>
                                </form>
                                <div class="sign-up-txt">
                                    ليس لديك حساب؟ <a href="#" class="sign-up-click text-gradiant">إنشاء حساب جديد</a>
                                </div>
                            </div>
                        </div>
                        <!-- login slide end -->

                       
                    </div>
                </div>
            </div>
        </section>
        <!-- End -->

        <!-- SignUp -->
        <section class="hidden visuallyhidden signUp_OR_signUp-d-none sign-Up-box main-box shadow-lg back-gradient-signUp ">
            <div id="main_box_signUp">
                <div class="signUp-box">
                    <div class="login-form-slider overflow-hidden">
                        <form id="signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="state" value="signup">

                        <!--  start signUp slide -->
                        <div class="signUp-slide   px-xl-5 py-5 signUp-slide-padd">
                            <div class="signUp-slide-content">
                                <h3 class="text-gradiant text-center mb-3">إنشاء حساب جديد</h3>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="form-group user-name-field mb-0">
                                            <input type="text" class="form-control" name="l_name" placeholder="أسم العائلة">
                                            <div class="field-icon"><i class="fas fa-user"></i></div>
                                        </div>
                                        <div class="form-group user-name-field mb-0">
                                            <input type="text" class="form-control" name="f_name"  placeholder="الأسم الأول">
                                            <div class="field-icon"><i class="fas fa-user"></i></div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="form-group user-ssd-field mb-0">
                                            <input type="text" class="form-control" name="p_ssn"  placeholder="الرقم القومى">
                                            <div class="field-icon"><i class="fas fa-id-card"></i></div>
                                        </div>
                                        <div class="form-group user-email-field mb-0">
                                            <input type="email" class="form-control" name="email"  placeholder="البريد الإلكترونى">
                                            <div class="field-icon"><i class="fas fa-envelope-square"></i></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="form-group mb-0">
                                            <input type="tel"  id="phone2" class="form-control" name="tel1" placeholder=" 2 رقم الموبايل">
                                            <div class="field-icon"><i class="fas fa-mobile"></i></div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="tel"  id="phone1" class="form-control" name="tel2" placeholder=" 1 رقم الموبايل">
                                            <div class="field-icon"><i class="fas fa-mobile"></i></div>
                                        </div>
                                    </div>
                                    <div style="text-align: right !important;direction: rtl;" class="d-flex justify-content-center mb-3 col-md-6">
                        <select class="<?php if(isset($blood_error)){echo $gender_error;}?> custom-select ui search dropdown" name="blood" id="bloodType">
                            
                            <?php foreach($all_blood_type as $data){ 
                                if($data['id'] == $blood['id']){
                                    continue;
                                }else{
                                    ?>
                                <option value="<?php echo $data['id'];?>"><?php echo $data["name"]; ?></option>
                                <?php
                                }
                                 } ?>
                        </select>
                    </div>
                                    <div class="sign-up-btn">
                                        <input type="button" class="btn-next submit back-gradient-signUp" value="التالى">
                                    </div>
                            </div>
                        </div>
                        <!--  end --signUp slide -->

                        <!--  start signUp slide next values -->
                        <div class="signUp-slide-next-values   px-xl-5 py-5 signUp-slide-next-values-padd">
                            <div class="signUp-slide-next-values-content">
                                <h3 class="text-gradiant text-center mb-3">إنشاء حساب جديد</h3>
                                    <div class="row mb-3">
                                    <div style="text-align: right !important;direction: rtl;" class="col-md-6  mb-3 ">
                        <select class=" <?php if(isset($city_error)){echo $city_error;} ?> drop custom-select ui search dropdown" name="city_id" id="city">
                        <option selected  value="">...اختر المحافظه اولاً</option>
                        </select>
                    </div>
                                    <div style="text-align: right !important;direction: rtl;" class="col-md-6 mb-3">
                                        <select class="<?php if(isset($gov_error)){echo $gov_error;}?> custom-select ui search dropdown" name="Gov_id" id="gov">
                        <option selected  value="">...اختر المحافظه </option>
                                           
                                            <?php foreach($all_gov_data as $gov_data){ 
                                                ?>
                                                <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                                <?php
                                                }  ?>
                                        </select>
                                    </div>
                                  
                     <!-- gov name -->
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="form-group mb-0">
                                            <input type="date" class="form-control" id="birthday" name="birthday" value="22 / 2 / 2000">
                                            <div class="field-icon"><i class="fas fa-birthday-cake"></i></div>
                                        </div>
                                        <div style="text-align: right !important;direction: rtl;" class="col-md-6 mb-3">
                        <select class="<?php if(isset($gov_error)){echo $gender_error;}?> custom-select ui search dropdown" name="gender" id="select_gender">
                            
                            <?php foreach($all_gender as $data){ 
                                if($data['id'] == $gender['id']){
                                    continue;
                                }else{
                                    ?>
                                <option value="<?php echo $data['id'];?>"><?php echo $data["type"]; ?></option>
                                <?php
                                } } ?>
                        </select>
                    </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="form-group mb-0">
                                            <input type="password" class="form-control"name="confirm" placeholder="تأكيد كلمة السر">
                                            <div class="field-icon"><i class="fas fa-key-skeleton"></i></div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="password"name="password" class="form-control" placeholder="كلمة السر">
                                            <div class="field-icon"><i class="fas fa-key-skeleton"></i></div>
                                        </div>
                                    </div>
                                    <div class="sign-up-btn d-flex flex-wrap">
                                        <input type="submit" class="submit back-gradient-signUp mb-md-0 mb-2" value="إنشاء حساب"> 
                                        <input type="button" class="btn-prev submit back-gradient-signUp mb-md-0 mb-2" value="السابق">
                                    </div>
                                <div class="sign-in-txt">
                                    اذا كان لديك حساب؟ <a href="#" class=" sign-in-click text-gradiant">تسجيل الدخول</a>
                                </div>
                            </div>
                        </div>
                        <!--  end  signup slide -->
                        </form>

                    </div>
                </div>
            </div>

            <div class="master-img-signUp d-lg-flex d-none">
                <div class="title text-white mb-3">
                    <h3 class="fs-1  mb-2 text-center">بنك الدم المصرى</h3>
                    <p>انضم إلى مجتمعنا الرائع وابدأ في إنقاذ الأرواح . يمكنك أن تصبح بطلاً غير معروف لشخص ما ولكن كل بطل مهم</p>
                </div>
                <img src="img/main_box/1.png" alt="people donate with blood">
            </div>
        </section>
        <!-- End -->
    </main>


    <!-- Start Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                
                <div class="col-lg-4 col-sm-6 order-lg-1 order-sm-3 order-4">
                    <div class="items padd">
                        <h3>اشترك معنا</h3>
                        <p class="mb-3">اشترك معنا في النشرة الإخبارية المنتظمة وكن على اطلاع بآخر أخبارنا</p>
                        <form>
                            <input class="form-control" type="email" placeholder="أدخل بريدك الإلكتروني">
                            <button class="btn" type="submit">شارك</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 order-lg-2 order-sm-4 order-3">
                    <div class="items padd ">
                        <h3>أحدث الأخبار</h3>
                        <ul class="links list-unstyled">
                            <li><a href="#">تتسبب حوادث الطرق في حدوث طوارئ دموية</a></li>
                            <li><a href="#">حقائق مذهلة عن التبرع بالدم</a></li>
                        </ul>
                    </div>

                    <div class="items mt-3">
                        <h3>تحميل التطبيق</h3>
                        <ul class="links list-unstyled">
                            <li><a href="#"><img src="img/downloadApps/apple.svg" alt="Download App"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 order-lg-3 order-sm-1 order-2">
                    <div class="items padd">
                        <h3>المؤسسة</h3>
                        <ul class="links list-unstyled">
                            <li><a href="blood.donation.php">تبرع</a></li>
                            <li><a href="NewsStory.php">أخبار </a></li>
                            <li><a href="story.php">قصص</a></li>
                            <li><a href="about.php">معلومات عنا</a></li>
                            <li><a href="contact.php">اتصل بنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 order-lg-4  order-sm-2 order-1">
                    <div class="items">
                        <div class="foot_logo">
                            <div>
                                <h3>بنك الدم المصرى</h3>
                                <small>اتصل</small>
                            </div>
                            <img src="img/logo/savelife-light.svg" alt="Savelife_Logo">
                        </div>
                        <ul class="links list-unstyled">
                            <li><a href="login.php">سجل</a></li>
                            <li><a href="volunteer.php">المتطوعين</a></li>
                            <li><a href="lifeFeed.php">طلبات دم عاجلة </a></li>
                            <li><a href="blood_donar.php">البحث عن الدم</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="foot_copyright pt-5">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4">
                        <div class="foot_links">
                            <div class="btn-group">
                                <button class="btn btn-sm dropdown-toggle" id="offcanvasNavbarDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" hidden>
                                    العربية
                                </button>
                                <ul class="dropdown-menu shadow-lg p-0" aria-labelledby="offcanvasNavbarDropdown" >
                                    <li><a class="dropdown-item rounded" href="#">العربية</a></li>
                                    <li><a class="dropdown-item rounded" href="#">English</a></li>
                                </ul>
                            </div>
                            <div>
                                <a href="#"><i class="fab fa-twitter mx-3"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </div>                             
                        </div>
                    </div>

                    <div class="col-md-8">
                        <p class="Copyright mb-0">حقوق النشر @ 2021 بنك الدم جميع الحقوق محفوظة | هذا الموقع الذي أنشأه  <a href="#">الفريق</a> </p>
                    </div>
                </div>
            </div>
        </div> 
    </footer>
    <!-- End Footer -->

    <!-- Btn Up -->
    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5 text-white"></i> </a>
    <script>
        $(document).ready(function(){
    $("#gov").change(function(){
        let req = new XMLHttpRequest();        
        req.open("POST","gov_city_ajax.php",true);    
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");       
        let key = $("#gov").val();
        req.send("id="+key+"&hamada=hamada");
        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                $("#city").html(this.responseText);
               
                

            }
        }
    })
 });

 var form = document.getElementById("signup");
function handleForm(event) {
event.preventDefault();
}
form.addEventListener('submit',handelForm);

    </script>
<?php 
require_once "./includes/template/footer.php";
?>