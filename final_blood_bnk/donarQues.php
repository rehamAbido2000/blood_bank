<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="donarQues.css";
$script="donarQues.js";
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
                    <li><a href="contact.php">تواصل معنا</a></li>
                </li>
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
                
                <div class="offcanvas  offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
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
    
    <section class="find_blood d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="main-heading">
                <h2>مجموعة من الأسئلة</h2>
            </div>
        </div>
    </section>

    <div class="swiper mySwiper m-auto  py-5 ">
        <div class="container">
            <div class="main-heading mb-4">
                <h2 class="mb-3">نحن ننقذ الأرواح</h2>
                <p> نسال هذه الأسئلة حفاظا على حياتكم قبل إجراء أى شئ</p>
            </div>
        </div>
        <div class="swiper-wrapper ">
            <div class=" donar swiper-slide d-flex align-items-center justify-content-center h-100 m-auto ">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container    d-flex align-items-center justify-content-center">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3 ">

                                    <div class="col-sm-7 col-12">
                                            <h5 class="mb-4">هل أصبت ، أو أصبت بأي من أمراض القلب ؟</h5>
    
                                            <div class="ques-btn d-flex flex-column">
                                                <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Heart">
                                                    <div id="yes">نعم</div>
                                                </button>
    
                                                <button>
                                                    <div id="no" class=" swiper-button-next ">لا</div>
                                                </button>
                                            </div>
                    
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100" src="img/samar/heart.png"
                                            alt="heart">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 ">
                                <div class="bottom-btn d-flex justify-content-center align-items-center">
                                    <button class="ms-sm-5 ms-2">
                                        <a href="blood.donation.php">عوده</a>
                                    </button>
                                
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class=" donar swiper-slide d-flex align-items-center justify-content-center h-100 m-auto ">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container    d-flex align-items-center justify-content-center ">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3">

                                    <div class="col-sm-7 col-12">

                                        <h5 class="mb-4">هل أنت حامل ، أو أنجبت طفلاً ، أو أجهضت أو تم إجهاضك
                                            في الأشهر الستة الماضية؟</h5>

                                        <div class="ques-btn d-flex flex-column">
                                            <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Brigg" >
                                                <div id="yes">نعم</div>
                                            </button>


                                            <button >
                                                <div id="no" class=" swiper-button-next  ">لا</div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100"
                                            src="img/samar/brignnet-removebg-preview.png" alt="brignnet Wamen">
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="bottom-btn d-flex align-items-center justify-content-center ">
                                    <button class="ms-sm-5 ms-2">
                                        <div class=" swiper-button-prev swiper-button-back-prev">عوده</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class=" donar swiper-slide d-flex align-items-center justify-content-center h-100 m-auto ">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container   d-flex align-items-center justify-content-center ">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3">

                                    <div class="col-sm-7 col-12">
                                        <h5 class="mb-4">هل تلقيت تطعيم ضد فيروس كورونا خلال الـ 48 ساعة
                                            الماضية؟ </h5>


                                        <div class="ques-btn d-flex flex-column">
                                            <!-- عاوزين نعد كام مره ضغط هنا -->
                                            <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Vaccine">
                                                <div id="yes">نعم</div>
                                            </button>


                                            <button >
                                                <div id="no" class=" swiper-button-next  ">لا</div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100" src="img/samar/vacine.png" alt="vacine">
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="bottom-btn d-flex align-items-center justify-content-center ">
                                    <button class="ms-sm-5 ms-2">
                                        <div class=" swiper-button-prev swiper-button-back-prev">عوده</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class=" donar swiper-slide d-flex align-items-center justify-content-center h-100 m-auto ">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container    d-flex align-items-center justify-content-center ">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3">

                                    <div class="col-sm-7 col-12">
                                        <h5 class="mb-4">في الأسابيع الأربعة الماضية ، هل كنت على اتصال بأي
                                            شخص مصاب بمرض معدي؟ </h5>


                                        <div class="ques-btn d-flex flex-column">
                                            <!-- عاوزين نعد كام مره ضغط هنا -->
                                            <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Crona">
                                                <div id="yes">نعم</div>
                                            </button>


                                            <button ">
                                                <div id="no" class=" swiper-button-next  ">لا</div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100"
                                            src="img/samar/disaese-removebg-preview.png" alt="disaese">
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="bottom-btn d-flex align-items-center justify-content-center ">
                                    <button class="ms-sm-5 ms-2">
                                        <div class=" swiper-button-prev swiper-button-back-prev">عوده</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class=" donar swiper-slide d-flex align-items-center justify-content-center h-100 m-auto ">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container    d-flex align-items-center justify-content-center ">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3">

                                    <div class="col-sm-7 col-12">
                                        <h5 class="mb-4">
                                            هل اصبت بأي عدوى في آخر اسبوعين او تناولت اي مضادات حيويه خلال اخر سبع ايام؟
                                        </h5>
                                        <div class="ques-btn d-flex flex-column">
                                            <!-- عاوزين نعد كام مره ضغط هنا -->
                                            <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Donate">
                                                <div id="yes">نعم</div>
                                            </button>


                                            <button>
                                                <div id="no" class=" swiper-button-next ">لا</div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100" src="img/samar/person.png"
                                            alt="person">
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="bottom-btn d-flex align-items-center justify-content-center ">
                                    <button class="ms-sm-5 ms-2">
                                        <div class=" swiper-button-prev swiper-button-back-prev">عوده</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class=" donar swiper-slide d-flex align-items-center justify-content-center">
                <div class=" d-flex align-items-center justify-content-center m-auto py-3">
                    <div class="container    d-flex align-items-center justify-content-center ">

                        <div class="row justify-content-center">
                            <div class="ques">
                                <div class=" d-flex align-items-center justify-content-sm-center mb-3 ">

                                    <div class="col-sm-7 col-12">
                                        <h5 class="mb-4">في الأشهر الأربعة الماضية ، هل حصلت على وشم أو مكياج
                                            شبه دائم أو أي علاجات تجميلية تضمنت ثقب الجلد؟
                                        </h5>


                                        <div class="ques-btn d-flex flex-column">
                                            <!-- عاوزين نعد كام مره ضغط هنا -->
                                            <button class="mb-2 " data-bs-toggle="modal" data-bs-target="#Tatto">
                                                <div id="yes">نعم</div>
                                            </button>

                                            


                                            <button>
                                                <div id="no" class=" swiper-button-next  ">لا</div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="quest-image-area col-sm-4 d-sm-block d-none">
                                        <img class="w-100"
                                            src="img/samar/50-501008_hand-with-tattoo-clipart-hd-png-download-removebg-preview.png"
                                            alt="clipart">
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="bottom-btn d-flex align-items-center justify-content-center ">
                                    <button class="ms-sm-5 ms-2">
                                        <div class=" swiper-button-prev swiper-button-back-prev">عوده</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div id="pass" class=" donar swiper-slide d-flex align-items-center justify-content-center">
                <div class="donar">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class=" d-flex align-items-center justify-content-center">

                                    <div class="quest-question-area col-md-7 ">

                                        <div class="ques-container-lg">
                                            <p class="mb-sm-0 mb-4">
                                                رائعة! لقد اجتزت اختبار الأهلية الأساسي الخاص بنا ويبدو أنه يمكنك التبرع بالدم.
                                                نحن نتطلع إلى رؤيتكم قريبا.

                                                يرجى تذكر أن هذا المدقق غطى فقط الأسباب الأكثر شيوعًا التي تمنع الأشخاص من
                                                التبرع بالدم وأن معايير الأهلية الأخرى تنطبق. يتخذ موظفونا القرار النهائي بشأن
                                                ما إذا كان يمكنك التبرع بالدم عند حضور موعد التبرع الخاص بك.
                                            </p>

                                        </div>

                                    </div>

                                    <div class="quest-image-area col-md-5">
                                        <img class="w-100 d-sm-block d-none" src="img/samar/good-removebg-preview.png" alt="good">
                                    </div>


                                </div>
                                <div class="finish d-flex align-items-center justify-content-center ">
                                    <button class="full_form"><a href="dash-donate-blood.php" target="_blank">إنهاء</a></button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>

        <!-- Modal Heart -->
        <div class="modal fade" id="Heart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="HeartLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">القلب</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>قد يتسبب ذلك في خطوره عليك التواصل مع طبيبك لمعرفه ما اذا كان بامكانك التبرع.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Heart -->

        <!-- Modal Briggnent -->
        <div class="modal fade" id="Brigg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BriggLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">الحمل</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>إذا كنت حاملا و استمر حملك لأكثر من 12 أسبوعًا ، فيرجى الانتظار حتى انقضاء 6 أشهر من نهاية الحمل قبل التبرع بالدم.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Briggnent -->

        <!-- Modal vaccine -->
        <div class="modal fade" id="Vaccine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="VaccineLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">اللقاح</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>سيؤثر تلاقي التطعيم ضد فيروس كورونا خلال ال 48 ساعه الماضيه ع التبرع بالدم.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End vaccine -->

        <!-- Modal Crona -->
        <div class="modal fade" id="Crona" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CronaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">الفيرس</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>عليك الانتظار قليلا حتى تتاكد من عدم نقل العدوى اليك وبعدها يمكنك التبرع.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Crona -->

        <!-- Modal Donate -->
        <div class="modal fade" id="Donate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DonateLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">التبرع</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>اسف يجب ان تتعافى جيدا و يمضى ع الاقل 14 يوما ع التعافي.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Donate -->

        <!-- Modal Tatto -->
        <div class="modal fade" id="Tatto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TattoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content Yes bg-transparent">
                    <div class="Yes">
                        <div class="comments d-flex flex-column rounded-1 m-auto">
                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                <span class="fw-bold fs-5">الوشم</span>
                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            <div class="comm-body d-flex justify-content-center bg-white px-3 py-2">
                                <p>ناسف يجب عليك الانتظار لسته اشهر على الاقل قبل التبرع بالدم.</p>
                            </div>
                            <div class="comm-footer d-flex justify-content-center  p-3 bg-white">
                                <a href="blood.donation.php">ابدأ مرة أخرى</a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tatto -->
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