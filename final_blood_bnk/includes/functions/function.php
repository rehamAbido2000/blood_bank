<?php

function addmsg($msgfrom,$name,$msg,$subject,$time){
    global $con;
    $stmt=$con->prepare("INSERT INTO contact_us(msgfrom,name,msg,subject,time) Value(:msgfrom,:name,:msg,:subject,:time)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . h:i:s");
    $stmt->execute(array(
        ":msgfrom"=>$msgfrom,
        ":name"=>$name,
        ":msg"=>$msg,
        ":subject"=>$subject,
        ":time"=>$time
        ));
        echo "
        <script>
        toastr.success('Great , Your Message has been successfully Deliverd .')
        </script>";
}

/*
==========================
  check if patient exist
==========================
*/

function check_patient ( $p_ssn , $pass){
    global $con;
    $stmt = $con->prepare("SELECT * FROM patients_donors WHERE p_ssn = ?");
    $stmt->execute(array($p_ssn));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( password_verify($pass,$rows['password'])){
            @session_start();
            $_SESSION['p_ssn']    = $rows['p_ssn'];
            $_SESSION['p_first_name']  = $rows['p_first_name'];
            $_SESSION['p_last_name']  = $rows['p_last_name'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['mobile_phone'] = $rows['mobile_phone'];
            $_SESSION['home_phone'] = $rows['home_phone'];
            $_SESSION['password'] = $rows['password'];
            $_SESSION['blood_type']  = $rows['blood_type'];
            $_SESSION['birthday']  = $rows['birthday'];
            $_SESSION['gender_id'] = $rows['gender_id'];
            $_SESSION['img'] = $rows['img'];
            $_SESSION['city_id'] = $rows['city_id'];
            $_SESSION['time'] = $rows['time'];
            echo "
            <script>
                toastr.success('Welcome " . $_SESSION['p_first_name'] . " ". $_SESSION['p_last_name'] ."')
            </script>";

            header("Refresh:0;url=dash-profile.php");

        }elseif($pass == 1){
            @session_start();
            $_SESSION['p_ssn']    = $rows['p_ssn'];
            $_SESSION['p_first_name']  = $rows['p_first_name'];
            $_SESSION['p_last_name']  = $rows['p_last_name'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['mobile_phone'] = $rows['mobile_phone'];
            $_SESSION['home_phone'] = $rows['home_phone'];
            $_SESSION['password'] = $rows['password'];
            $_SESSION['blood_type']  = $rows['blood_type'];
            $_SESSION['birthday']  = $rows['birthday'];
            $_SESSION['gender_id'] = $rows['gender_id'];
            $_SESSION['img'] = $rows['img'];
            $_SESSION['city_id'] = $rows['city_id'];
            $_SESSION['time'] = $rows['time'];
            echo "
            <script>
                toastr.success('Welcome " . $_SESSION['p_first_name'] . " ". $_SESSION['p_last_name'] ."')
            </script>";

            header("Refresh:0;url=dash-profile.php");
        }else{
            echo "
            <script>
                toastr.error('عفوا الرقم السري غير صحيح.')
              </script>";
        }
    }else{
            echo "
            <script>
                toastr.error('عفوا الرقم القومي غير صحيح.')
              </script>";
        }
}

function checkcode( $code,$email){
    $user = select_user_by_email("patients_donors",$email);
    global $con;
    $stmt=$con->prepare("SELECT * FROM forget_password WHERE p_ssn=?");
    $stmt->execute(array( $user['p_ssn']));
    $rows=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();
    if ($count) {
       if($code == $rows['code']){
        $stmt = $con->prepare("DELETE FROM forget_password WHERE p_ssn = :p_ssn");
        $stmt->bindParam(":p_ssn" , $user['p_ssn']);
        $stmt->execute();
        header("location:forget_password.php?to=confirm&ssn=".$user['p_ssn']."");
       }
    }
    else{
        header("Refresh:3;url=login.php");
    }

}

/*
==========================
  check if user exist
==========================
*/

function check_user ( $email ){
    global $con;
    $stmt = $con->prepare("SELECT * FROM patients_donors WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        $retries = select_user_by_id('forget_password',$rows['p_ssn']);
        if(isset($retries['retries'] )){
            if($retries['retries'] > 0){
                $retries_count=$retries['retries']-1;
                $stmt= $con->prepare ("UPDATE forget_password SET `retries`=? WHERE `p_ssn`=?");
                $stmt ->execute(array($retries_count,  $rows['p_ssn']));
                $header="from:".$email;
                $time= date("Y/m/d . h:i:s");
                $code = $retries['code'];
                $msg = "كود التفعيل : " .$code ;
                mail($email,"Forget Passworsd","<h2>We Send a authentication code to you Based on Your Order To Change Password</h2><br>" . "\r\n" . "Authentication Code :-  <span style='font-weight:900'> " . $code . "</span>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                // add_forget($rows['p_ssn'],$email,$code,3,$time);
                echo "
                <script>
                toastr.success('تم ارسال كود التفعيل لبريدك الالكتروني.')
                </script>";
                header("location:forget_password.php?to=code&email=".$rows['email']."");
                
            }else{
                global $con;
                $stmt = $con->prepare("DELETE FROM forget_password WHERE p_ssn = :p_ssn");
                $stmt->bindParam(":p_ssn" , $rows['p_ssn']);
                $stmt->execute();
                echo "
                <script>
                    toastr.error('للاسف لقد نفذت جميع محاولاتك حاول فى وقت لاحق ')
                  </script>";
            }
        }else{
            $stmt= $con->prepare ("UPDATE forget_password SET `retries`=? WHERE `p_ssn`=?");
                    $stmt ->execute(array(
                        $retries,  $rows['p_ssn']));
                $header="from:".$email;
                $time= date("Y/m/d . h:i:s");
                $code =rand(100000,999999);
                $msg = "كود التفعيل : " .$code ;
                mail($email,"Forget Passworsd","<h2>We Send a authentication code to you Based on Your Order To Change Password</h2><br>" . "\r\n" . "Authentication Code :-  <span style='font-weight:900'> " . $code . "</span>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                add_forget($rows['p_ssn'],$email,$code,3,$time);
                    echo "
                    <script>
                        toastr.success('تم ارسال كود التفعيل لبريدك الالكتروني.')
                      </script>";
                      header("location:forget_password.php?to=code&email=".$rows['email']."");
        }
        
}else{
            echo "
            <script>
                toastr.error('للاسف بريدك الالكتروني غير صحيح')
              </script>";
        }
}
// add forget password code 
function add_forget($p_ssn,$email,$code,$retries,$time){
    global $con;
    $stmt=$con->prepare("INSERT INTO forget_password(p_ssn,code,retries,time) Value(:p_ssn,:code,:retries,:time)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . h:i:s");
    $stmt->execute(array(
        ":p_ssn"=>$p_ssn,
        ":code"=>$code,
        ":retries"=>$retries,
        ":time"=>$time
        ));
}
/*
==========================
  insert new patient
==========================
*/

function insert_patient($p_ssn,$f_name,$l_name,$email,$tel1,$tel2,$password,$blood_type,$birthday,$gender_id,$img,$city_id){
    // echo "function here!";
    global $con;
    $stmt = $con->prepare("INSERT INTO patients_donors(p_ssn,p_first_name,p_last_name,email,mobile_phone,home_phone,password,blood_type ,birthday,gender_id ,img,city_id) Value(:p_ssn,:p_first_name,:p_last_name,:email,:mobile_phone,:home_phone,:password,:blood_type ,:birthday,:gender_id ,:img,:city_id)");
    $stmt->execute(
    array(
        ":p_ssn"            => $p_ssn,
        ":p_first_name"     => $f_name,
        ":p_last_name"      => $l_name,
        ":email"            => $email,
        ":mobile_phone"     => $tel1,
        ":home_phone"       => $tel2,
        ":password"         => $password,
        ":blood_type"       => $blood_type,
        ":birthday"         => $birthday,
        ":gender_id"        => $gender_id,
        ":img"              => $img,
        ":city_id"          => $city_id,
    ));
    echo "
    <script>
        toastr.success('اهلا بك فى نظام معلومات شؤون المتبرعين بالدم:)')
    </script>";
    header("Refresh:3;url=login.php"); 
}
/*
==========================
    get all data
==========================
*/

function getAllData($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


/*
==========================
  get all data with id
==========================
*/

function getData_with_id($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================
  get all rols with id
==========================
*/

function get_rols_with_id($id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM role WHERE id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}


/*
==========================
  count
==========================
*/

function count_data($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}



/*IMPORTANT !!! SN = 636f6465206279203a20416d722d4d6f68616d65642d4569737361 */


/*
==========================  
  select_member_by_id
==========================
*/
function select_member_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
  /*
==========================  
  select_by_id
==========================
*/
function select_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
    /*
==========================  
  get id of vaccine
==========================
*/
function get_vaccine_id($tname){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM vaccines where `trade_name`=?") ;
    $stmt1       ->execute(array($tname));
    $row   =$stmt1 ->fetch();
    return $row;
  }

  /*
==========================  
  select_user_by_ssn
==========================
*/
function select_user_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `p_ssn`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
    /*
==========================  
  select_user_by_email
==========================
*/
function select_user_by_email($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `email`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
 /*
==========================  
  select_goinng donners
==========================
*/
function select_donners($table ,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE request_id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
  }
/*
   ==========================  
        delete_by_id
   ==========================
*/
function delete_by_id($table ,$id_user){
    global $con;
     $stmt1 = $con -> prepare("DELETE FROM $table WHERE `id`=:id");
     $stmt1->bindParam(":id",$id_user);
     $stmt1->execute();
   }
/*=====================end_members_function=============================*/


  /*
==========================  
count Rows from Database By/ Amr Mohamed
==========================
*/

function count_users($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
===================
all vaccines by id
===================
*/

function all_vaccines_by_id($vac_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM vaccines WHERE id = ?");
    $stmt->execute(array($vac_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all cities and governorates
===================
*/

function all_city_gov(){
    global $con;
    $stmt = $con->prepare("SELECT cities.* , governorate.name AS gov_name
    FROM cities 
    INNER JOIN governorate
    ON cities.gov_id = governorate.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all cities by id
===================
*/

function all_city_by_gov($gov_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM cities WHERE gov_id = ?");
    $stmt->execute(array($gov_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all places by city_id
===================
*/

function all_places_by_city($city_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM donate_places WHERE city_id = ?");
    $stmt->execute(array($city_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
    count places in gover
===================
*/

function count_places($gov){
    global $con;
    $stmt = $con->prepare("SELECT id FROM cities WHERE gov_id = ? ");
    $stmt->execute(array($gov));
    $rows = $stmt->fetchAll();
    return $rows;
}

function count_places2($cities){
    global $con;
    $stmt2 = $con->prepare("SELECT * FROM donate_places WHERE city_id = ? ");
    $stmt2->execute(array($cities));
    $rows2 = $stmt2->fetchAll();
    return $rows2;
}



/*
==========================
  get yhe age by birthday             < Reham >
==========================
*/

function getAge($birthday){
    $age_arr=explode('-',$birthday);
    $today = getdate();
    $age = (int)$today['year'] - (int)$age_arr[0];
    return $age; 
}

/*
==========================
  update patient diseases              < Reham >
==========================
*/

function update_patient_diseases($p_ssn,$diseases,$admin_ssn){
    $old_data = getData_with_p_ssn('patient_diseases',$p_ssn);
    for($i=0;$i<sizeof($diseases);$i++){
        if(check_patient_diseases($diseases[$i],$p_ssn)){
            continue;
        }else{
            // insert_patient_diseases($p_ssn,$diseases[$i],$admin_ssn);
            global $con;
            $stmt = $con->prepare("INSERT INTO patient_diseases(p_ssn,disiease_id,admin_ssn)
            Value(:p_ssn,:disiease_id,:admin_ssn)");
            $stmt->execute(
            array(
                ":p_ssn"                     => $p_ssn,
                ":disiease_id"               => $diseases[$i],
                ":admin_ssn"                 => $admin_ssn,
            ));
        }
    }
    foreach($old_data as $old){
        if(in_array($old['disiease_id'],$diseases)){
            continue;
        }else{
            global $con;
            $stmt = $con->prepare("DELETE FROM patient_diseases WHERE disiease_id = :disiease_id AND p_ssn = :p_ssn");
            $stmt->bindParam(":disiease_id" , $old['disiease_id']);
            $stmt->bindParam(":p_ssn" , $p_ssn);
            $stmt->execute();
        }
    }
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات المريض بنجاح')
    </script>";
    header("Refresh:2;url=search_for_patient.php");
}
/*
==========================
  check patient diseases is exist             < Reham >
==========================
*/

function check_patient_diseases($id,$p_ssn){
    global $con;
    $stmt = $con->prepare("SELECT * FROM patient_diseases WHERE disiease_id = ? AND p_ssn = $p_ssn");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    return $count;
}
/*
==========================
  insert new patient diseases          < Reham >
==========================
*/

function insert_patient_diseases($p_ssn,$disiease_id,$admin_ssn){
        global $con;
        $stmt = $con->prepare("INSERT INTO patient_diseases(p_ssn,disiease_id,admin_ssn)
        Value(:p_ssn,:disiease_id,:admin_ssn)");
        $stmt->execute(
        array(
            ":p_ssn"                     => $p_ssn,
            ":disiease_id"               => $disiease_id,
            ":admin_ssn"                 => $admin_ssn,
        ));
       
}

/*
==========================
  get all patient diseases data with p_ssn
==========================
*/

function getData_with_p_ssn($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE p_ssn = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
==========================
  get all donate_places_information
==========================
*/

function get_all_donate_places_info(){
    global $con;
    $stmt = $con->prepare("SELECT donate_places.* , cities.name AS city_name , governorate.name AS governorate_name 
    FROM donate_places 
    INNER JOIN cities
    ON donate_places.city_id = cities.id
    INNER JOIN governorate
    ON cities.gov_id = governorate.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
==========================
  get all donate_places_information With place ID
==========================
*/

function get_all_donate_places_info_with_place_id($place_id){
    global $con;
    $stmt = $con->prepare("SELECT donate_places.* , cities.name AS city_name , governorate.name AS governorate_name 
    FROM donate_places 
    INNER JOIN cities
    ON donate_places.city_id = cities.id
    INNER JOIN governorate
    ON cities.gov_id = governorate.id
    where donate_places.id = $place_id
    ");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================  
count Rows from Database By/ Amr Mohamed
==========================
*/

function count_patient($colume,$databname,$p_ssn){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname Where p_ssn = ? ");
    $stmt->execute(array($p_ssn));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      update_donate_places 
 ==========================
*/
function update_donate_place($place_name,$manager,$city_id,$start_at,$close_at,$holiday,$lat,$long,$donate_place_id){
    global $con;
   $stmt= $con->prepare ("UPDATE donate_places SET `place_name`=? , `place_manager`=? , `city_id`=? , `lat`=? , `lng`=? , `open_at`=? , `close_at`=? , `holiday`=? WHERE `id`=?");
   $stmt ->execute(array(
       $place_name ,$manager,$city_id,$lat,$long,$start_at,$close_at,$holiday,$donate_place_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل مركز بنك الدم بنجاح')
       </script>";
       header("Refresh:2;url=all_donate_places.php"); 
  }
  /*
 ==========================  
      update patient data
 ==========================
*/
function update_patient($p_ssn,$f_name,$l_name,$email,$phone1,$phone2,$password,$blood_type,$birthday,$gender,$img,$city_id,$old_ssn){
    global $con;
    if($p_ssn != $old_ssn){
        $p_diseases = select_user_by_id('patient_diseases',$old_ssn);
        if(is_array($p_diseases)){
            foreach($p_diseases as $data){
                $stmt = $con->prepare("UPDATE patient_diseases SET `p_ssn`=? WHERE p_ssn = ?");
                $stmt->execute(array($p_ssn,$old_ssn));
            }
        }
    }
$stmt= $con->prepare ("UPDATE patients_donors SET `p_ssn`=? , `p_first_name`=? , `p_last_name`=?,`email`=? , `mobile_phone`=? , `home_phone`=? , `password`=? , `blood_type`=? , `birthday`=? , `gender_id`=? , `img`=? , `city_id`=? WHERE `p_ssn`=?");
   $stmt ->execute(array(
    $p_ssn,$f_name,$l_name,$email,$phone1,$phone2,$password,$blood_type,$birthday,$gender,$img,$city_id,$old_ssn));
    check_patient ( $p_ssn , 1);
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل بياناتك بنجاح')
       </script>";
    //    header("Refresh:2;url=all_api_users.php"); 
  }



/*
 ==========================  
    *** buy blood ***
 ==========================
*/

// *************** 1- get hospital with city id *****************
function get_hospitals_by_city($city_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM donate_places WHERE city_id = ?");
    $stmt->execute(array($city_id));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

// *************** 2- get hospital with gov id *****************
function get_all_cities_in_gov_with_city_id($city_id){
    global $con;
    $gov_id = getData_with_id("cities",$city_id);
    $stmt = $con->prepare("SELECT * FROM cities WHERE gov_id = ?");
    $stmt->execute(array($gov_id["gov_id"]));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

// *************** 3- insert order in purchast table *****************

function insert_purchase_order($p_ssn,$blood_id,$place_id,$amount){
    global $con;
    $stmt = $con->prepare("INSERT INTO purchase_order(p_id,blood_type,delivered_place,amount) Value(:p_id,:blood_type,:delivered_place,:amount)");
    $stmt->execute(
    array(
        ":p_id"     => $p_ssn,
        ":blood_type"     => $blood_id,
        ":delivered_place"     => $place_id,
        ":amount"     => $amount,
    ));
}

// *************** 4- update the amount after order *****************

function update_amount_of_avilable_blood($id,$amount){
    global $con;
    $stmt= $con->prepare ("UPDATE avilable_blood SET `amount`=? WHERE `id`=?");
    $stmt ->execute(array(
        $amount,$id));
    }

// *************** 5- get get amount of blood on choosen place in different gov *****************
function get_amount_by_place_and_blood($place_id,$blood_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE place_id = ? AND blood_type_id = ?");
    $stmt->execute(array($place_id,$blood_id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

function buy_blood($p_ssn,$city_id,$blood_id,$amount){
    global $con;
    // if blood type and number of bags exist in a hosital at the same city of user
    $hospitals_in_city = get_hospitals_by_city($city_id);
    // if blood_type not found in the city of the user
    $all_cities_in_gov = get_all_cities_in_gov_with_city_id($city_id);

        $i=0;


if(count($hospitals_in_city) == 0){
    foreach($all_cities_in_gov as $gov_cities_data){
        $hospitals_same_in_city = get_hospitals_by_city($gov_cities_data["id"]);
        foreach($hospitals_same_in_city as $def_cities){
            $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE blood_type_id = ? AND place_id=? AND amount > ?");
            @$stmt->execute(array($blood_id,$def_cities["id"],$amount));
            $count=$stmt->rowCount();
            if($count){
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $new_amount = $rows["amount"] - $amount;
                update_amount_of_avilable_blood($rows["id"],$new_amount);
                insert_purchase_order($p_ssn,$blood_id,$rows["place_id"],$amount);
                $i = 1;
                $hospital_name = select_by_id("donate_places",$rows["place_id"]);
                $order_id = get_purchast_order_id($p_ssn);
                mail($_SESSION['email'],"Request to purchase blood bags","<h2>Blood bags were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                echo "
                <script>
                toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
                </script>";
                header("Refresh:10;url=dash-buy-blood.php");     
                return "in_gov";
            }
        }
    }
    if($i != 1){
        $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE blood_type_id = ? AND amount > ?");
        @$stmt->execute(array($blood_id,$amount));
        $count=$stmt->rowCount();
        if($count){
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }
}else{

    //search in the same city
    foreach($hospitals_in_city as $same_city_data){
        $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE blood_type_id = ? AND place_id=? AND amount > ?");
        @$stmt->execute(array($blood_id,$same_city_data["id"],$amount));
        $count=$stmt->rowCount();
        if($count){
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $new_amount = $rows["amount"] - $amount;
            update_amount_of_avilable_blood($rows["id"],$new_amount);
            insert_purchase_order($p_ssn,$blood_id,$rows["place_id"],$amount);
            $i = 1;
            $hospital_name = select_by_id("donate_places",$rows["place_id"]);
            $order_id = get_purchast_order_id($p_ssn);
            mail($_SESSION['email'],"Request to purchase blood bags","<h2>Blood bags were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
            echo "
            <script>
            toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
            </script>";
            header("Refresh:10;url=dash-buy-blood.php");     
            return true;
        }else{
            foreach($all_cities_in_gov as $gov_cities_data){
                $hospitals_same_in_city = get_hospitals_by_city($gov_cities_data["id"]);
                foreach($hospitals_same_in_city as $def_cities){
                    $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE blood_type_id = ? AND place_id=? AND amount > ?");
                    @$stmt->execute(array($blood_id,$def_cities["id"],$amount));
                    $count=$stmt->rowCount();
                    if($count){
                        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                        $new_amount = $rows["amount"] - $amount;
                        update_amount_of_avilable_blood($rows["id"],$new_amount);
                        insert_purchase_order($p_ssn,$blood_id,$rows["place_id"],$amount);
                        $i = 1;
                        $hospital_name = select_by_id("donate_places",$rows["place_id"]);
                        echo "
                        <script>
                        toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
                        </script>";
                        $order_id = get_purchast_order_id($p_ssn);
                        mail($_SESSION['email'],"Request to purchase blood bags","<h2>Blood bags were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                        header("Refresh:10;url=dash-buy-blood.php");     
                        return true;
                    }
                }
            }
            if($i != 1){
                $stmt = $con->prepare("SELECT * FROM avilable_blood WHERE blood_type_id = ? AND amount > ?");
                @$stmt->execute(array($blood_id,$amount));
                $count=$stmt->rowCount();
                if($count){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $rows;
                }
            }
        }
    }
    }
}




/*
 ==========================  
    *** buy Vaccine ***
 ==========================
*/
// *************** 1- insert order in purchast table *****************

function insert_order_vaccine($p_ssn,$vaccine_id,$place_id,$amount){
    global $con;
    $stmt = $con->prepare("INSERT INTO order_vaccine(p_ssn,vaccine_id,delivered_place,amount) Value(:p_id,:vaccine_id,:delivered_place,:amount)");
    $stmt->execute(
    array(
        ":p_id"     => $p_ssn,
        ":vaccine_id"     => $vaccine_id,
        ":delivered_place"     => $place_id,
        ":amount"     => $amount,
    ));
}

// *************** 2- update the amount after order *****************

function update_amount_of_avilable_vaccines($id,$amount){
    global $con;
    $stmt= $con->prepare ("UPDATE avilable_vaccines SET `amount`=? WHERE `id`=?");
    $stmt ->execute(array(
        $amount,$id));
    }

// *************** 3- get get amount of blood on choosen place in different gov *****************
function get_amount_by_place_and_vaccine($place_id,$vaccine_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_place_id = ? AND vaccine_id = ?");
    $stmt->execute(array($place_id,$vaccine_id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

function buy_vaccine($p_ssn,$city_id,$vaccine_id,$amount){
    global $con;
    // if blood type and number of bags exist in a hosital at the same city of user
    $hospitals_in_city = get_hospitals_by_city($city_id);
    // if blood_type not found in the city of the user
    $all_cities_in_gov = get_all_cities_in_gov_with_city_id($city_id);

        $i=0;


if(count($hospitals_in_city) == 0){
    foreach($all_cities_in_gov as $gov_cities_data){
        $hospitals_same_in_city = get_hospitals_by_city($gov_cities_data["id"]);
        foreach($hospitals_same_in_city as $def_cities){
            $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_id = ? AND vaccine_place_id =? AND amount > ?");
            @$stmt->execute(array($vaccine_id,$def_cities["id"],$amount));
            $count=$stmt->rowCount();
            if($count){
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $new_amount = $rows["amount"] - $amount;
                update_amount_of_avilable_vaccines($rows["id"],$new_amount);
                insert_order_vaccine($p_ssn,$vaccine_id,$rows["vaccine_place_id"],$amount);
                $i = 1;
                $hospital_name = select_by_id("donate_places",$rows["vaccine_place_id"]);
                $order_id = get_vaccine_order_id($p_ssn);
                        mail($_SESSION['email'],"Request to purchase Vaccine","<h2>Vaccine were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                echo "
                <script>
                toastr.success('تم حجز اللقاح بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اللقاح الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
                </script>";
                $loc = $_SERVER['HTTP_REFERER'];
                header("Refresh:10;url=$loc");
                return "in_gov";
            }
        }
    }
    if($i != 1){
        $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_id = ? AND amount > ?");
        @$stmt->execute(array($vaccine_id,$amount));
        $count=$stmt->rowCount();
        if($count){
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }
}else{

    //search in the same city
    foreach($hospitals_in_city as $same_city_data){
        $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_id = ? AND vaccine_place_id =? AND amount > ?");
        @$stmt->execute(array($vaccine_id,$same_city_data["id"],$amount));
        $count=$stmt->rowCount();
        if($count){
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $new_amount = $rows["amount"] - $amount;
            update_amount_of_avilable_vaccines($rows["id"],$new_amount);
            insert_order_vaccine($p_ssn,$vaccine_id,$rows["vaccine_place_id"],$amount);
            $i = 1;
            $hospital_name = select_by_id("donate_places",$rows["vaccine_place_id"]);
            echo "
            <script>
            toastr.success('تم حجز اللقاح بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اللقاح الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
            </script>";
            $order_id = get_vaccine_order_id($p_ssn);
                        mail($_SESSION['email'],"Request to purchase Vaccine","<h2>Vaccine were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
            $loc = $_SERVER['HTTP_REFERER'];
            header("Refresh:10;url=$loc");   
            return true;
        }else{
            foreach($all_cities_in_gov as $gov_cities_data){
                $hospitals_same_in_city = get_hospitals_by_city($gov_cities_data["id"]);
                foreach($hospitals_same_in_city as $def_cities){
                    $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_id = ? AND vaccine_place_id =? AND amount > ?");
                    @$stmt->execute(array($vaccine_id,$def_cities["id"],$amount));
                    $count=$stmt->rowCount();
                    if($count){
                        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                        $new_amount = $rows["amount"] - $amount;
                        update_amount_of_avilable_vaccines($rows["id"],$new_amount);
                        insert_order_vaccine($p_ssn,$vaccine_id,$rows["vaccine_place_id"],$amount);
                        $i = 1;
                        $hospital_name = select_by_id("donate_places",$rows["vaccine_place_id"]);
                        $order_id = get_vaccine_order_id($p_ssn);
                        mail($_SESSION['email'],"Request to purchase Vaccine","<h2>Vaccine were booked at " . $hospital_name["place_name"] . " Hospital , Please come to the place as soon as possible to receive the order </h2><br>" . "\r\n" . "Show the QR Code sent below to the official in the place to verify your identity and receive the order :- " . "\r\n" . "<img style='width:90%;display:block;margin:auto' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=blood | " . $order_id["id"] ." &choe=UTF-8' alt='Qr Code'>","From: amr-eissa@blood-bank.life\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                        echo "
                        <script>
                        toastr.success('تم حجز اللقاح بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اللقاح الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
                        </script>";
                        
                        $loc = $_SERVER['HTTP_REFERER'];
                        header("Refresh:10;url=$loc");  
                        return true;
                    }
                }
            }
            if($i != 1){
                $stmt = $con->prepare("SELECT * FROM avilable_vaccines WHERE vaccine_id = ? AND amount > ?");
                @$stmt->execute(array($vaccine_id,$amount));
                $count=$stmt->rowCount();
                if($count){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $rows;
                }
            }
        }
    }
    }
}

/*
==========================
  get purchast order id with pssn
==========================
*/

function get_purchast_order_id($p_ssn){
    global $con;
    $stmt = $con->prepare("SELECT * FROM purchase_order WHERE p_id = ? ORDER BY id DESC");
    $stmt->execute(array($p_ssn));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================
  get purchast order id with pssn
==========================
*/

function get_vaccine_order_id($p_ssn){
    global $con;
    $stmt = $con->prepare("SELECT * FROM order_vaccine WHERE p_id = ? ORDER BY order_id DESC");
    $stmt->execute(array($p_ssn));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}