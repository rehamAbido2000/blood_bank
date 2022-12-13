<?php 
    $role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']);

?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">الاقسام الرئيسيه</div>
                            <a class="nav-link" href="<?php echo "admin_dash.php";?>">
                                <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/dashboard_icon.svg" alt="dashboard_icon"></div>
                                لوحة التحكم
                            </a>
                            <div class="sb-sidenav-menu-heading">الاقسام</div>
                            
                            
                            <!-- ============= start role section ============== -->
                            <?php if(in_array("all_role",$roles) || in_array("add_role",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts45" aria-expanded="false" aria-controls="collapseLayouts45">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/rules.svg" alt="rules"></div>
                                    الصلاحيات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts45" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_role",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_role_admin.php?to=role";?>">اضافة صلاحيه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_role",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_role_admin.php?to=role";?>">تعديل / حذف صلاحيه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start admin section ============== -->
                            <?php if(in_array("all_admin",$roles) || in_array("add_admin",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts9">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/admin_icon.svg" alt="admins"></div>
                                    المسئولين
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_admin",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_role_admin.php";?>">اضافة مسئول</a>
                                        <?php } ?>
                                        <?php if(in_array("all_admin",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_role_admin.php";?>">تعديل / حذف مسئول</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start blood section ============== -->
                            <?php if(in_array("add_blood",$roles) || in_array("all_blood",$roles) || in_array("add_avilable_blood",$roles) || in_array("all_avilable_blood",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts44" aria-expanded="false" aria-controls="collapseLayouts44">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/blood_icon.svg" alt="blood"></div>
                                    فصائل الدم
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts44" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_blood",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_blood_vaccine.php?to=add_blood";?>">اضافة فصيله</a>
                                        <?php } ?>
                                        <?php if(in_array("all_blood",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_blood_vaccine.php?to=all_blood";?>">حذف / تعديل فصيله</a>
                                        <?php } ?>
                                        <?php if(in_array("add_avilable_blood",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_blood_vaccine.php?to=add_avilable_blood";?>">اضافة فصيله دم متوفره</a>
                                        <?php } ?>
                                        <?php if(in_array("all_avilable_blood",$roles)){?>
                                            <a class="nav-link" href="<?php echo "available_vaccines.php?to=add_availble_blood";?>">حذف / تعديل فصيله دم متوفره</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start vaccine section ============== -->
                            <?php if(in_array("add_vaccine",$roles) || in_array("all_vaccine",$roles) || in_array("add_avilable_vaccine",$roles) || in_array("all_avilable_vaccine",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/vaccine_icon.svg" alt="vaccine"></div>
                                    اللقاحات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">

                                        <?php if(in_array("add_vaccine",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_blood_vaccine.php?to=vaccine_name";?>">اضافة اسم لقاح</a>
                                        <?php } ?>
                                        <?php if(in_array("all_vaccine",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_blood_vaccine.php?to=vaccine_name";?>">حذف / تعديل اسم لقاح</a>
                                        <?php } ?>
                                        <?php if(in_array("add_avilable_vaccine",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_blood_vaccine.php";?>">اضافة لقاح متوفر</a>
                                        <?php } ?>
                                        <?php if(in_array("all_avilable_vaccine",$roles)){?>
                                            <a class="nav-link" href="<?php echo "available_vaccines.php";?>">حذف / تعديل لقاح متوفر </a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start donate places section ============== -->
                            <?php if(in_array("all_place",$roles) || in_array("add_place",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#donate_places" aria-expanded="false" aria-controls="donate_places">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/places.svg" alt="places"></div>
                                    اماكن التبرع
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="donate_places" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_place",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_donate_places.php";?>">اضافة مكان للتبرع</a>     
                                        <?php } ?>
                                        <?php if(in_array("all_place",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_donate_places.php";?>">حذف / تعديل مكان للتبرع</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start api users section ============== -->
                            <?php if(in_array("all_api_users",$roles) || in_array("add_api_user",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#api_users" aria-expanded="false" aria-controls="api_users">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/api_user.svg" alt="api_user"></div>
                                    <p style="padding: unset;margin: unset;">مستخدمين البيانات (API)</p>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="api_users" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_api_user",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_api_user.php";?>">اضافة مستخدم بيانات</a>
                                        <?php } ?>
                                        <?php if(in_array("all_api_users",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_api_users.php";?>">حذف / تعديل مستخدم بيانات</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start country section ============== -->
                            <?php if(in_array("all_country",$roles) || in_array("add_country",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#country" aria-expanded="false" aria-controls="country">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/country_icon.svg" alt="country"></div>
                                    البلاد
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="country" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_country",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_gov_city.php?to=country";?>">اضافة بلد</a>
                                        <?php } ?>
                                        <?php if(in_array("all_country",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_gov_city.php?to=country";?>">حذف / تعديل بلد</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start governorate section ============== -->
                            <?php if(in_array("all_gov_city",$roles) || in_array("add_gov_city",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gov" aria-expanded="false" aria-controls="gov">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/gov_icon.svg" alt="gov"></div>
                                    المحافظات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="gov" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_gov_city",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_gov_city.php?to=gov";?>">اضافة محافظه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_gov_city",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_gov_city.php?to=gov";?>">حذف / تعديل محافظه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start city section ============== -->
                            <?php if(in_array("all_gov_city",$roles) || in_array("add_gov_city",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#city" aria-expanded="false" aria-controls="city">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/city_icon.svg" alt="city"></div>
                                    المدن
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="city" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_gov_city",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_gov_city.php?to=city";?>">اضافة مدينه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_gov_city",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_gov_city.php?to=city";?>">حذف / تعديل مدينه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start news section ============== -->
                            <?php if(in_array("all_news",$roles) || in_array("add_news",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#news" aria-expanded="false" aria-controls="news">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/news_icon.svg" alt="gov"></div>
                                    الاخبار
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="news" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_news",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_news.php";?>">اضافة خبر</a>
                                        <?php } ?>
                                        <?php if(in_array("all_news",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_news.php";?>">حذف / تعديل خبر</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start diseases section ============== -->
                            <?php if(in_array("all_diseas",$roles) || in_array("add_diseas",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#diseases" aria-expanded="false" aria-controls="diseases">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/disease_icon.svg" alt="disease_icon"></div>
                                    الامراض
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="diseases" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_diseas",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_diseases.php";?>">اضافة مرض</a>
                                        <?php } ?>
                                        <?php if(in_array("all_diseas",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_diseases.php";?>">حذف / تعديل مرض</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start donate reasons section ============== -->
                            <?php if(in_array("all_reason",$roles) || in_array("add_reason",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#donate_reason" aria-expanded="false" aria-controls="donate_reason">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/reason_icon.svg" alt="reason_icon"></div>
                                    اسباب التبرع
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="donate_reason" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_reason",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_reasons_requests_type.php?to=reason";?>">اضافة سبب للتبرع</a>
                                        <?php } ?>
                                        <?php if(in_array("all_reason",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_reasons_request_type.php?to=reason";?>">حذف / تعديل سبب للتبرع</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start request_type section ============== -->
                            <?php if(in_array("all_req_type",$roles) || in_array("add_req_type",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#donate_request_types" aria-expanded="false" aria-controls="donate_request_types">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/blood_request_type.svg" alt="blood_request_type"></div>
                                    انواع طلبات التبرع
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="donate_request_types" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_req_type",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_reasons_requests_type.php";?>">اضافة نوع طلب للتبرع</a>
                                        <?php } ?>
                                        <?php if(in_array("all_req_type",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_reasons_request_type.php";?>">حذف / تعديل نوع طلب للتبرع</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <div class="sb-sidenav-menu-heading">ادارة الاقسام وعرض البيانات</div>

                            <!-- ============= start all_patients section ============== -->
                            <?php if(in_array("all_patients",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_patients.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/patient_icon.svg" alt="patient_icon"></div>
                                    جميع المتبرعين والمرضي
                                </a>
                            <?php } ?>

                            <!-- ============= start all_stories section ============== -->
                            <?php if(in_array("all_stories",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_stories.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/stories.svg" alt="stories"></div>
                                    القصص
                                </a>
                            <?php } ?>

                            <!-- ============= start going_donners section ============== -->
                            <?php if(in_array("going_donners",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_going_donners.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/going_donner.svg" alt="going_donner"></div>
                                    ملبين طلبات التبرع
                                </a>
                            <?php } ?>

                            <!-- ============= start all_avilable_vaccine section ============== -->
                            <?php if(in_array("all_avilable_vaccine",$roles)){?>
                                <a class="nav-link" href="<?php echo "available_vaccines.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/avilable_vaccine.svg" alt="avilable_vaccine"></div>
                                    اللقاحات المتوفره
                                </a>
                            <?php } ?>

                            <!-- ============= start all_avilable_blood section ============== -->
                            <?php if(in_array("all_avilable_blood",$roles)){?>
                                <a class="nav-link" href="available_vaccines.php?to=add_availble_blood">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/avilable_blood.svg" alt="avilable_blood"></div>
                                    فصائل الدم المتوفره
                                </a>
                            <?php } ?>

                            <!-- ============= start search_for_patient section ============== -->
                            <?php if(in_array("search_for_patient",$roles)){?>
                                <a class="nav-link" href="search_for_patient.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/search_user.svg" alt="search_user"></div>
                                    البحث عن مريض
                                </a>
                            <?php } ?>

                            <!-- ============= start request_type section ============== -->
                            <?php if(in_array("payments",$roles)){?>
                                <a class="nav-link" href="payments.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/payments_icon.svg" alt="payments_icon"></div>
                                    عمليات الدفع
                                </a>
                            <?php } ?>

                            <!-- ============= start quick_requists section ============== -->
                            <?php if(in_array("qrcode_reader",$roles)){?>
                                <a class="nav-link" href="qrcode_reader.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/qr code.svg" alt="quick_requests_icon"></div>
                                    تسليم طلبات الشراء
                                </a>
                            <?php } ?>
                            <!-- ============= start quick_requists section ============== -->
                            <?php if(in_array("quick_requists",$roles)){?>
                                <a class="nav-link" href="payments.php?to=quick_request">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/quick_requests_icon.svg" alt="quick_requests_icon"></div>
                                    الطلبات العاجله
                                </a>
                            <?php } ?>
                            
                            <!-- ============= start donate_request section ============== -->
                            <?php if(in_array("donate_request",$roles)){?>
                                <a class="nav-link" href="blood_donation.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/donate_Requests.svg" alt="donate_Requests"></div>
                                    طلبات التبرع 
                                </a>
                            <?php } ?>

                            <!-- ============= start vaccine_request section ============== -->
                            <?php if(in_array("vaccine_request",$roles)){?>
                                <a class="nav-link" href="all_vaccines_requests.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/vaccine_req_icon.svg" alt="vaccine_req_icon"></div>
                                    طلبات اللقاحات 
                                </a>
                            <?php } ?>

                            <!-- ============= start buying_request section ============== -->
                            <?php if(in_array("buying_request",$roles)){?>
                                <a class="nav-link" href="all_purchase_orders.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/buy_blood_icon.svg" alt="buy_blood_icon"></div>
                                    طلبات شراء الدم   
                                </a>
                            <?php } ?>

                            <!-- ============= start contact_request section ============== -->
                            <?php if(in_array("contact_request",$roles)){?>
                                <a class="nav-link" href="all_incomming_emails.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/messages.svg" alt="admins"></div>
                                    طلبات المراسلة  
                                </a>
                            <?php } ?>
                        
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">لقد سجلت الدخول ك :  

                        <?php 
                            if(@$_SESSION['role'] == 0){
                                echo "<td>". "Height Board" ."</td>";
                            }elseif($_SESSION['role'] == 1){
                                echo "<td>". "Head" ."</td>";
                            }elseif($_SESSION['role'] == 2){
                                echo "<td>". "Vice" ."</td>";
                            }
                        ?>

                        </div>
                        بنك الدم
                    </div>
                </nav>
            </div>

