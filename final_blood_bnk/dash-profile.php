<?php    
ob_start();
session_start();
$page_name = "بنك الدم المصري";
$style="dash-profile.css";
$script="dash-profile.js";
include "init.php";
$city = select_by_id('cities',$_SESSION['city_id']);
$govr = select_by_id('governorate',$city['gov_id']);
$gender = select_by_id('gender',$_SESSION['gender_id']);
$blood = select_by_id('blood_type',$_SESSION['blood_type']);
$all_gov_data = getAllData('governorate');
$all_gender = getAllData('gender');
$all_blood = getAllData('blood_type');
if(isset($_SESSION['p_ssn'])){
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $p_ssn = intval(filter_var($_POST["ssn"] , FILTER_SANITIZE_NUMBER_INT));
        $f_name = filter_var($_POST["f_name"] , FILTER_SANITIZE_STRING);
        $l_name = filter_var($_POST["l_name"] , FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"] , FILTER_SANITIZE_EMAIL);
        $tel1 = intval(filter_var($_POST["tel1"] , FILTER_SANITIZE_NUMBER_INT));
        $tel2 = intval(filter_var($_POST["tel2"] , FILTER_SANITIZE_NUMBER_INT));
        $blood_type = intval(filter_var($_POST["blood"] , FILTER_SANITIZE_NUMBER_INT));
        $gov = intval(filter_var($_POST["Gov_id"] , FILTER_SANITIZE_NUMBER_INT));
        $city_id = intval(filter_var($_POST["city_id"] , FILTER_SANITIZE_NUMBER_INT));
        $gender_id = intval(filter_var($_POST["gender"] , FILTER_SANITIZE_NUMBER_INT));
        $bb = $_POST["birthday"];
        $birthday = strtotime($_POST["birthday"]);
        $final_birth = date ( 'Y-m-d' , $birthday );
        $password = $_POST["password"];
        $hash = password_hash($password , PASSWORD_DEFAULT);
        echo $blood_type;
        echo gettype($blood_type);
        if(empty($f_name)||empty($l_name)||strlen($f_name)<3 ||strlen($l_name)<3 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الاسم بطريقة صحيحه (يجب ان يكون اكثر من 3 حروف')
            </script>";
            $name_error="border border-danger";
        }
        if(empty($p_ssn)||strlen($p_ssn)<14 ||strlen($p_ssn)>14 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الرقم القومي بطريقة صحيحه (يجب ان يكون مكون من 14 رقم')
            </script>";
            $ssn_error="border border-danger";
        }
        if(empty($password)||strlen($password)<5 ){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الرقم السري بطريقة صحيحه (يجب ان يكون اكثر من 5 رمز')
            </script>";
            $password_error="border border-danger";
        }
        if(empty($email)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال  البريد الالكتروني بطريقة صحيحه ')
            </script>";
            $email_error="border border-danger";
        }
        if(empty($tel1)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال رقم الهاتف بطريقة صحيحه ')
            </script>";
            $tel1_error="border border-danger";
        }
        if(empty($tel2)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال رقم الهاتف بطريقة صحيحه ')
            </script>";
            $tel2_error="border border-danger";
        }
        if(empty($blood_type)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال فصيله الدم بطريقة صحيحه ')
            </script>";
            $blood_error="border border-danger";
        }
        if(empty($gov)){
            $gov = $govr['id'];
        }
        if(empty($city_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال المدينه بطريقة صحيحه ')
            </script>";
            $city_error="border border-danger";
        }
        if(empty($gender_id)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال النوع بطريقة صحيحه ')
            </script>";
            $gender_error="border border-danger";
        }
        if(empty($birthday)){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال تاريخ الميلاد بطريقة صحيحه ')
            </script>";
            $birthday_error="border border-danger";
        }
        if(empty($formErrors)){
        
        $avatar_name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type =$_FILES['image']['type'];
        $extention_allowed = array('png','jpg','jpeg','');
        $img_ex = explode(".",$avatar_name);
        $img_end = end($img_ex);
        $extention = strtolower($img_end);
        if(in_array($extention,$extention_allowed)){
            $avatar = $f_name . "_" . rand(0,1000) . "." . $extention ;
            $destination = "img/users/" . $avatar ;
        
                /*check if info already added*/
                if($p_ssn != $_SESSION['p_ssn']){

                
                global $con;
                $stmt = $con->prepare("SELECT * FROM patients_donors WHERE p_ssn = ?");
                $stmt->execute(array($p_ssn));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. الرقم القومي المسجل موجود بالفعل مسبقا')
                        </script>";
                }
                else{
                    update_patient($p_ssn,$f_name,$l_name,$email,$tel1,$tel2,$hash,$blood_type,$final_birth,$gender_id,$avatar,$city_id,$_SESSION['p_ssn']);
                    move_uploaded_file($tmp_name,$destination);
                } 
            }else{
                    update_patient($p_ssn,$f_name,$l_name,$email,$tel1,$tel2,$hash,$blood_type,$final_birth,$gender_id,$avatar,$city_id,$_SESSION['p_ssn']);
                    move_uploaded_file($tmp_name,$destination);
                }

        }else{
            echo "
            <script>
            toastr.error('امتداد الصورة غير مصرح به')
            </script>";
        }   
            
        }
        
     
    }
        if (isset($formErrors)){ 
        foreach($formErrors as $error){
            echo $error;
        }
    }
?>

    <!-- For Loading -->
    <div class="loading justify-content-center align-items-center">
        <img src="img/logo/savelife-light.svg" alt="BloodBank_Logo">
    </div>
    <!-- End -->

    <section class="dashHistory-navbar">
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

    
    <section id="dashHistory">
        <div class="container">
            <div class="feed_History my-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-9">
                        <div class="profile text-end bg-white">
    
                            <div class="person p-3 d-flex justify-content-center align-items-center">
                                <div class="per-img text-center">
                                    <img src="img/<?php if($_SESSION['gender_id']== 1){echo "man.png";}else{echo "woman.png";} ?>" alt="Mohamed Image">
                                    <h4 class="mt-2"><?php echo $_SESSION['p_first_name'] ." ".$_SESSION['p_last_name']     ?></h4>
                                </div>
                            </div>
                            <h6 class="p-3">المعلومات الشخصية</h6>
                            <div class="person-details p-3">
                                <div class="person-info">
                                <form  method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                        <div class="row g-4 justify-content-center flex-row-reverse">
                                            <div class="col-md-4">
                                                <label for="firstName">الأسم الأول</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="firstName" name="f_name" value="<?php echo $_SESSION['p_first_name']?> ">
                                                    <div class="field-icon"><i class="fas fa-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="lastName">أسم العائلة</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="lastName" name="l_name" value="<?php echo $_SESSION['p_last_name']?>">
                                                    <div class="field-icon"><i class="fas fa-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <label for="img">الصورة</label>
                                            <div class="form-group mb-0">
                                                <input type="file" class="form-control" id="img" name="image" value="image">
                                                <div class="field-icon"><i class="fas fa-photo-video"></i></div>
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <label for="email">البريد الإلكترونى</label>
                                                <div class="form-group mb-0">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']?>">
                                                    <div class="field-icon"><i class="fas fa-envelope-square"></i></div>
                                                </div>
                                            </div>
                                            <div style="text-align: right !important;direction: rtl;" class="col-md-4  mb-3">
                                        <label for="gov">المحافظه</label>
                                        <select class="<?php if(isset($gov_error)){echo $gov_error;}?> custom-select ui search dropdown" name="Gov_id" id="gov">
                                            <option selected  value="<?php echo  $govr["id"]; ?>"><?php echo  $govr["name"]; ?></option>
                                            <?php foreach($all_gov_data as $gov_data){ 
                                                    ?>
                                                <option value="<?php echo $gov_data['id'];?>"><?php echo $gov_data["name"]; ?></option>
                                                <?php
                                                 } ?>
                                        </select>
                                        </div>
                                        <div style="text-align: right !important;direction: rtl;" class="col-md-4  mb-3 ">
                                                <label for="city_id">المدينه</label>
                                                <select class=" <?php if(isset($city_error)){echo $city_error;} ?> drop custom-select ui search dropdown" name="city_id" id="select_city">
                                                <option selected  value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                </select>
                                        </div>
                                            <div class="col-md-4">
                                                <label for="phone">رقم الموبايل الأول</label>
                                                <div class="form-group mb-0">
                                                    <input type="tel"  id="phone1" class="form-control" name="tel1" value="<?php echo $_SESSION['mobile_phone']?>">
                                                    <div class="field-icon"><i class="fas fa-mobile"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="phone">رقم الموبايل الثانى</label>
                                                <div class="form-group mb-0">
                                                    <input type="tel" id="phone2" class="form-control" name="tel2" value="<?php echo $_SESSION['home_phone']?>">
                                                    <div class="field-icon"><i class="fas fa-mobile"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="ssn">الرقم القومى</label>
                                                <div class="form-group mb-0">
                                                    <input type="number" id="ssn" class="form-control" name="ssn" value="<?php echo $_SESSION['p_ssn']?>">
                                                    <div class="field-icon"><i class="fas fa-id-card"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="birthday">عيد الميلاد</label>
                                                <div class="form-group mb-0">
                                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $_SESSION['birthday']?>">
                                                    <div class="field-icon"><i class="fas fa-birthday-cake"></i></div>
                                                </div>
                                            </div>
                                            <div style="text-align: right !important;direction: rtl;" class="col-md-4  mb-3">
                        <label for="gender">الجنس</label>
                        <select class="<?php if(isset($gov_error)){echo $gov_error;}?> custom-select ui search dropdown" name="gender" id="select_gender">
                            <option selected  value="<?php echo  $gender['id']; ?>"><?php echo  $gender['type']; ?></option>
                            <?php foreach($all_gender as $data){ 
                                if($data['id'] == $gender['id']){
                                    continue;
                                }else{
                                    ?>
                                <option value="<?php echo $data['id'];?>"><?php echo $data["type"]; ?></option>
                                <?php
                                } } ?>
                        </select>
                    </div>
                    <div style="text-align: right !important;direction: rtl;" class="col-md-4  mb-3">
                        <label for="bloodType">فصيلة الدم</label>
                        <select class="<?php if(isset($blood_error)){echo $blood_error;}?> custom-select ui search dropdown" name="blood" id="bloodType">
                            <option selected value="<?php echo $blood['id'] ?>"><?php echo $blood['name'] ?></option>
                            <?php foreach($all_blood as $data){ 
                                    ?>
                                <option value="<?php echo $data['id'];?>"><?php echo $data["name"]; ?></option>
                                <?php
                                 } ?>
                        </select>
                    </div>
                                            <div class="col-md-4">
                                                <label for="password">الرقم السرى</label>
                                                <div class="form-group mb-0">
                                                    <input type="password" class="form-control" id="password" name="password" value="">
                                                    <div class="field-icon"><i class="fas fa-key"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="btns text-center">
                                                <button class="btn btn-cancel">إلغاء</button>
                                                <button type="submit" class="btn btn-update">تحديث</button>
                                            </div>
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
}else{
    header('location:login.php');
}
require_once "./includes/template/footer.php";
?>
