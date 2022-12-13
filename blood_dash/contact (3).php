<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="contact.css";
$script="contact.js";
include "init.php";
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    date_default_timezone_set('Africa/Cairo');

    $subject=FILTER_VAR($_POST['subject'],FILTER_SANITIZE_STRING);
    $email=FILTER_VAR($_POST['email'],FILTER_SANITIZE_EMAIL);
    $msg=FILTER_VAR($_POST['msg'],FILTER_SANITIZE_STRING);
    $phone=FILTER_VAR($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
    $header="from:".$email;
    $time= date("Y/m/d . h:i:s");
    $formErrors = array ();
    if(empty($subject)||strlen($subject)<3){
      $formErrors[] = "
      <script>
          toastr.error('من فضلك قم بكتابه العنوان بحيث يكون اكثر من 3 احرف.')
      </script>";
      $name_error="border border-danger";
    }
    if (empty($email)) {
        $formErrors[] = "
        <script>
            toastr.error('من فضلك ادخل البريد الالكتروني')
        </script>";
        $email_error="border border-danger";
    }
    if (empty($phone) || strlen((string)$phone)<11) {
        $formErrors[] = "
        <script>
            toastr.error('من فضلك رقم الهاتف يجب انا يكون مكون من 11 رقم')
        </script>";
        $phone_error="border border-danger";
    }
    if (empty($msg)) {
        $formErrors[] = "
        <script>
            toastr.error('من فضلك قم بكتابه الرساله')
        </script>";
        $message_error="border border-danger";

    }       
    
    if (empty($formErrors)){

        //=================================== NEED UPDATE IN FUTURE =============================
        mail("hayaatuktuhumuna@gmail.com","Message From Website",$email,$header . "\r\n" ."CC:hayaatuktuhumuna@gmail.com". "\r\n" .$msg);
        addmsg($subject,$email,$phone,$msg,$time);
                
    }
}


