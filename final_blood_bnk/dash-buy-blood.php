<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="dash-buy-blood.css";
$script="dash-buy-blood.js";
include "init.php";
if(isset($_SESSION['p_ssn'])){

if(isset($_GET['to']) && $_GET['to'] = "outer_gov_process"){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['amount']) && isset($_GET['blood_id'])){
        if(isset($_POST['token']) && $_POST['token'] == "from_multi_gov"){

            @$place = FILTER_VAR( $_POST['place'], FILTER_SANITIZE_NUMBER_INT);
            @$p_ssn = $_SESSION['p_ssn'];
            @$blood = $_GET['blood_id'];
            $choosen_place_Data = get_amount_by_place_and_blood($place,$blood);
            @$amount = $choosen_place_Data["amount"] - $_GET['amount'];    
            update_amount_of_avilable_blood($choosen_place_Data["id"],$amount);
            insert_purchase_order($p_ssn,$blood,$place,$_GET['amount']);
            $hospital_name = select_by_id("donate_places",$place);
            $order_id = get_purchast_order_id($p_ssn);
            mail($_SESSION['email'],"Request to purchase blood bags","<h2>Blood bags were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
            echo "
            <script>
                toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
            </script>";
            header("Refresh:15;url=dash-buy-blood.php");     
        }
    }else{
        echo "
        <script>
            toastr.error('خطأ في ارسال البيانات ... من فضلك تاكد من اختيارك لفصيلة الدم والكميه المطلوبه')
        </script>";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    @$bloodType = FILTER_VAR( $_POST['blood_type'], FILTER_SANITIZE_NUMBER_INT);
    // @$bloodType = 2;
    @$numOfBlood = FILTER_VAR( $_POST['num_of_bags'], FILTER_SANITIZE_NUMBER_INT);
    $blood_data = buy_blood($_SESSION['p_ssn'],$_SESSION['city_id'],$bloodType,$numOfBlood);
    if(isset($blood_data) && gettype($blood_data) == "array"){?>

        <div style="position:initial !important" class="ui modal">
            <i class="close icon"></i>
            <div style="font-family: 'Cairo', sans-serif" class="header">
                عفوا .. لا تتوفر هذه الفصيله داخل محافظتك
            </div>
            <form method="POST" action=<?php echo "dash-buy-blood.php?to=outer_gov_process&amount=" . $numOfBlood . "&blood_id=" . $bloodType;?> >
                    <div class="description">
                    <div style="font-family: 'Cairo', sans-serif;margin-bottom: 20px;margin: 40px;" class="ui header">هذه بعض المحافظات التي تتوفر بها الفصيله يمكنك اختيار واحده منها لاستلام الاكياس منها</div>
                    <input type="text" value="from_multi_gov" name="token" hidden>
                    <select required class="ui fluid search dropdown" style="margin:20px 0" name="place">
                        <option selected disabled value="">...اختر مكان الاستلام</option>
                        <?php foreach ($blood_data as $daata){ $place_name = get_all_donate_places_info_with_place_id($daata["place_id"]); ?>
                        <option value="<?php echo $daata["place_id"]; ?>"><?php echo $place_name["governorate_name"] . " - " . $place_name["city_name"] . " - " . $place_name["place_name"]; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div style="margin:30px 0;">
                        <div class="ui black deny button">
                            الغاء
                        </div>
                        <button type="submit" class="ui positive right labeled icon button">
                        تاكيد الطلب 
                            <i class="checkmark icon"></i>
                        </button>
                    </div>
                </form>
        </div>





    
    <?php }else{
        if($blood_data == NULL && empty($_GET['to'])){?>

        <script>
                toastr.error('نأسف لعدم توفر فصيلة الدم في انحاء الجمهوريه .. سوف يتم تقديم طلب لتوفير هذه الفصيله')
                header("Refresh:10;url=dash-buy-blood.php");     
            </script>
        <?php }?>

        <?php
        
    }

}
?>


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
    
    <section id="dashHistory">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="main-heading mb-5">
                        <h2> شراء الدم </h2>
                        <p class="text-dark">قم بشراء أكياس دم تتوافق مع احتياجاتك في غضون دقائق</p>
                    </div>
                </div>
            </div>
            <div class="main-box">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="image"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="blood text-end bg-white">
    
                            <h4 class="blood-title">مواصفات الدم</h4>
                            <div class="blood-details p-3">
                                <div class="blood-info">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                                        <div class="row g-4 justify-content-end flex-row-reverse">
                                        
                                            <div class="col-md-6">
                                                <label for="bloodType">فصيلة الدم</label>
                                                <div class="form-group mb-0">

                                                <select id="blood_type-z"  required class=" ui fluid search dropdown text-end"  name="blood_type">
                                                
                                                    
                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="numOfBlood">عدد الأكياس</label>
                                                <div class="form-group mb-0">
                                                    <select id="blood_bags_num" required class=" ui fluid search dropdown text-end"  name="num_of_bags">
                                                        <option selected disabled value=""> .. اختر عدد الاكياس  </option>
                                                        <?php $i=1 ; for ($i;$i<=10;$i++){ ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="priceOfBlood">سعر الكيس</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="priceOfBlood" name="priceOfBlood" disabled>
                                                    <div class="field-icon"><i class="fas fa-money-bill-wave"></i></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="totalPriceOfBlood">السعر الكلى</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control total-price" id="totalPriceOfBlood" name="totalPriceOfBlood"  disabled>
                                                    <div class="field-icon"><i class="fas fa-money-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="btns text-center">
                                                <button id="request" type="submit" class="btn btn-send">إرسال الطلب</button>
                                            </div>
                                            <!-- Modal -->

                                        </div>
                                    </form>
                                </div>
                            </div>

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
require "./includes/template/footer.php";
}else{
    header('location:login.php');
}
?>