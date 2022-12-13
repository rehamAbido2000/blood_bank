<?php
ob_start(); 
session_start();
$style="addMember.css";
include 'init.php';
if(isset($_SESSION['role'])){
require './layout/topNav.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id =(int)$_GET['id'];
    echo $id;
    $admin_data=select_by_id("admins",$id);

if($_SERVER['REQUEST_METHOD']=='POST'){

            $name                   =FILTER_VAR($_POST['name'],FILTER_SANITIZE_STRING);
            $email                  =FILTER_VAR($_POST['email'],FILTER_SANITIZE_EMAIL);
            $password               =FILTER_VAR($_POST['password'],FILTER_SANITIZE_STRING);
            $hashed                 =sha1($password);
            $reg_state              =FILTER_VAR($_POST['reg_state'],FILTER_SANITIZE_NUMBER_INT);
            $admin_id              =FILTER_VAR($_POST['id'],FILTER_SANITIZE_NUMBER_INT);

            editAdmin($name,$email, $hashed, $reg_state,$admin_id);

    }
    
?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

    <div class="container mainAddForm">
    <img class="addMemberMainImg" src="img/addMember.png">
        <p class="firstParagraph text-center">Welcome to Admin page </p>
        <p class="secondParagraph text-center">From this page you can edit Admin Data to dashboard</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
        <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!--Event Name-->
            <div class="row">
              <!--User Name-->
              <div class="col-md-6 mb-3 col-xs-12">
                    <label for="Name">Admin Name</label>
                    <input type="text" value="<?php echo $admin_data['name'];?>" class="form-control" id="Name " 
                        placeholder="Enter User name" name="name" autocomplete="off">
                </div>

                <!--Email-->           
                <div class="col-md-6 mb-3 col-xs-12">
                    <label for="Email">Email</label>
                    <input type="email" value="<?php echo $admin_data['email'];?>" class="form-control" id="Email"
                            placeholder="Enter Email" name="email" >
                </div><!--autocomplete="new-off"-->


                <!--password--->
                <div class="col-md-6 mb-3 col-xs-12">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="Password"
                    placeholder="Enter email password" name="password" autocomplete="new-password">
                </div>

                <!--position--->
                <div class="col-md-6 mb-3 col-xs-12">
                    <label for="reg_state">Role</label>
                    <select class="custom-select ui search dropdown"  name="reg_state" id="reg_state" required>
                      <option selected value="<?php echo $admin_data['role'];?>"><?php 
                      if($admin_data['role'] == 0){
                        echo "Height Board";
                    }elseif($admin_data['role'] == 1){
                        echo "Head";
                    }elseif($admin_data['role'] == 2){
                        echo "Vice";
                      }
                      
                      
                      ?></option>
                      <?php if($admin_data['role'] != 0){?><option value="0">Height Board</option> <?php }?>
                      <?php if($admin_data['role'] != 1){?><option value="1">Head</option> <?php }?>
                      <?php if($admin_data['role'] != 2){?><option value="2">Vice</option> <?php }?>
                  </select>
                </div>





                

              <button type="submit"  class="btn btn-primary ml-2 mt-4">Edit Admin </button>
                        </div>
              </div>
            </form>
            </div>
            </div>
      </div>
    </div>
</div>
<?php 
require_once "./includes/template/footer.php";
                    }
                }else{
                    header("Location:LogIn.php");
                }
ob_end_flush();?>