if (isset($formErrors)){ 
    foreach($formErrors as $error){
        echo $error;
    }
}
?>
    <div id="nav">
        <!-- Start Navbar -->
        <nav id="navbar-clone" class="navbar py-3">
            <div class="container">
                <a href="index.php" class="logo">
                    <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                    <div>
                        <h3>حياتكم تهمنا</h3>
                        <small>اتصل</small>
                    </div>
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                    <li><a href="volunteer.php">المتطوعين</a></li>
                    <li><a href="lifeFeed.php">طلبات دم عاجلة</a></li>
                    <li>
                        <a href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">تبرع<i class="fas fa-angle-down me-2"></i></a>
                        <ul class="dropdown-menu box" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>    
                            <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">أكثر<i class="fas fa-angle-down me-2"></i></a>
                        <ul class="dropdown-menu box" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                            
                            
                            <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                            <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                            <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                            <li><a class="dropdown-item rounded" href="#">متتبع فيروس كورونا المباشر</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">تواصل معنا</a></li>
                </ul>

                <div class="btns d-xl-block d-none">
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    <!-- <a href="#" class="btn">تسجيل الخروج</a> -->
                    <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
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
                        <h3>حياتكم تهمنا</h3>
                        <small>اتصل</small>
                    </div>
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                    <li><a href="volunteer.php">المتطوعين</a></li>
                    <li><a href="lifeFeed.php">طلبات دم عاجلة</a></li>
                    <li>
                        <a href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">تبرع<i class="fas fa-angle-down me-2"></i></a>
                        <ul class="dropdown-menu shadow-lg" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>
                            <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">أكثر<i class="fas fa-angle-down me-2"></i></a>
                        <ul class="dropdown-menu shadow-lg" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                            
                            
                            <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                            <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                            <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                            <li><a class="dropdown-item rounded" href="#">متتبع فيروس كورونا المباشر</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php"><span class="br">تواصل معنا</span></a></li>
                </ul>

                <div class="btns d-xl-block d-none">
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    <!-- <a href="#" class="btn">تسجيل الخروج</a> -->
                    <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
                </div>

                <div class="bars d-xl-none d-block">
                    <i class="far fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
                    
                    <div class="offcanvas bg-white offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header box">
                            <div class="logo">
                                <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                                <h3>حياتكم تهمنا</h3>
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
                                        <a href="#" id="offcanvasNavbarDropdown" class="one" role="button" data-bs-toggle="dropdown" aria-expanded="false" ><i class="fas fa-donate ms-2"></i>تبرع<i class="fas fa-angle-down one me-2"></i></a>
                                        <ul class="dropdown-menu shadw" aria-labelledby="offcanvasNavbarDropdown">
                                            <li><a class="dropdown-item rounded" href="Donate_Money.php">تبرع بالأموال</a></li>
                                            <li><a class="dropdown-item rounded" href="blood.donation.php">تبرع بالدم</a></li>
                                        </ul>
                                    </li>
                                    <li class="position-relative">
                                        <a href="#" id="offcanvasNavbarDropdown" class="two" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-info-circle ms-2"></i>أكثر<i class="fas fa-angle-down two me-2"></i></a>
                                        <ul class="dropdown-menu shadw" aria-labelledby="offcanvasNavbarDropdown">
                                            <li><a class="dropdown-item rounded" href="about.php">معلومات عنا</a></li>
                                            
                                            
                                            <li><a class="dropdown-item rounded" href="How-App-Work.php">كيف يعمل التطبيق</a></li>
                                            <li><a class="dropdown-item rounded" href="NewsStory.php">أخبار</a></li>
                                            <li><a class="dropdown-item rounded" href="story.php">قصص</a></li>
                                            <li><a class="dropdown-item rounded" href="#">متتبع فيروس كورونا المباشر</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.php"><i class="fab fa-facebook-messenger ms-2"></i>تواصل معنا</a></li>
                                </ul>

                                <div class="btns">
                                    <a href="dash-profile.php" target="_blank" class="btn w-100">لوحة التحكم</a>
                                    <!-- <a href="#" class="btn w-100 my-2">تسجيل الخروج</a> -->
                                    <a href="login.php" class="btn w-100">تسجيل الدخول</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
    
    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
        <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->
    

    <!-- Start conatct -->
    <section>
        <div class="contact py-5">
            <form  method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="contact-form">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="main-heading mb-5">
                                    <h2>تواصل معنا</h2>
                                    <p class="text-dark">سواء كنت تريد بعض المساعدة أو لمجرد طرح سؤال علينا، فنحن نرحب بك للقيام بذلك باستخدام النموذج
                                        أدناه 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 m-auto ">
                                <div class="d-md-flex justify-content-between">
                                    <div class="form-floating ">
                                        <input type="text" class="form-control "name="subject" id="floatingPassword"
                                            >
                                        <span class="bar"></span>
                                        <label class="" for="floatingPassword">العنوان *</label>
                                    </div>
                                    <div class="form-floating mx-md-3">
                                        <input type="tel" class="form-control"name="phone" id="floatingPassword"
                                           >
                                        <span class="bar"></span>
                                        <label for="floatingPassword">رقم الهاتف *</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="email" class="form-control "name="email" id="floatingPassword"
                                            >
                                        <span class="bar"></span>
                                        <label for="floatingPassword" class="">البريد الالكتروني *</label>
                                    </div>
                                </div>
                                <div class="form-floating my-4">
                                    <textarea class="form-control"name="msg" id="floatingTextarea2"
                                        style="height: 200px"></textarea>
                                    <span class="bar"></span>
                                    <label for="floatingTextarea2">رساله *</label>
                                </div>

                                <button class="text-center m-auto ">
                                    <span>ارسال</span>
                                    <div class="svg-wrapper-1">
                                        <div class="svg-wrapper">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"> -->
                                            <i class="fas fa-paper-plane" viewBox="0 0 24 24"></i>
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path fill="currentColor"
                                                d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                                            </path>
                                            </svg>
                                        </div>
                                    </div>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End conatct -->

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
                                <h3>حياتكم تهمنا</h3>
                                <small>اتصل</small>
                            </div>
                            <img src="img/logo/savelife-light.svg" alt="Savelife_Logo">
                        </div>
                        <ul class="links list-unstyled">
                            <li><a href="login.php">سجل</a></li>
                            <li><a href="volunteer.php">المتطوعين</a></li>
                            <li><a href="lifeFeed.php">طلبات دم عاجلة </a></li>
                            <li><a href="blood_donar.php">البحث عن الدم</a></li>
                            <li><a href="#">متتبع فيروس كورونا المباشر</a></li>
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
    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5"></i> </a>

<?php 
require_once "./includes/template/footer.php";
?>