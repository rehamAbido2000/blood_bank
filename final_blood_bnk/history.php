<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="history.css";
$script="history.js";
include "init.php";
if(isset($_SESSION['p_ssn'])){
    if(isset($_SESSION["p_ssn"])){
        ?>
            <input type="number" hidden id="ssn" value="<?php echo $_SESSION["p_ssn"];?>">
        <?php } else{?>
            <input type="number" hidden id="ssn" value="0">
        <?php }?>
    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
        <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->
    
    <section class="dashHistory-navbar ">
        <div class="logo py-3">
            <a href="index.php">
                <div class="text-end">
                    <h3>حياتكم تهمنا</h3>
                    <small>اتصل</small>
                </div>
                <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
            </a>
        </div>
        <div class="position-relative">
            <nav id="main-nav" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
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
                            <h3>حياتكم تهمنا</h3>
                            <img src="img/logo/savelife-red.svg" alt="BloodBank_Logo">
                        </div>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="canv_links  text-dark mb-5">
                            <li><a class="" href="dash-profile.php"><i class=" fas fa-home ms-2"></i>الصفحة الشخصية</a></li>
                            <li><a href="bloodForm.php"><i class="fas fa-tint ms-2"></i>طلب دم عاجل</a></li>
                            <li><a href="vacine.php"><i class="fas fa-syringe ms-2"></i>طلب اللقاح</a></li>
                            <li><a href="dash-make-post.php"><i class="fas fa-heartbeat ms-2"></i>طلبات دم عاجلة</a></li>
                            <li><a href="dash-buy-blood.php"><i class="fas fa-tint ms-2"></i>شراء الدم </a></li>
                            <li><a href="userStory.php"><i class="fas fa-box-full ms-2"></i>قصصك</a></li>
                            <li><a href="history.php"><i class="fas fa-history ms-2"></i>سجلات </a></li>
                            <li><a href="dash-favorites.php"><i class="fas fa-bookmark ms-2"></i>مفضلات </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start History -->
    <section class="history overflow-hidden" id="history">
        <div class="container">
            <nav class=" w-100 d-flex justify-content-center" >
                <div class="nav nav-tabs d-flex justify-content-center bg-white " id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        data-filter="all">الكل</button>
                    <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                        data-filter=".quick_request">طلباتك العاجلة</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false"
                        data-filter=".vaccine_request">طلبات اللقاح</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false"
                        data-filter=".blood_request">طلبات الدم</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false"
                    data-filter=".last_request">أخر تبرع</button>
                    </div>
            </nav>

            <div class="tab-content " id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="port">
                        <div class="row ">


                            <div class="mix quick_request text-center m-auto">
                                <h2 class="h2-color text-center">طلبات  عاجلة</h2>
                                <div class="full d-flex justify-content-center">
                                    <div class="feed_History d-flex justify-content-center my-5">
                                        <div class="row g-4 w-100 justify-content-center">
                                            <div class="col-xl-12">
                                                <p class="No_Posts text-center text-danger fw-bold fs-4 my-md-0 my-5"></p>
                                                
                                                <div id="Posts" class="row g-4 justify-content-center">
                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal saveBlood Request -->
                                        <div class="modal fade" id="saveBloodRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="saveBloodRequestLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content Yes bg-transparent">
                                                    <div class="Yes">
                                                        <div class="comments h-auto d-flex flex-column rounded-1 m-auto">
                                                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                <span class="fw-bold fs-5">حفظ طلب التبرع</span>
                                                            </div>
                                                            <div class="comm-body d-flex justify-content-center bg-white text-dark px-3 py-5">
                                                                <p id="saveBlood_msg" class=" text-danger fw-bold"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End saveBlood Request  -->
                                            
                                        <!-- Modal-Comments -->
                                        <div class="modal fade" id="Comments" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CommentsLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-transparent">
                                                    <div class="main-comments ">
                                                        <div class="comments d-flex flex-column rounded-1 m-auto">
                                                            <div class="comm-head d-flex justify-content-between align-items-center p-3 text-white">
                                                                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                <span class="fw-bold fs-5">المتطوعين</span>
                                                            </div>
                                                            
                                                            <div class="No_Going_don comm-img d-flex justify-content-center align-items-center flex-column py-3 d-none">
                                                                <img src="img/no_blood_activity.svg" alt="no_blood_activity">
                                                                <p class="text-danger fw-bold">لا يوجد متطوعين قاموا بتلبية الطلب</p>
                                                            </div>
                                                            
                                                            <div id="com_body" class="comm-body  d-flex flex-column flex-grow-1 bg-white px-3 py-2">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End --> 
                                    </div> 
                                </div>
                            </div>

                            <div class="mix vaccine_request py-5">
                                <h2 class=" h2-color mb-4 text-center">طلبات اللقاح</h2>    
                                <div class="full d-flex justify-content-center w-100">
                                    <div id="vacReqs" class="row g-4 justify-content-center"></div>
                                </div>
                            </div>

                            <div class="mix blood_request py-5">
                                <h2 class=" h2-color mb-4 text-center">طلبات الدم</h2>
                                <div class="full d-flex justify-content-center">
                                    <div class="container">
                                        <div class="cards">
                                            <div id="bloodReqs" class="row g-4 justify-content-center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mix last_request py-5">
                                <h2 class="h2-color mb-4 text-center">أخر تبرع </h2>
                                <div class="full d-flex justify-content-center">
                                    <div class="container">
                                        <div class="cards">
                                            <div class="row flex-row-reverse">
                                                <div class="col-md-8  m-auto ">
                                                    <div class="last_card card-3">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="card__exit"><i class="fas fa-bolt"></i></p>
                                                            <div class="card__icon"><i class="fas fa-viruses "></i></div>
                                                        </div>
                                                        <div class="general m-auto  mb-2 text-center">
                                                            <h2 class="mb-2">أخر مره تبرعت بالدم</h2>
                                                           
                                                            <span id="last_donate_date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End History -->

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

    <!-- Spinner Laoding -->
    <p class="spinner text-center">
        <i class="fad fa-spinner-third fa-spin fa-3x  text-danger"></i>    
    </p>
    <!-- End Spinner Laoding -->
    <!-- Btn Up -->
    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5"></i> </a>

<?php 
require_once "./includes/template/footer.php";
}else{
    header('location:login.php');
}
?>