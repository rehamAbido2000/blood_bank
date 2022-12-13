<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="story.css";
$script="story.js";
include "init.php";
if(isset($_SESSION["p_ssn"])){
?>
    <input type="number" hidden id="ssn" value="<?php echo $_SESSION["p_ssn"];?>">
<?php } else{?>
    <input type="number" hidden id="ssn" value="0">
<?php }?>
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

    <!-- Story -->
    <section class="Story d-flex justify-content-center align-items-center flex-column">
    <div class="title text-center">
        <h2 class="mb-3">قصص </h2>
        <p class=" text-center">قم بمشاركة تجربتك مع الأخرين</p>
    </div>
    </section>
    <!-- End Story  -->


    <section class="testimonial_section">
        
        <div class="about_content">
            <div class="layer_content">
                <div class="container">
                    <div class="section_title">
                        <h3>يمكنك الان الاطلاع على قصص الاخرين و ايضا انشاء قصتك الخاصه</h3>
                        <div class="heading_line"><span></span></div>
                        <p>  تقوم الاشخاص بنشر تجربتهم مع الموقع و كيف ساعدهم التبرع في انقاذ حياه اشخاص اخرين يمكنك قراءه هذا ربما تغير شيءما بك او تفيدك تجربه احدهم .</p>
                    </div>

                    <div class="main-btns">
                        <button class="btn btn-send fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">انشاء قصتك</button>
                        <button class="btn btn-send "><a href="userStory.php" class="text-white">قصصك</a></button>
                    </div>

                    <a href="login.php" class="btn btn-send fw-bold btn-login">تسجيل الدخول لإنشاء قصتك</a>
                                
                </div>

                <div class="container">
                
                    <div id="Stories"  class="row g-4 mt-5">
                        
                    </div>
                        
                </div>
            </div>
        </div>
        
    </section>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center">
        <div class="modal-content">
            <div class="login-box">
                <h3>إنشاء قصة</h3>
                <form>
                <div class="user-box">
                    <div class="form-floating ">
                        <textarea class="msg_content form-control" placeholder="Leave a comment here" id="floatingTextarea2" 
                            style="height: 80px"></textarea>
                        <label for="floatingTextarea2">احكي قصتك</label>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="button" class="delete" data-bs-dismiss="modal" aria-label="Close">تراجع</button>
                    <button id="addStory" type="button" class=" update mx-2"  >نشر</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal success_add Request -->
    <div class="modal fade" id="success_add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="success_addLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center">
            <div class="modal-content  h-auto Yes bg-transparent">
                <div class="Yes">
                    <div class="comments  d-flex flex-column rounded-1 m-auto">
                        <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                            <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                            <span class="fw-bold fs-5">إنشاء قصة</span>
                        </div>
                        <div class="comm-body d-flex justify-content-center bg-white text-dark px-3 py-5">
                            <p id="create_msg" class=" text-danger fw-bold"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End success_add Request  --> 

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



<?php 
require_once "./includes/template/footer.php";
?>