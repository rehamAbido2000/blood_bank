<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="bloodForm.css";
$script="bloodForm.js";
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
                    <small>اتصل</small>
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

    <section class="request">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="main-heading mb-5">
                        <h2> طلب دم عاجل </h2>
                        <p class="text-dark">قم بإنشاء طلبات دم جديدة تتوافق مع احتياجاتك في غضون ثوانٍ</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center g-4">

                <div class="title col-lg-6 mx-auto text-center ">
                    <div class="title-image">
                        <img src="./img/main_box/2.png" alt="blood_Transform">
                    </div>
                </div>

                <div class="col-lg-6 overflow-hidden">
                    <div class="swiper mySwiper ">
                        <div class="swiper-wrapper">
                            
                            <div class="swiper-slide">
                                <form>
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">هل تحتاج إلى دم كامل أو صفيحات
                                                        🩸؟</label>
                                                    <button  type="button" class="choose btn form-control my-4" data-bs-toggle="modal" data-bs-target="#TypeRequestModal" id="Type_Request">
                                                        اختر نوع الطلب
                                                    </button>
                                                    <button  id="req_type_go" type="button" class="cssbuttons-io-button mx-1  form-control dis">
                                                        <div class="swiper-button-next w-100">
                                                            <div class="text w-100">استمرار</div>
                                                            <div class="icon ">
                                                                <div class="">
                                                                    <i class="fas fa-arrow-left">
                                                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path
                                                                            d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                            fill="currentColor"></path>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form>
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4 ">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">ما فصيلة الدم التي تحتاجها
                                                        🩸؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#TypeBloodModal" id="Blood_Type">
                                                        اختر فصيلة الدم
                                                    </button>
                    
                                                    <div class="btns d-flex ">
                    
                                                        <button type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                    
                    
                                                            </div>
                                                        </button>
                                                        <button id="blood_type_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                    
                                                    </div>
                                                    
                                                </div>
                    
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form>
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4 ">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">كم عدد أكياس الدم التى تحتاجها ؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal0" id="Blood_Packets">
                                                    حدد العدد الذى تحتاجة
                                                    </button>
                    
                                                    <div class="btns d-flex ">
                    
                                                        <button type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                    
                    
                                                            </div>
                                                        </button>
                                                        <button id="packets_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                    
                    
                                                            </div>
                                                        </button>
                    
                                                    </div>
                                                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form>
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4 ">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">ما سبب هذا الطلب ؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2" id="Type_Reason">
                                                        اختر السبب الخاص بك
                                                    </button>
                    
                                                    <div class="btns d-flex ">
                    
                                                        <button type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                    
                    
                                                            </div>
                                                        </button>
                                                        <button id="reason_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                    
                    
                                                            </div>
                                                        </button>
                    
                                                    </div>
                                                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">اختار محافظتك؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal7" id="Type_Gov">حدد المحافظة</button>
                    
                                                    <div class="btns d-flex ">
                    
                                                        <button  type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <button id="gov_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">فى أى مدينة ؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal8" id="Type_City">حدد مدينتك</button>
                    
                                                    <div class="btns d-flex ">
                    
                                                        <button type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <button id="city_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12 my-4  px-4">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">في اي مستشفى تحتاج الى متبرع
                                                        بالدم
                                                        ؟</label>
                    
                                                    <button type="button" class="choose btn form-control my-4" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3" id="Type_Hospital">
                                                        حدد مستشفى
                                                    </button>
                                                    
                                                    <div class="btns d-flex ">
                    
                                                        <button type="button" class="cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-prev w-100">
                                                                <div class="text w-100">قبل</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-right">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <button id="hospital_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  ">
                                                            <div class="swiper-button-next w-100">
                                                                <div class="text w-100">استمرار</div>
                                                                <div class="icon ">
                                                                    <div class="">
                                                                        <i class="fas fa-arrow-left">
                                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path
                                                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                                                fill="currentColor"></path>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form>
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12  my-4 px-4">
                                                <div class="form">
                                                    <label for="" class="form-ques form-control">اكتب رساله للمتبرعين المحتملين
                                                        ؟</label>
                    
                                                    <textarea name="" id="req_message" cols="30" rows="10"
                                                        placeholder="اشرح للمتبرعين سبب احتياجك للدم ومدى إلحاحك"
                                                        class="choose form-control"></textarea>
                                                    <input id="message_val" value="" type="text" hidden>
                                                    <button id="finish_go" type="button" class="dis cssbuttons-io-button mx-1  form-control  finish ">
                                                        <div class="text w-100">
                                                            <a id="req_finished" class="w-100 text-white d-block" href="dash-make-post.php" data-bs-toggle="modal" data-bs-target="#quickRequest" >انهاء</a>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            
                            </div>
                        </div>
                        <!-- <div class="swiper-pagination position-static"></div> -->
                    </div>
                </div>
            </div>

            <!-- Modal quick Request -->
            <div class=" modal fade " id="quickRequest" tabindex="-1" aria-labelledby="quickRequestLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="quickRequestLabel">الطلب</h5>
                            <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div id="quick" class="modal-body modal-quick py-4 text-center">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End quick Request  -->

            <!-- modal slider 1 -->
            <div class=" modal fade " id="TypeRequestModal" tabindex="-1" aria-labelledby="TypeRequestModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TypeRequestModalLabel">نوع الطلب</h5>
                        </div>
                        <div id="Req_type" class="modal-body modal-req">
                            
                        </div>
                        <div class="modal-footer justify-content-start ">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose" data-bs-dismiss="modal" id="Btn_Type_Request">اختيار</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal slider 2 -->
            <div class=" modal fade " id="TypeBloodModal" tabindex="-1" aria-labelledby="TypeBloodModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TypeBloodModalLabel">نوع الدم</h5>
                        </div>
                        <div id="blood_Type_x" class="modal-body modal-blood">

                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class=" btn btn-choose" data-bs-dismiss="modal" id="Btn_Blood_Type">اختيار</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal slide  -->
            <div class=" modal fade " id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">كم كيس من الدم ؟</h5>
                        </div>
                        <div class="modal-body modal-blood-packets">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="packets" id="one"
                                    value="1" checked>
                                <label class="form-check-label" for="one">
                                    1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="packets" id="two"
                                    value="2">
                                <label class="form-check-label" for="two">
                                    2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="packets" id="three"
                                    value="3">
                                <label class="form-check-label" for="three">
                                    3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="packets" id="four"
                                    value="4">
                                <label class="form-check-label" for="four">
                                    4
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="packets" id="five"
                                    value="5">
                                <label class="form-check-label" for="five">
                                    5
                                </label>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose" onclick="check()" data-bs-dismiss="modal"
                                id="Btn_Blood_Packets">اختيار</button>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- modal slide 3 -->
            <div class=" modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ما السبب ؟</h5>
                        </div>
                        <div id="donate_reason" class="modal-body modal-reason">
                            
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose" onclick="check()" data-bs-dismiss="modal"
                                id="Btn_Type_Reason">اختيار</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal slide 4 -->
            <div class=" modal fade " id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> فى أى محافظة ؟</h5>

                        </div>
                        <div id="Gov" class="modal-body modal-Gov">
                            
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose"
                                data-bs-dismiss="modal" id="Btn_Type_Gov">اختيار</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal slide 5 -->
            <div class=" modal fade " id="exampleModal8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> فى أى مدينة ؟</h5>

                        </div>
                        <div  id="city" class="modal-body modal-City">
                            
                        </div>
                        <p class="No_City text-center text-danger fw-bold mb-4"></p>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose" onclick="check()"
                                data-bs-dismiss="modal" id="Btn_Type_City">اختيار</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal slide 6 -->
            <div class=" modal fade " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> فى أى مستشفى ؟</h5>

                        </div>
                        <div id="hospital" class="modal-body modal-hospital">
                                    
                        </div>
                        <p class="No_Hospital text-center text-danger fw-bold mb-4"></p>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-cancel " data-bs-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-choose" onclick="check()"
                                data-bs-dismiss="modal" id="Btn_Type_Hospital">اختيار</button>
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