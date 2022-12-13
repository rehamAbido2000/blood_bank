<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="style.css";
$script="main.js";
include "init.php";
?>
    <!-- Maps api Conf -->
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-ruX7KN2DIje10nYcJnv6ggqWScZeKrY&callback=initMap&v=weekly"
    async
    ></script> 
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
                <li><a href="index.php"><span class="br">الصفحة الرئيسية</span> </a></li>
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

    <!-- Start header -->
    <header>
        <div class="container">
            <div class="main-heading mb-5">
                <h1 class="text-white mb-3">بنك الدم المصرى</h1> 
                <p class="text-white">إيصال المتبرعين بالدم بالمحتاجين إليه</p>
            </div>
                <div class="woman1 move">
                    <img class="w-100 bg-white rounded-circle shadow" src="img/testimonials/woman1.svg" alt="woman">
                    <img class="bg-white rounded-circle p-2 img2 shadow" src="img/blood-types/a-type.svg" alt="a-type">
                </div>
                <div class="man3 move1">
                    <img class="w-100 bg-white rounded-circle shadow" src="img/testimonials/man4.svg" alt="woman">
                    <img class="bg-white rounded-circle p-2 img2 shadow" src="img/blood-types/a-type.svg" alt="o-type">
                </div>
                <div class="woman3 move">
                    <img class="w-100 bg-white rounded-circle shadow" src="img/testimonials/woman4.svg" alt="woman">
                    <img class="bg-white rounded-circle p-2 img2 shadow" src="img/blood-types/o-type.svg" alt="b-type">
                </div>
                <div class="man1 move">
                    <img class="w-100 bg-white rounded-circle shadow" src="img/testimonials/man2.svg" alt="man">
                    <img class="bg-white rounded-circle p-2 img2 shadow" src="img/blood-types/ab-type.svg" alt="ab-type">
                </div>
                <div class="man2 move1">
                    <img class="w-100 bg-white rounded-circle shadow" src="img/testimonials/man1.svg" alt="man">
                    <img class="bg-white rounded-circle p-2 img2 shadow" src="img/blood-types/ab-type.svg" alt="ab-type">
                </div>
        </div>
    </header>
    <!-- End header -->

    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
            <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->

    <!-- Start weSaveLive -->
    <section id="weSaveLive">
        <div class="container">
            <div class="main-heading">
                <h2>نحن ننقذ الأرواح</h2>
                <p>هذه الخدمات التى يقدمها موقعنا و التى تسطتيع من خلالها إجراء اى من احتياجاتك</p>
            </div>

            <div class="row justify-content-center g-4 mb-5">
                
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img class="buy-blood" src="img/weSave/money-.png" alt="money">
                        <h3>التبرع بالمال</h3>
                        <p>.Paypal يمكنك التبرع بالمال عن طريق بوابة الدفع </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img  class="donate-blood" src="img/weSave/donate.png" alt="donate blood">
                        <h3>التبرع بالدم</h3>
                        <p>.يمكنك حجز موعد للتبرع بالدم من خلال اقرب مكان تبرع إليك فى المعاد الذى يناسبك</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img src="img/weSave/blood2.png" alt="blood2">
                        <h3>شراء الدم</h3>
                        <p>.يمكنك شراء الدم من اقرب مكان إليك و يتم إرسال رسالة بها كل التفاصيل الخاصة بالأستلام </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img src="img/weSave/volunteers.png" alt="volunteers">
                        <h3>البحث عن المتبرعين</h3>
                        <p>.ابحث عن المتبرعين بالدم بالقرب من موقعك واطلب فصيلة الدم المطلوبة</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img class="vaccine"  src="img/weSave/vaccine.png" alt="vaccine">
                        <h3>طلب اللقاح</h3>
                        <p>.يمكن طلب اللقاح من اقرب مكان إليك ويمكنك معرفه التفاصيل الخاصة بيه </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="weSave-item">
                        <img src="img/weSave/blood.svg" alt="blood_image">
                        <h3>طلب دم عاجل</h3>
                        <p>.إنشاء طلب عاجل للدم يمكن للمتبرعين التفاعل معه</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-2 mb-5">
                <div class="col-md-4">
                    <a href="volunteer.php" class="find_D btn w-75">ابحث عن متبرع بالدم</a>
                </div>
                <div class="col-md-4">
                    <a href="bloodForm.php" target="_blank" class="Req_B btn w-75">طلب دم عاجل</a>
                </div>
                <div class="col-md-4">
                    <a href="vacine.php" target="_blank" class="Req_B btn w-75">طلب لقاح</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Start Careem -->
                <div class="brands col-md-10">
                    <div class="brand-content  brand-owl  ">
                        <a href="https://www.careem.com/" target="_blank">
                            <div class="careem">
                                <div class="d-flex justify-content-center align-items-center flex-column ">
                                    <div class="mb-4">
                                        <img src="img/weSave/careem-white.svg" alt="careem-white">
                                    </div>
                                    <div class="info text-center">
                                        <h5>!هل تريد التبرع بالدم ولكن ليس لديك وسيلة نقل؟ تواصل مع كريم</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="https://www.uber.com/eg/en/" target="_blank">
                            <div class="careem">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <div>
                                        <img src="img/weSave/uber.png" alt="Uber">
                                    </div>
                                    <div class="info text-center">
                                        <h5>!هل تريد التبرع بالدم ولكن ليس لديك وسيلة نقل؟ تواصل مع أوبر</h5>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="https://indriver.com/en/about_us" target="_blank">
                            <div class="careem">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <div>
                                        <img src="img/weSave/inDrive.png" alt="inDrive">
                                    </div>
                                    <div class="info text-center">
                                        <h5>!هل تريد التبرع بالدم ولكن ليس لديك وسيلة نقل؟ تواصل مع إن درايف</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>
                <!-- End Careem -->
            </div>
        </div>
    </section>
    <!-- End weSaveLive -->


    <!-- Start Map -->
    <!-- Start weSaveLive -->
    <section id="maps_section">
        <div class="container">
            <div class="main-heading">
                <h2>دليلك لبنك الدم</h2>
                <p>هذه الخريطة من خلاله يمكنك تحديد اقرب بنك دم إليك</p>
            </div>
            <div class="row justify-content-center">
                    <div class="col-md-8 col-sm-8">
                       <button id="btn" style="display: block;margin: 20px auto;margin-top: 50px;" class="custom-map-control-button btn btn-danger">Go To My Location</button>
                       <div id="google_map"></div>
                    </div>
            </div>
        </div>
    </section>

    <!-- End Map -->

    <!-- Start Join -->
    <section id="Join">
        <div class="container">
            <div class="main-heading mb-5">
                <h2>انضم الى القضية</h2>
                <p>.انضم إلى قضيتنا وساعدنا في إنقاذ المزيد من الأرواح. يجب أن يكون لكل فرد الحق في نقل الدم</p>
            </div>

            <div class="row g-4 justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="join-info">
                        <h3><i class="far fa-search me-3"></i>ابحث عن متبرعين في منطقتك</h3>
                        <p>ابحث عن اقرب المتبرعين فى منطقتك من خلال فصيلة الدم ويكنك التواصل معه من خلال رقم التليفون الخاص بيه لكى يلبى طلبك</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="join-image">
                        <img class="w-100" src="img/join/localisation.svg" alt="localisation">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-center  flex-md-row flex-column">

                    <div class="col-md-6 order-md-1 order-2">
                        <div class="join-image">
                            <img class="w-100" src="img/join/connect.svg" alt="connect">
                        </div>
                    </div>
                    <div class="col-md-6  order-md-2 order-1">
                        <div class="join-info">
                            <h3><i class="far fa-clock me-3"></i>الرد على حالات الطوارئ</h3>
                            <p>  بمجرد تقديم طلب دم جديد ، يتم توجيهه بين المتبرعين بالدم المحليين لدينا. نحن نعلم أن الوقت مهم! لذلك اذا قام احد بتلبة الطلب يتم ارساله الى المكان المحدد لكى يتبرع بالدم اللازم منه</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="join-info">
                        <h3><i class="far fa-mobile-alt me-3"></i>صنع للجميع</h3>
                        <p>كل ماعليك فعله هو التسجيل في الموقع وطلب الدم او اللقاحات ، "الحاجة إلى الدم (فصيلة الدم) في (مدينتك)" . نظامنا ذكي بما يكفي لفهم أي شيء تكتبه ويساعدك في العثور على متبرع في غضون دقائق إن لم يكن ثوان</p>    
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="join-image">
                        <img class="w-100" src="img/join/emergency.svg" alt="emergency">
                    </div>
                </div>
    
                <div class="d-flex align-items-center justify-content-center  flex-md-row flex-column">
                    <div class="col-md-6 col-md-6 order-md-1 order-2">
                        <div class="join-image">
                            <img class="w-100" src="img/join/savelife.svg" alt="savelife">
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6  order-md-2 order-1">
                        <div class="join-info">
                            <h3><i class="far fa-award me-3"></i>أنت بطل شخص ما</h3>
                            <p>في أقل من دقائق قليلة ، يمكنك أن تصبح بطلًا غير معروف ، لكنه مهم للغاية. إنقاذ الحياة عمل نبيل يبدأ بكل بساطة وسهولة. تبرع بالدم أو تبرع بالمال ، كل شكل من أشكال المساهمة التي تقدمها مهم ، وقيّم ، وأساسي في مهمتنا المشتركة لإنقاذ الأرواح</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Join -->

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

    <!-- Start testimonials -->
    <section id="testimonials">
        <div class="container">
            <div class="main-heading mb-4">
                <h2>إنقاذ الأرواح</h2>
                <p>.يمكنك الاطلاع على تجارب الاخرين مع موقعنا كما يمكنك مشاركة تجربتك الشخصية</p>
            </div>
            
            <div id="Stories" class="row g-4 flex-row-reverse">
                
            </div>
            
        </div>
    </section>
    <!-- End testimonials -->

    <!-- Start SaveLive -->
    <section id="SaveLive">
        <div class="container">
            <div class="main-heading mb-4">
                <h2 class="text-white">ابدأ في إنقاذ الأرواح</h2>
                <p class="text-white">كن متبرعًا أو اطلب الدم وساعد في إنقاذ الأرواح</p>
            </div>

            <a href="login.php" class="btn">سجل</a>
        </div>
    </section>
    <!-- End SaveLive -->

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

    <script>

        let map, infoWindow;
        function initMap() {
            map = new google.maps.Map(document.getElementById('google_map'), {
                center: { lat: 30.673561, lng: 31.589362 },
                zoom: 8,
            });
            var lat = [30.47413,30.671597,31.13830039884395,31.686243389617925];
            var lng = [31.589362,31.588970,29.82639756829841,31.686243389617925];
            
        let Results =[];

        async function all() {

            // let Response = await fetch(`https://api.themoviedb.org/3/movie/upcoming?api_key=c0d379e9b2fca29da7e3e39703976bc5&language=en-US&page=1`);

            let Response = await fetch(`https://blood-bank.life/api/api/v1/all_donate_places_info/530504012422/all`);
            let allData = await Response.json();
            Results = allData.data;
            for(var j=0;j<=Results.length;j++){
            // console.log(parseInt(Results[j]["lat"]));
            // console.log(parseInt(Results[j]["lng"]));
            add_marker({coords:{lat:parseFloat(Results[j]["lat"]),lng:parseFloat(Results[j]["lng"])},content:'<h3>'+ Results[j]["place_name"] +'</h3><hr><p style="width:45%;display:inline-block;float:right;text-align:center">تحت ادارة :- د/ ' + Results[j]["place_manager"] + '</p>' + '<p style="width:45%;display:inline-block;float:left;text-align:center">الاجازه الرسميه :- ' + Results[j]["holiday"] + '</p>' + '<br><hr><p style="width:45%;display:inline-block;float:right;text-align:center">يفتح في :- ' + Results[j]["open_at"] + '</p>' + '<p style="width:45%;display:inline-block;float:left;text-align:center">يغلق في  :- ' + Results[j]["close_at"] + '</p>'});
        }};

        all();

        // ============== function to add mark in map ================
        function add_marker(props){
        var marker = new google.maps.Marker({
        // position:{lat:27,lng:30},
        position:props.coords,
        map:map,
        icon:'./img/blood-donation.png',
        content:'<h1>hello</h1>'
        });
        if(props.content){
        var infoWindow = new google.maps.InfoWindow({
            content:props.content
        });
        marker.addListener('click',function(){
            infoWindow.open(map,marker);
        })
        }
    }
        // ============== select current location ================
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.getElementById("btn");

        locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        (position) => {
            const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent("Location found.");
            infoWindow.open(map);
            map.setCenter(pos);
        },
        () => {
            handleLocationError(true, infoWindow, map.getCenter());
        }
        );
        } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
        }
        });

        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
        browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
        }
    </script>
<?php 
require_once "./includes/template/footer.php";
?>