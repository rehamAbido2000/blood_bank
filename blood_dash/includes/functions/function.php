<?php
/*
==========================
  insert new gov             < Reham >
==========================
*/

function insert_gov($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO governorate(name) Value(:gov_name)");
    $stmt->execute(
    array(
        ":gov_name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة المحافظه بنجاح')
    </script>";
    header("Refresh:3;url=all_gov_city.php?to=gov"); 
}
/*
==========================
  insert new city            < Reham >
==========================
*/

function insert_city($name,$gov_id){
    echo "fun";
    global $con;
    $stmt = $con->prepare("INSERT INTO cities(gov_id,name) Value(:gov_id,:city_name)");
    $stmt->execute(
    array(
        ":gov_id"       => $gov_id,
        ":city_name"    => $name,

    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة المدينه بنجاح')
    </script>";
    header("Refresh:3;url=all_gov_city.php?to=city"); 
}
/*
==========================
  insert new country            < Reham >
==========================
*/

function insert_country($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO country(name) Value(:country_name)");
    $stmt->execute(
    array(
        ":country_name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة البلد بنجاح')
    </script>";
    header("Refresh:3;url=all_gov_city.php?to=Country");  
}
/*
==========================
  insert new diseases            < Reham >
==========================
*/

function insert_diseases($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO diseases(diseases) Value(:diseases_name)");
    $stmt->execute(
    array(
        ":diseases_name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة المرض بنجاح')
    </script>";
    header("Refresh:3;url=all_diseases.php");  
}
/*
==========================
  insert new avilable blood            < Reham >
==========================
*/

function insert_avilable_blood($blood_type,$place_id,$amount,$price,$admin_ssn){
    echo "fun";
    global $con;
    $stmt = $con->prepare("INSERT INTO avilable_blood(blood_type_id ,place_id ,amount,price,admin_ssn ) Value(:blood_type_id,:place_id,:amount,:price,:admin_ssn )");
    $stmt->execute(
    array(
        ":blood_type_id"       => $blood_type,
        ":place_id"            => $place_id,
        ":amount"              => $amount,
        ":price"               => $price,
        ":admin_ssn"           => $admin_ssn,

    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة فصيله دم متوفره بنجاح')
    </script>";
    header("Refresh:3;url=available_vaccines.php?to=add_availble_blood"); 
}
/*
 ==========================  
      update_gov           < Reham >
 ==========================
*/
function update_gov($name,$id){
  global $con;
 $stmt= $con->prepare ("UPDATE governorate SET `name`=?WHERE `id`=?");
 $stmt ->execute(array(
     $name,  $id));
     echo "
     <script>
     toastr.success('تم بنجاح :- تم تعديل المحافظه بنجاح')
     </script>";
     header("Refresh:2;url=all_gov_city.php?to=gov"); 
}
/*
 ==========================  
      update_country           < Reham >
 ==========================
*/
function update_country($name,$id){
global $con;
$stmt= $con->prepare ("UPDATE country SET `name`=?WHERE `id`=?");
$stmt ->execute(array(
    $name,  $id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل البلد بنجاح')
    </script>";
    header("Refresh:2;url=all_gov_city.php?to=country"); 
}
/*
==========================  
    update_vaccine_name           < Reham >
==========================
*/
function update_vaccine_name($sname,$tname,$id){
global $con;
$stmt= $con->prepare ("UPDATE vaccines SET `trade_name`=?,`scientific_name`=?WHERE `id`=?");
$stmt ->execute(array(
    $sname,$tname,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل اسم اللقاح بنجاح')
    </script>";
    header("Refresh:2;url=all_blood_vaccine.php?to=vaccine_name"); 
}

/*
==========================  
    update_avilable_vaccine           < Reham >
==========================
*/
function update_avilable_vaccine($id,$vac_name_id,$country,$place,$amount,$price,$admin_ssn){
echo $vac_name_id ." \ ". $country." / ".$place ." \ ". $amount." / ".$price ." \ ". $admin_ssn;    
global $con;
$stmt= $con->prepare ("UPDATE avilable_vaccines SET `vaccine_id`=?,`country_id`=?,`vaccine_place_id`=?,`amount`=?,`price`=?,`admin_ssn`=?,WHERE `id`=?");
$stmt ->execute(array(
    $vac_name_id,$country,$place,$amount,$price,$admin_ssn,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل اللقاح بنجاح')
    </script>";
    header("Refresh:2;url=all_blood_vaccine.php");
}
/*
==========================  
    update_avilable_blood          < Reham >
==========================
*/
function update_avilable_blood($id,$blood_id,$place,$amount,$price,$admin_ssn){
echo $blood_id ." \ ".$place ." \ ". $amount." / ".$price ." \ ". $admin_ssn;    
global $con;
$stmt= $con->prepare ("UPDATE avilable_blood SET `blood_type_id`=?,`place_id`=?,`amount`=?,`price`=?,`admin_ssn`=?,WHERE `id`=?");
$stmt ->execute(array(
    $blood_id,$place,$amount,$price,$admin_ssn,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل فصيله الدم المتوفره بنجاح')
    </script>";
    header("Refresh:2;url=available_vaccines.php?to=add_availble_blood");
}

/*
 ==========================  
      update_city           < Reham >
 ==========================
*/
function update_city($name,$gov_id,$id){
  global $con;
 $stmt= $con->prepare ("UPDATE cities SET `name`=?,`gov_id`=?WHERE `id`=?");
 $stmt ->execute(array(
     $name,$gov_id,  $id));
     echo "
     <script>
     toastr.success('تم بنجاح :- تم تعديل المدينه بنجاح')
     </script>";
     header("Refresh:2;url=all_gov_city.php?to=city"); 
}
/*
 ==========================  
      update_blood         < Reham >
 ==========================
*/
function update_blood($id,$name){
    global $con;
   $stmt= $con->prepare ("UPDATE blood_type SET `name`=?WHERE `id`=?");
   $stmt ->execute(array(
       $name, $id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل الفصيله بنجاح')
       </script>";
       header("Refresh:2;url=all_blood_vaccine.php?to=add_blood"); 
  }
/*
 ==========================  
      update_role           < Reham >
 ==========================
*/
function update_role($role_id,$name,$roles_ex){
    global $con;
   $stmt= $con->prepare ("UPDATE role SET `role_name`=? ,`authentications`=? WHERE `id`=?");
   $stmt ->execute(array(
       $name, $roles_ex , $role_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل الصلاحيه بنجاح')
       </script>";
       header("Refresh:2;url=all_role_admin.php?to=role"); 
  }
 
    /*
 ==========================  
      update_admin           < Reham >
 ==========================
*/
function update_admin($f_name,$l_name,$email,$hashed_password,$role,$admin_ssn,$place_id,$old_ssn){
    global $con;
   $stmt= $con->prepare ("UPDATE admins SET `admin_first_name`=? ,`admin_last_name`=?,`email`=? ,`password`=?,`role_id`=? ,`work_place`=?,`admin_ssn`=? WHERE `admin_ssn`=?");
   $stmt ->execute(array(
    $f_name, $l_name , $email,$hashed_password, $role , $place_id,$admin_ssn,$old_ssn));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل بيانات المسؤول بنجاح')
       </script>";
       header("Refresh:2;url=all_role_admin.php"); 
  }
/*
 ==========================  
      update_diseases          < Reham >
 ==========================
*/
function update_diseases($name,$id){
    global $con;
   $stmt= $con->prepare ("UPDATE diseases SET `diseases`=?WHERE `id`=?");
   $stmt ->execute(array(
       $name,  $id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل المرض بنجاح')
       </script>";
       header("Refresh:3;url=all_diseases.php"); 
  }

// //////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////

function checkUser( $email, $password){
    global $con;
    $stmt=$con->prepare("SELECT * FROM admins WHERE email=?");
    $stmt->execute(array( $email));
    $rows=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();
    if ($count) {
        if($rows['password']==$password){
            $_SESSION['id']=$rows['id'];
            $_SESSION['useranme']=$rows['name'];
            $_SESSION['email']=$rows['email'];
            $_SESSION['role']=$rows['role'];
            $_SESSION['comm']=$rows['committee'];
            $_SESSION['state']=$rows['state'];
            $stmt=$con->prepare ("UPDATE admins SET `state`= 1 WHERE `id`=?");
            $stmt->execute(array($rows['id']));
            echo "
            <script>
            toastr.success('Success , Welcome Back " . $rows['name'] . " .')
            </script>";
            header("Refresh:3;url=admin_dash.php"); 
        }
        else{
            echo "
            <script>
                toastr.error('Sorry Email or Password not excit.')
            </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('Sorry Email or Password not excit.')
            </script>";
    }

}



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
  insert new admin
==========================
*/

function insert_admin($f_name,$l_name,$email,$password,$role,$admin_ssn,$work_place){
    global $con;
    $stmt = $con->prepare("INSERT INTO admins(admin_ssn,admin_first_name,admin_last_name,email,password,role_id,work_place) Value(:admin_ssn,:admin_first_name,:admin_last_name,:email,:password,:role_id,:work_place)");
    $stmt->execute(
    array(
        ":admin_ssn"            => $admin_ssn,
        ":admin_first_name"     => $f_name,
        ":admin_last_name"      => $l_name,
        ":email"                => $email,
        ":password"             => $password,
        ":role_id"              => $role,
        ":work_place"              => $work_place,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Admin  added .')
    </script>";
    header("Refresh:3;url=all_role_admin.php"); 
}

/*
==========================
  insert new role
==========================
*/

function insert_role($name,$roles_ex){
    global $con;
    $stmt = $con->prepare("INSERT INTO role(role_name,authentications) Value(:role_name,:roles_ex)");
    $stmt->execute(
    array(
        ":role_name"     => $name,
        ":roles_ex"     => $roles_ex,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الصلاحيه بنجاح')
    </script>";
    header("Refresh:3;url=all_role_admin.php?to=role"); 
}

/*
==========================
  insert new blood type
==========================
*/

function insert_blood($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO blood_type(name) Value(:name)");
    $stmt->execute(
    array(
        ":name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة فصيلة الدم بنجاح')
    </script>";
    header("Refresh:3;url=all_blood_vaccine.php?to=add_blood"); 
}
/*
==========================
  insert new Vaccine Name   < Reham >
==========================
*/

function insert_vaccine_name($sname,$tname)               
{
    global $con;
    $stmt = $con->prepare("INSERT INTO vaccines(scientific_name,trade_name) 
    Value(:scientific_name,:trade_name)");
    $stmt->execute(
    array(
        ":scientific_name"         => $sname,
        ":trade_name"              => $tname
    ));
    
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة اسم لقاح بنجاح')
    </script>";
    header("Refresh:3;url=all_blood_vaccine.php?to=vaccine_name"); 
}
/*
==========================
  insert new Vaccine     < Reham >
==========================
*/

function insert_vaccine($vac_name_id,$country,$place,$amount,$price,$admin_ssn)               
{
    global $con;
    $stmt = $con->prepare("INSERT INTO avilable_vaccines(vaccine_id,country_id,vaccine_place_id,amount,price,admin_ssn) 
    Value(:vaccine_id,:country_id,:vaccine_place_id,:amount,:price,:admin_ssn)");
    $stmt->execute(
    array(
        ":vaccine_id"               => $vac_name_id,
        ":country_id"               => $country,
        ":vaccine_place_id"         => $place,
        ":amount"                   => $amount,
        ":price"                    => $price,
        ":admin_ssn"                => $admin_ssn,
    ));
    
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة مكان القاح بنجاح')
    </script>";
    header("Refresh:3;url=available_vaccines.php"); 
}
/*
==========================
  check if user exist
==========================
*/

function check_user ( $email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( $rows['password'] == $hased ){
            $_SESSION['userid']    = $rows['id'];
            $_SESSION['admin_first_name']  = $rows['username'];
            $_SESSION['useremail'] = $rows['email'];
            $_SESSION['reg_state'] = $rows['reg_state'];
            echo "
            <script>
                toastr.success('Welcome Back " . $_SESSION['username'] . " .')
            </script>";

            if($rows['reg_state'] == "0"){
                header("Refresh:3;url=user_home.php");
            }else{
                header("Refresh:3;url=seller_profile.php");
            }

        }
        else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
}
/*
==========================
  check if admin exist
==========================
*/
// asd;lasd;

function check_admin ( $admin_ssn , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins WHERE admin_ssn = ?");
    $stmt->execute(array($admin_ssn));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( password_verify($hased,$rows['password']) ){
            @session_start();
            $_SESSION['admin_ssn']    = $rows['admin_ssn'];
            $_SESSION['admin_first_name']  = $rows['admin_first_name'];
            $_SESSION['admin_last_name']  = $rows['admin_last_name'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['role'] = $rows['role_id'];
            $_SESSION['work_place'] = $rows['work_place'];
            $_SESSION['state'] = $rows['state'];
            echo "
            <script>
                toastr.success('Welcome Back " . $_SESSION['admin_first_name'] . " ". $_SESSION['admin_last_name'] ."')
            </script>";
            $state=1;
            $stmt= $con->prepare ("UPDATE admins SET `state`=? WHERE `admin_ssn`=?");
            $stmt ->execute(array(
                $state,  $rows['admin_ssn']));
                header("Refresh:3;url=admin_dash.php");
  

        }
        else{
            echo "
            <script>
                toastr.error('تأكد من ادخال البيانات بطريقه صحيحه , الرقم القومي او كلمة السر خطأ .')
              </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('تأكد من ادخال البيانات بطريقه صحيحه , الرقم القومي او كلمة السر خطأ .')
              </script>";
        }
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
  get all patient data 
==========================
*/
function patient_data(){
    global $con;
    $stmt = $con->prepare("SELECT patients_donors.p_ssn as p_ssn ,patients_donors.p_first_name as f_name ,patients_donors.p_last_name as l_name ,patients_donors.email as email ,patients_donors.birthday as age ,patients_donors.mobile_phone as tel1 ,patients_donors.home_phone as tel2 ,blood_type.name as blood,gender.type as gender,governorate.name as gov,cities.name as city,patient_diseases.disiease_id  as disiease_id ,diseases.diseases as diseases
    FROM patients_donors 
    JOIN patient_diseases
    ON ( patients_donors.p_ssn  = patient_diseases.p_ssn  )
    JOIN blood_type
    ON ( patients_donors.blood_type = blood_type.id )
    JOIN gender
    ON ( patients_donors.gender_id  = gender.id )
    JOIN cities
    ON ( patients_donors.city_id  = cities.id )
    JOIN governorate
    ON ( cities.gov_id  = governorate.id )
    JOIN diseases
    ON ( diseases.id = patient_diseases.disiease_id  )
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
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
  select_admin_by_ssn
==========================
*/
function select_admin_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `admin_ssn`=?") ;
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
        edit admin 
   ==========================
*/
function editAdmin($name,$email, $hashed, $reg_state,$id){
    global $con;
    $stmt=$con->prepare ("UPDATE admins SET `name`=?,`email`=?, `password`=?,`role`=? WHERE `id`=?");
    $stmt->execute(array($name,$email, $hashed, $reg_state,$id));
    echo "
    <script>
        toastr.success('Great ,successfully: Edited Admin .')
    </script>";
    header("Refresh:3;url=all_admins.php"); 
}



/*
==========================  
  select All Admins
==========================
*/
function select_Admins(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins");
    $stmt->execute();
    $row   =$stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

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
==========================
    get all data
==========================
*/

function getAllRegData($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table ORDER BY id DESC");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
===================
GET LAST
===================
*/

function get_last_MEMBER_ID(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM id_form ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
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
all vaccines requests
===================
*/

function all_vaccine_request(){
    global $con;
    $stmt = $con->prepare("SELECT order_vaccine.* , vaccines.scientific_name AS vaccine_scientific_name, vaccines.trade_name AS vaccine_trade_name, avilable_vaccines.amount AS avilable_vaccine , patients_donors.p_first_name AS patient_first_name , patients_donors.p_last_name AS patient_last_name , patients_donors.mobile_phone AS patient_phone 
    FROM order_vaccine 
    INNER JOIN avilable_vaccines
    ON avilable_vaccines.id = order_vaccine.vaccine_id
    INNER JOIN patients_donors
    ON patients_donors.p_ssn = order_vaccine.p_ssn
    INNER JOIN vaccines
    ON avilable_vaccines.vaccine_id = vaccines.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all purchase_orders
===================
*/

function all_purchase_orders(){
    global $con;
    $stmt = $con->prepare("SELECT purchase_order.* , blood_type.name AS blood_name ,avilable_blood.amount AS blood_amount , patients_donors.p_first_name AS patient_first_name , patients_donors.p_last_name AS patient_last_name , patients_donors.mobile_phone AS patient_phone 
    FROM purchase_order 
    INNER JOIN avilable_blood
    ON avilable_blood.blood_type_id = purchase_order.blood_type
    INNER JOIN patients_donors
    ON patients_donors.p_ssn = purchase_order.p_id
    INNER JOIN blood_type
    ON avilable_blood.blood_type_id = blood_type.id
    ");
    $stmt->execute();
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
==========================
  insert new donate place
==========================
*/

function insert_donate_place($name,$manager,$city_id,$start_at,$close_at,$holiday,$lat,$long){
    global $con;
    $stmt = $con->prepare("INSERT INTO donate_places(place_name,place_manager,city_id,open_at,close_at,holiday,lat,lng)
    Value(:name,:manager,:city_id,:start_at,:close_at,:holiday,:lat,:long)");
    $stmt->execute(
    array(
        ":name"                 => $name,
        ":manager"              => $manager,
        ":city_id"              => $city_id,
        ":start_at"             => $start_at,
        ":close_at"             => $close_at,
        ":holiday"              => $holiday,
        ":lat"                  => $lat,
        ":long"                 => $long,
    ));
    echo "
    <script>
        toastr.success('تمت اضافة مكان فرع بنك الدم بنجاح .')
    </script>";
    header("Refresh:3;url=all_donate_places.php"); 
    // echo $name . "<br>";
    // echo $manager . "<br>";
    // echo $city_id . "<br>";
    // echo $start_at . "<br>";
    // echo $close_at . "<br>";
    // echo $holiday . "<br>";
    // echo $lat . "<br>";
    // echo $long;

}


/*
==========================
  insert new donate reason
==========================
*/

function insert_reason($reason_name){
    global $con;
    $stmt = $con->prepare("INSERT INTO donate_reasons(reason)
    Value(:reason)");
    $stmt->execute(
    array(
        ":reason"                 => $reason_name,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Reason added .')
    </script>";
    header("Refresh:3;url=all_reasons_request_type.php?to=reason"); 
}


/*
==========================
  insert new request type
==========================
*/

function insert_req_type($req_type){
    global $con;
    $stmt = $con->prepare("INSERT INTO request_blood_type(type)
    Value(:req_type)");
    $stmt->execute(
    array(
        ":req_type"                 => $req_type,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Request Type added .')
    </script>";
    header("Refresh:3;url=all_reasons_request_type.php"); 
}

/*
 ==========================  
      update reasons        
 ==========================
*/
function  update_reason($reason,$id){
    global $con;
   $stmt= $con->prepare ("UPDATE donate_reasons SET `reason`=?WHERE `id`=?");
   $stmt ->execute(array(
       $reason,$id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل سبب التبرع بنجاح')
       </script>";
       header("Refresh:2;url=all_reasons_request_type.php?to=reason"); 
  }

/*
 ==========================  
      update request type        
 ==========================
*/
function update_req_type($req_type,$req_id){
    global $con;
   $stmt= $con->prepare ("UPDATE request_blood_type SET `type`=? WHERE `id`=?");
   $stmt ->execute(array(
       $req_type,$req_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل نوع طلب التبرع بنجاح')
       </script>";
       header("Refresh:2;url=all_reasons_request_type.php"); 
  }
  
/*
==========================
  insert news
==========================
*/

function insert_news($title,$desc,$avatar,$admin_ssn){
    global $con;
    $stmt = $con->prepare("INSERT INTO blog(title,content,img,admin_ssn)
    Value(:title,:desc,:image,:admin_ssn)");
    $stmt->execute(
    array(
        ":title"                    => $title,
        ":desc"                     => $desc,
        ":image"                    => $avatar,
        ":admin_ssn"                => $admin_ssn,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح : تم اضافة الخبر بنجاح.')
    </script>";
    header("Refresh:3;url=all_news.php"); 
}


/*
 ==========================  
      update news
 ==========================
*/
function update_news($title,$desc,$img,$admin_ssn,$news_id){
    global $con;
   $stmt= $con->prepare ("UPDATE blog SET `title`=? , `content`=? , `img`=? , `admin_ssn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $title,$desc,$img,$admin_ssn,$news_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل الخبر بنجاح')
       </script>";
       header("Refresh:2;url=all_news.php"); 
  }
  
    
/*
==========================image.png
  insert news
==========================
*/
function insert_api_user($user_name,$auth_code,$admin_ssn){
    global $con;
    $stmt = $con->prepare("INSERT INTO api_users(user_name,auth_code,admin_ssn)
    Value(:user_name,:auth_code,:admin_ssn)");
    $stmt->execute(
    array(
        ":user_name"                     => $user_name,
        ":auth_code"                     => $auth_code,
        ":admin_ssn"                     => $admin_ssn,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح : تم اضافة مستخدم البيانات بنجاح.')
    </script>";
    header("Refresh:3;url=all_api_users.php"); 
}

/*
===================
all api users
===================
*/

function all_api_users(){
    global $con;
    $stmt = $con->prepare("SELECT api_users.* , admins.admin_first_name AS f_name, admins.admin_last_name AS l_name 
    FROM api_users 
    INNER JOIN admins
    ON api_users.admin_ssn = admins.admin_ssn
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
 ==========================  
      update api user
 ==========================
*/
function update_api_user($user_name,$auth_code,$admin_ssn,$api_user_id){
    global $con;
   $stmt= $con->prepare ("UPDATE api_users SET `user_name`=? , `auth_code`=? , `admin_ssn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $user_name,$auth_code,$admin_ssn,$api_user_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل مستخدم البيانات بنجاح')
       </script>";
       header("Refresh:2;url=all_api_users.php"); 
  }
  

/*
 ==========================  
      count blood bags with blood_type
 ==========================
*/
function count_blood_bags($blood_type){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_blood
    WHERE blood_type_id = ? ");
    $stmt->execute(array($blood_type));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count blood bags
 ==========================
*/
function count_all_blood_bags(){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_blood");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}
  

/*
 ==========================  
      count vaccines with vaccine id
 ==========================
*/
function count_vaccine($vaccine_type){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_vaccines
    WHERE vaccine_id = ? ");
    $stmt->execute(array($vaccine_type));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count vaccines
 ==========================
*/
function count_all_vaccine(){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_vaccines");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count patients_donners
 ==========================
*/
function count_all_patients_donners(){
    global $con;
    $stmt = $con->prepare("SELECT count(p_ssn) From patients_donors");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count hospitals
 ==========================
*/
function count_all_donate_places(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From donate_places");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count admins
 ==========================
*/
function count_all_admins(){
    global $con;
    $stmt = $con->prepare("SELECT count(admin_ssn) From admins");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count news
 ==========================
*/
function count_all_news(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From blog");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count payments
 ==========================
*/
function count_all_payments(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From payments");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count quick requests
 ==========================
*/
function count_all_quick_requests(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From quick_request");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
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
count Rows from Database
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
    $p_diseases = select_user_by_id('patient_diseases',$old_ssn);
    foreach($p_diseases as $data){
        $stmt = $con->prepare("UPDATE patient_diseases SET `p_ssn`=? WHERE p_ssn = ?");
        $stmt->execute(array($old_ssn));
    }
   $stmt= $con->prepare ("UPDATE patients_donors SET `p_ssn`=? , `p_first_name`=? , `p_last_name`=?,`email`=? , `mobile_phone`=? , `home_phone`=?,`password`=? , `blood_type`=? , `birthday`=?,`gender_id`=? , `img`=? , `city_id`=? WHERE `p_ssn `=?");
   $stmt ->execute(array(
    $p_ssn,$f_name,$l_name,$email,$phone1,$phone2,$password,$blood_type,$birthday,$gender,$img,$city_id,$old_ssn));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل بياناتك بنجاح')
       </script>";
    //    header("Refresh:2;url=all_api_users.php"); 
  }



/*
 ==========================  
      buy blood
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
                echo "
                <script>
                toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
                </script>";
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
            echo "
            <script>
            toastr.success('تم حجز اكياس الدم بنجاح ... من فضلك توجه في اقرب وقت الي ( " . $hospital_name["place_name"] . " )" . "لاستلام اكياس الدم الخاصه بك وسوف يتم ارسال الباركود الخاص بالاستلام علي البريد الالكتروني الخاص بك المسجل لدينا')
            </script>";
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

