<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="volunteer.css";
$script="volunteer.js";
include "init.php";
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
                <li><a href="volunteer.php"><span class="br">المتطوعين</span></a></li>
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
                    </ul>
                </li>
                <li><a href="contact.php">تواصل معنا</a></li>
            </ul>

            <div class="btns d-xl-block d-none">
                <a href="login.php" class="btn">تسجيل الدخول</a>
                <!-- <?php if(isset($_SESSION['p_ssn'])){
                    ?>
                    
                     <a href="logout.php" class="btn">تسجيل الخروج</a>
                     <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
                <?php }else{
                    ?>
                    <a href="login.php" class="btn">تسجيل الدخول</a>
                    
                <?php }
                ?> -->
                <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a>
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
    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
        <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->
    <!-- volunteers -->
    <section class="volunteer d-flex justify-content-center align-items-center">
        <div class="title text-center">
            <h2 class="mb-3">المتطوعين</h2>
            <p class=" text-center">ابحث عن المتطوعين الخارقين لدينا</p>
        </div>
    </section>

    <div class="search d-flex justify-content-center position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-8 ">
                    <form >
                        <div class="select-search bg-white shadow-lg d-flex justify-content-around rounded p-2">
                            <div class="select">
                                <div class="dropdown ">
                                    <input list= "blood-type" id="blood_type" class="form-control text-center" placeholder="فصيلة الدم">
                                    <datalist id="blood-type">
                                        
                                    </datalist>
                                    <input type="hidden" name="answer" id="blood_type-hidden">
                                </div>
                            </div>
        
                            <div class="search-box">
                                <button id="search" type="button" class="btn btn-outline-danger">
                                    <span>بحث</span>
                                    <span><i class="fas fa-search"></i></span>
                                </button>
                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

            
        </div>
    </div>
    <!-- End volunteers -->

    <!-- Side Bar -->
    <button class="sideBar btn btn-danger text-center rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">
        <i class="fal fa-cog text-center fa-spin"></i>
    </button>

    <div class="offcanvas Off_z_index offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h2 id="offcanvasRightLabel">تصفية المتبرعين بالدم</h2>
            <i  class="fas fa-times text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></i>
        </div>
        <div class="offcanvas-body">
            <div class="selector d-flex justify-content-center">
                <div class="show-cities w-50 text-center active">
                    <i class="fal fa-map-marker-alt"></i>
                    <span>المدينة</span>
                </div>
                <div class="show-blood w-50 text-center">
                    <i class="fal fa-tint"></i>
                    <span>فصيلة الدم</span>
                </div>
            </div>
            <div class="list position-relative">
                <ul id="Cities" class="city-list list-unstyled w-100 position-absolute top-0 start-0" ></ul>
                <ul id="blood-list" class="blood-list list-unstyled w-100 position-absolute top-0 start-0 d-none"></ul>
            </div>
        </div>
    </div>
    <!-- eND Side Bar -->

    <!-- Volunteer Table -->

    <section id="Volunteers" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="position-relative table-responsive table-responsive-xxl table-responsive-xl  table-responsive-lg table-responsive-md table-responsive-sm  ">
                        <table class="table caption-top align-middle table-striped table-hover shadow rounded-2">
                            <caption><i class="fad fa-clipboard-list text-danger ms-1"></i> قائمة بأسماء المتطوعين </caption>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><i class="fad fa-users text-danger ms-1 "></i> المتطوعين</th>
                                <th scope="col"><i class="fad fa-map-marker-alt text-danger ms-1"></i>الموقع</th>
                                <th scope="col"><i class="fad fa-tint text-danger ms-1"></i>الدم</th>
                            </tr>
                            </thead>
                            <tbody id="Volunteer">
                                
                            </tbody>
                        </table>

                    </div>
                    <p class="No_bloodTypes text-center text-danger mt-3 fw-bold"></p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- End Table -->

    <!-- heros -->
    <div class="heros pb-5">
        <div class="container">
            <div class="main-heading">
                <h2>أبطالنا الخارقين</h2>
                <p>أبطالنا الخارقون هم متطوعونا من المتبرعين بالدم</p>
            </div>
        
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="join-info">
                        <h3>المتطوعون هم الأبطال الحقيقيون<i class="far fa-heart me-3"></i></h3>
                        <p>نحن نعتمد على المتطوعين! يشكل المتطوعون ٩٦٪ من إجمالي القوى العاملة لدينا ويقومون بعملنا الإنساني. يعد التبرع بالدم أمرًا صحيًا ، ومتطوعونا متاحون على مدار الساعة طوال أيام الأسبوع للمساعدة والتبرع بالدم. تقوم بنوك الدم بتخزين أكياس الدم ولكن متطوعينا موجودون معك في حالة الطوارئ لنقل الدم في الوقت الفعلي.

                            قد يكون التبرع بالدم أو الصفائح الدموية مخيفًا ومخيفًا لكثير من الناس. حان الوقت لنضع هذه الترددات والمخاوف جانبًا. تعلم من  المتبرعين بالدم والصفائح الدموية مدى سهولة وسهولة طي الأكمام والمساعدة في إنقاذ الأرواح.
                        </p>    
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="join-image">
                        <img class="w-100" src="img/imgs/health.svg" alt="health">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End heros -->

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
    <!-- Spinner Laoding -->
    <p class="spinner text-center">
        <i class="fad fa-spinner-third fa-spin fa-3x  text-danger"></i>    
    </p>
    <!-- End Spinner Laoding -->
    <!-- Btn Up -->

    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5"></i> </a>

<!-- Scripting -->
<?php 
require_once "./includes/template/footer.php";
?>