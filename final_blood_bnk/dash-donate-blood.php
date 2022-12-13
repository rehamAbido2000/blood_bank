<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="dash-donate-blood.css";
$script="dash-donate-blood.js";
include "init.php";
if(isset($_SESSION['p_ssn'])){
if(isset($_SESSION["p_ssn"])){
?>
    <input type="number" hidden id="ssn" value="<?php echo $_SESSION["p_ssn"];?>">
<?php } else{?>
    <input type="number" hidden id="ssn" value="0">
<?php }?>

    <section class="dashHistory-navbar ">
    <div class="logo py-3">
        <a href="index.php">
            <div class="text-end">
                <h3>بنك الدم المصرى</h3>
                <small>اتصال</small>
            </div>
            <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
        </a>
    </div>
    <div class="position-relative">
            <nav id="main-nav" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="index.php">تسجيل الخروج <i class="fas fa-sign-out text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-favorites.php">مفضلات <i class="fas fa-bookmark text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="history.php">سجلات <i class="fas fa-history text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="userStory.php">قصصك <i class="fas fa-box-full text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-buy-blood.php">شراء الدم <i class="fas fa-tint text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-make-post.php">طلبات دم عاجلة <i class="fas fa-heartbeat text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="vacine.php">طلب اللقاح <i class="fas fa-syringe text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="bloodForm.php">طلب دم عاجل <i class="fas fa-tint text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder " href="dash-profile.php">الصفحة الشخصية <i class=" fas fa-home text-dark"></i></a></li>
                </ul>
            </nav>
            <nav id="nav-clone" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="index.php">تسجيل الخروج <i class="fas fa-sign-out fa-bookmark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-favorites.php">مفضلات <i class="fas fa-bookmark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="history.php">سجلات <i class="fas fa-history"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="userStory.php">قصصك <i class="fas fa-box-full"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-buy-blood.php">شراء الدم <i class="fas fa-tint"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="dash-make-post.php">طلبات دم عاجلة <i class="fas fa-heartbeat"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="vacine.php">طلب اللقاح <i class="fas fa-syringe"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="bloodForm.php">طلب دم عاجل <i class="fas fa-tint"></i></a></li>
                    <li class="px-3"><a class="fw-bolder " href="dash-profile.php">الصفحة الشخصية <i class=" fas fa-home"></i></a></li>
                </ul>

            </nav>
            <div class="bars d-xl-none d-block">
                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                    <div class="offcanvas-header py-2 shadow">
                        <i class="far fa-times" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></i>    
                        <div class="logo d-flex align-items-center">
                            <h3>بنك الدم المصرى</h3>
                            <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                        </div>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="canv_links  text-dark mb-5">
                            <li><a class="" href="dash-profile.php"><i class=" fas fa-home ms-2 fa-fw"></i>الصفحة الشخصية</a></li>
                            <li><a href="bloodForm.php"><i class="fas fa-tint ms-2 fa-fw"></i>طلب دم عاجل</a></li>
                            <li><a href="vacine.php"><i class="fas fa-syringe ms-2 fa-fw"></i>طلب اللقاح</a></li>
                            <li><a href="dash-make-post.php"><i class="fas fa-heartbeat ms-2 fa-fw"></i>طلبات دم عاجلة</a></li>
                            <li><a href="dash-buy-blood.php"><i class="fas fa-tint ms-2 fa-fw"></i>شراء الدم </a></li>
                            <li><a href="userStory.php"><i class="fas fa-box-full ms-2 fa-fw"></i>قصصك</a></li>
                            <li><a href="history.php"><i class="fas fa-history ms-2 fa-fw"></i>سجلات </a></li>
                            <li><a href="dash-favorites.php"><i class="fas fa-bookmark ms-2 fa-fw"></i>مفضلات </a></li>
                            <li><a href="index.php"><i class="fas fa-sign-out ms-2 fa-fw"></i>تسجيل الخروج </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- For Loading -->
<div class="loading justify-content-center align-items-center">
    <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
</div>
<!-- End -->

<section id="dashHistory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="main-heading mb-5">
                    <h2> تبرع بالدم </h2>
                    <p class="text-dark">قم بالتبرع بالدم لنصبح واحد من الأبطال الذين يضحون من أجل إنقاذ المحتاجين</p>
                </div>
            </div>
        </div>
        <div class="main-box">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blood text-end bg-white">

                        <h4 class="blood-title fw-bold">إبدأ فى إنقاذ المحتاجين</h4>
                        <div class="blood-details p-3">
                            <div class="blood-info">
                                <form id="form">
                                    <div class="row g-4 justify-content-center flex-row-reverse">
                                    
                                        <div class="col-md-6">
                                            <label for="bloodType">فصيلة الدم</label>
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control" id="bloodType" name="bloodType"  disabled>
                                                <div class="field-icon"><i class="fas fa-tint"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gov">المحافظة</label>
                                            <div class="form-group mb-0">
                                                <input list="Gov_x" type="text" class="form-control" id="gov" name="gov" placeholder="اختار محافظتك" required>
                                                <div class="field-icon"><i class="fas fa-location-arrow"></i></div>
                                                <datalist id="Gov_x">

                                                </datalist>
                                                <input type="hidden" name="answer" id="gov-hidden">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city">المدينة</label>
                                            <div class="form-group mb-0">
                                                <input  list="City_x" type="text" class="form-control" id="city" name="city" placeholder="اختار مدينتك" required>
                                                <div class="field-icon"><i class="fas fa-location-arrow"></i></div>
                                                <datalist id="City_x">

                                                </datalist>
                                                <input type="hidden" name="answer" id="city-hidden">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="donate_place">مكان التبرع</label>
                                            <div class="form-group mb-0">
                                                <input list= "donate_place_x" type="text" class="form-control" id="placeId" name="Donate_place" placeholder="اختار المكان" required>
                                                <div class="field-icon"><i class="fas fa-location-arrow"></i></div>
                                                <datalist id="donate_place_x">

                                                </datalist>
                                                <input type="hidden" name="answer" id="placeId-hidden">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="donate_time">المعاد</label>
                                            <div class="form-group mb-0">
                                                <input type="date" class="form-control total-price"  id="donate_time" name="donate_time" required>
                                                <div class="field-icon"><i class="fas fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="btns text-center">
                                            <button id="sendData" type="submit" class="btn btn-send" data-bs-toggle="modal" data-bs-target="#DonateRequest" disabled>إرسال</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Donate Request -->
                        <div class="modal fade" id="DonateRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DonateRequestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content Yes bg-transparent">
                                    <div class="Yes">
                                        <div class="comments d-flex flex-column rounded-1 m-auto">
                                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                                                <span class="fw-bold fs-5">حجز الموعد</span>
                                            </div>
                                            <div class="comm-body d-flex justify-content-center bg-white text-dark px-3 py-5">
                                                <p id="donate_msg" class=" text-danger fw-bold"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Donate Request  -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
}else{
    header('location:login.php');
}
?>