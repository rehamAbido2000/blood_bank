<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="How-App-Work.css";
$script="How-App-Work.js";
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
                <!-- <a href="#" class="btn">تسجيل الخروج</a> -->
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
                                <a href="dash-profile.php" target="_blank" class="btn w-100 my-2">لوحة التحكم</a>
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

    <!-- Start Heading -->
    <section class="how-app-work d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="heading">
                <h2>كيف يعمل التطبيق ؟</h2>
            </div>
        </div>
    </section>
    <!-- End Heading -->

    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
            <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->

    <!-- Start Mobile App-->
    <section class="mobile">
        <div class="container">
            <div class="main-heading">
                <h2>كيف يعمل</h2>
                <p>تم تصميم تطبيقنا ليكون بسيطًا قدر الإمكان. ويحتوى على نفس ما يحتويه الموقع من خدمات</p>
            </div>
            <div class="row g-4 justify-content-center align-items-center flex-row-reverse">
                <div class="col-md-4 order-1">
                    <div class="media mb-5">
                        <div class="media-heading">
                            <h3 class="media-h3-active">تسجيل</h3>
                            <span class="media-span-active"><i class="far fa-plus"></i></span>
                        </div>
                        <p class="mb-4">أنشئ حساب الحفاظ على الحياة الخاص بك فى اقل من مس دقائق. إنه مجاني للجميع</p>
                        <div class="brdr ">
                            <div class="brdr-ball brdr-ball-left ball-active"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/8.jpeg" alt="mobile-app-img">
                    </div>

                    <div class="media mb-5">
                        <div class="media-heading">
                            <h3>الصفحة الرئيسية</h3>
                            <span><i class="fal fa-home"></i></span>
                        </div>
                        <p class="mb-4">يمكنك التعامل مع الخدمات التى يقدمها موقعنا من خلال هذا  التطبيق </p>
                        <div class="brdr ">
                            <div class="brdr-ball brdr-ball-left"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/1.jpeg" alt="mobile-app-img">
                    </div>

                    <div class="media">
                        <div class="media-heading">
                            <h3>تحديد الوجهة</h3>
                            <span><i class="far fa-location-arrow"></i></span>
                        </div>
                        <p class="mb-4"> قم بتحديد المركز الذى سوف تقو بعمل إجراءاتك به</p>
                        <div class="brdr ">
                            <div class="brdr-ball brdr-ball-left"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/2.jpeg" alt="mobile-app-img">
                    </div>
                </div>
                <div class="col-md-4 order-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 col-md-12 col-8">
                            <section id="mobilescreen">
                                <div id="speaker"></div>
                                <div class="imgs">
                                    <img class="w-100 main-img" src="img/mobile-app-img/8.jpeg" alt="mobile-app-img">
                                </div>
                                <div id="controlder"></div>
                            </section> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 order-3 ">
                    <div class="media mb-5">
                        <div class="media-heading">
                            <h3 >التبرع بالأموال</h3>
                            <span ><i class="fas fa-dollar-sign"></i></span>
                        </div>
                        <p class="mb-4">تقدر تتبرع بالمال اذا لم يكن هناك وسيلة لتبرع بالدم منطمتنا غير هادفة للربح وانما نقدم المساعدة</p>
                        <div class="brdr">
                            <div class="brdr-ball"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/3.jpeg" alt="mobile-app-img">
                    </div>

                    <div class="media mb-5">
                        <div class="media-heading">
                            <h3>طلب اللقاح</h3>
                            <span><i class="fas fa-syringe"></i></span>
                        </div>
                        <p class="mb-4">يمكنك التطبيق من القيام بطلب لقاح فى اى وقت اذا كنت بحاجه الى ذالك</p>
                        <div class="brdr">
                            <div class="brdr-ball"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/4.jpeg" alt="mobile-app-img">
                    </div>

                    <div class="media">
                        <div class="media-heading">
                            <h3>التبرع بالدم</h3>
                            <span><i class="far fa-tint"></i></span>
                        </div>
                        <p class="mb-4">تقدر من التطبيق انك تحجز موعد للتبرع بالدم وفقا للشروط التى يجب ان تجتازها </p>
                        <div class="brdr">
                            <div class="brdr-ball"></div>
                        </div>
                        <img class="w-100 d-none" src="img/mobile-app-img/5.jpeg" alt="mobile-app-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Mobile App -->

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
    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5"></i> </a>

    <?php 
    require_once "./includes/template/footer.php";
    ?>